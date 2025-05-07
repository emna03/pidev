<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\RememberMeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\SecurityRequestAttributes;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\LoginAttempt;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';
    private UtilisateurRepository $userRepository;

    public function __construct(
        private UrlGeneratorInterface $urlGenerator,
        UtilisateurRepository $userRepository,
        private EntityManagerInterface $em,
        private \Symfony\Component\Mailer\MailerInterface $mailer
    ) {
        $this->userRepository = $userRepository;
    }

    public function authenticate(Request $request): Passport
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $csrfToken = $request->request->get('_csrf_token');

        $recaptchaToken = $request->request->get('g-recaptcha-response');

        $recaptchaSecret = '6LcmBhsrAAAAAGyF4QPdlfjheQanRDBohTgdzgBP'; // ta clé secrète V2
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaToken}");
        $responseData = json_decode($response);

        if (!$responseData->success) {
            throw new CustomUserMessageAuthenticationException('❌ reCAPTCHA invalide. Veuillez réessayer.');
        }
        $request->getSession()->set(SecurityRequestAttributes::LAST_USERNAME, $email);


        return new Passport(
            new UserBadge($email, function (string $userIdentifier) use ($request) {
                $user = $this->userRepository->findOneBy(['email' => $userIdentifier]);

                if (!$user) {
                    throw new CustomUserMessageAuthenticationException('Aucun compte associé à cet e-mail.');
                }

                // 🔐 Vérification activation
                if (!$user->isActivated()) {
                    throw new CustomUserMessageAuthenticationException('Votre compte est désactivé. Vérifiez vos e-mails pour le réactiver.');
                }

                // 🔁 Vérification du mot de passe manuelle (temporaire)
                $password = $request->request->get('password');
                $hasher = password_verify($password, $user->getPassword());

                if (!$hasher) {


                    $session = $request->getSession();
                    $key = 'login_attempts_' . $user->getEmail();
                    $attempts = $session->get($key, 0) + 1;
                    $session->set($key, $attempts);

                    if ($attempts >= 4) {
                        $user->deactivate();
                        // ✅ Enregistrement de la tentative échouée
                        $loginAttempt = new LoginAttempt();
                        $loginAttempt->setUtilisateur($user);
                        
                        $loginAttempt->setIpAddress($request->getClientIp());
                        $loginAttempt->setUserAgent($request->headers->get('User-Agent'));
                        $loginAttempt->setAttemptedAt(new \DateTime());

                        // 🌍 Localisation par IP
                        $location = $this->getLocationFromIp($request->getClientIp());
                        $loginAttempt->setCountry($location['country']);
                        $loginAttempt->setRegion($location['region']);
                        $loginAttempt->setCity($location['city']);

                        // 💾 Persist & flush
                        $this->em->persist($loginAttempt);
                        $this->em->persist($user);
                        $this->em->flush();
                        // 🔗 Génération lien d’activation
                        $activationLink = $this->urlGenerator->generate('app_activate_account', [
                            'id' => $user->getId()
                        ], UrlGeneratorInterface::ABSOLUTE_URL);

                        // ✉️ Création du mail avec logo
                        $emailObj = (new \Symfony\Component\Mime\Email())
                            ->from('chemlaliismail388@gmail.com')
                            ->to($user->getEmail())
                            ->subject('🔐 Activez votre compte CiviSmart');

                        $logoCid = $emailObj->embedFromPath('public/logo_civismart.png', 'logo_civismart');
                        $html = "
                        <div style='font-family: Arial, sans-serif; color: #333; background-color: #f9f9f9; padding: 20px;'>
                            <div style='max-width: 600px; margin: auto; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>
                                <div style='background-color: #620eb0; padding: 20px; text-align: center;'>
                                    <img src='cid:logo_civismart' alt='CiviSmart' style='height: 80px; margin-bottom: 10px;' />
                                    <h1 style='color: white; font-size: 24px;'>CiviSmart - Compte désactivé</h1>
                                </div>
                                <div style='padding: 30px;'>
                                    <p>Bonjour <strong>{$user->getPrenom()}</strong>,</p>
                                    <p>Votre compte a été temporairement désactivé après 4 tentatives de connexion échouées.</p>
                                    <p>Pour le réactiver, veuillez cliquer sur le bouton ci-dessous :</p>
                                    <div style='text-align: center; margin: 30px 0;'>
                                        <a href='{$activationLink}' style='background-color: #620eb0; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; display: inline-block;'>
                                            Réactiver mon compte
                                        </a>
                                    </div>
                                    <p>Si vous n'êtes pas à l'origine de ces tentatives, ignorez simplement ce message.</p>
                                    <p>À bientôt,<br>L'équipe CiviSmart 🚀</p>
                                </div>
                                <div style='background-color: #f1f1f1; padding: 15px; text-align: center; font-size: 12px; color: #888;'>
                                    &copy; " . date('Y') . " CiviSmart. Tous droits réservés.
                                </div>
                            </div>
                        </div>";

                        $emailObj->html($html);

                        $this->mailer->send($emailObj);

                        $session->remove($key); // Reset
                    }

                    throw new CustomUserMessageAuthenticationException('Mot de passe incorrect.');
                }

                // ✅ Succès → reset compteur
                $request->getSession()->remove('login_attempts_' . $user->getEmail());

                return $user;
            }),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge('authenticate', $csrfToken),
                new RememberMeBadge(),
            ]
        );
    }


    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $token->getUser();

        // 👉 1. Si le user vient juste de s’inscrire → compléter le profil
        if ($request->attributes->get('_route') === 'app_register') {
            return new RedirectResponse($this->urlGenerator->generate('app_profile_complete', [
                'id' => $user->getId()
            ]));
        }


        // 👉 3. Redirection selon le rôle
        if (in_array('ROLE_ADMIN', $user->getRoles())) {
            return new RedirectResponse($this->urlGenerator->generate('admin_users'));
        }

        // 👉 4. Par défaut : home
        return new RedirectResponse($this->urlGenerator->generate('app_home'));
    }



    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
    private function getLocationFromIp(string $ip): array
    {
        // Ignorer les IPs locales
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return [
                'country' => 'Localhost',
                'region'  => 'Local',
                'city'    => 'Local',
            ];
        }
    
        $url = "http://ip-api.com/json/{$ip}?fields=status,country,regionName,city";
    
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);
            $data = $response->toArray();
    
            if ($data['status'] === 'success') {
                return [
                    'country' => $data['country'] ?? 'Unknown',
                    'region'  => $data['regionName'] ?? 'Unknown',
                    'city'    => $data['city'] ?? 'Unknown',
                ];
            }
        } catch (\Exception $e) {
            // Optionnel : log l'erreur ici
        }
    
        return [
            'country' => 'Unknown',
            'region'  => 'Unknown',
            'city'    => 'Unknown',
        ];
    }
    
}
