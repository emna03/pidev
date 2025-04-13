<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* base.html.twig */
class __TwigTemplate_f1ea3fca252e144799feb2f29fe79221 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\" data-style-switcher-options=\"{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#4be296', 'colorSecondary': '#2e895b', 'colorTertiary': '#1f2f28', 'colorQuaternary': '#f7f0e7'}\">
\t
<!-- Mirrored from www.okler.net/previews/porto/12.1.0/demo-accounting-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 06:16:29 GMT -->
<head>
\t\t
\t\t<!-- Basic -->
\t\t<meta charset=\"utf-8\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

\t\t<title>Demo Accounting 1 | Porto - Multipurpose Website Template</title>\t

\t\t<meta name=\"keywords\" content=\"WebSite Template\" />
\t\t<meta name=\"description\" content=\"Porto - Multipurpose Website Template\">
\t\t<meta name=\"author\" content=\"okler.net\">

\t\t<!-- Favicon -->
\t\t<link rel=\"shortcut icon\" href=\"img/favicon.ico\" type=\"image/x-icon\" />
\t\t<link rel=\"apple-touch-icon\" href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/img/apple-touch-icon.png"), "html", null, true);
        yield "\">

\t\t<!-- Mobile Metas -->
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no\">

\t\t<!-- Web Fonts  -->
\t\t<link id=\"googleFonts\" href=\"https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap\" rel=\"stylesheet\" type=\"text/css\">

\t\t<!-- Vendor CSS -->
\t\t<link rel=\"stylesheet\" href=\"";
        // line 28
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/bootstrap/css/bootstrap.min.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 29
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/fontawesome-free/css/all.min.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 30
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/animate/animate.compat.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/simple-line-icons/css/simple-line-icons.min.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/owl.carousel/assets/owl.carousel.min.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 33
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/owl.carousel/assets/owl.theme.default.min.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/vendor/magnific-popup/magnific-popup.min.css"), "html", null, true);
        yield "\">

\t\t<!-- Theme CSS -->
\t\t<link rel=\"stylesheet\" href=\"";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/theme.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 38
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/theme-elements.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/theme-blog.css"), "html", null, true);
        yield "\">
\t\t<link rel=\"stylesheet\" href=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/theme-shop.css"), "html", null, true);
        yield "\">

\t\t<!-- Demo CSS -->
\t\t<link rel=\"stylesheet\" href=\"";
        // line 43
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/demos/demo-accounting-1.css"), "html", null, true);
        yield "\">

\t\t<!-- Skin CSS -->
\t\t<link id=\"skinCSS\" rel=\"stylesheet\" href=\"";
        // line 46
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/skins/skin-accounting-1.css"), "html", null, true);
        yield "\">

\t\t<!-- Theme Custom CSS -->
\t\t<link rel=\"stylesheet\" href=\"";
        // line 49
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Front/css/custom.css"), "html", null, true);
        yield "\">


\t\t<!-- Google tag (gtag.js) -->
\t\t<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-T21B0FFW8M\"></script>
\t\t<script>
\t\t\twindow.dataLayer = window.dataLayer || [];
\t\t\tfunction gtag(){dataLayer.push(arguments);}
\t\t\tgtag('js', new Date());

\t\t\tgtag('config', 'G-T21B0FFW8M');
\t\t</script>

\t</head>
\t<body>

\t\t<div class=\"body\">
\t\t\t<header id=\"header\" data-plugin-options=\"{'stickyScrollUp': true, 'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': false, 'stickyStartAt': 100, 'stickyHeaderContainerHeight': 100}\">
\t\t\t\t<div class=\"header-body border-top-0 h-auto box-shadow-none\">
\t\t\t\t\t<div class=\"container-fluid px-3 px-lg-5 p-static\">
\t\t\t\t\t\t<div class=\"row align-items-center py-3\">
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-2 col-xxl-3 me-auto me-lg-0\">
\t\t\t\t\t\t\t\t<div class=\"header-logo\" data-clone-element-to=\"#offCanvasLogo\">
\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1.html\">
\t\t\t\t\t\t\t\t\t\t<img alt=\"Porto\" width=\"131\" height=\"27\" src=\"img/demos/accounting-1/logo.png\" data-img-suffix-primary>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-8 col-xxl-6 justify-content-lg-center\">
\t\t\t\t\t\t\t\t<div class=\"header-nav header-nav-links justify-content-lg-center\">
\t\t\t\t\t\t\t\t\t<div class=\"header-nav-main header-nav-main-text-capitalize header-nav-main-arrows header-nav-main-effect-2\">
\t\t\t\t\t\t\t\t\t\t<nav class=\"collapse\">
\t\t\t\t\t\t\t\t\t\t\t<ul class=\"nav nav-pills\" id=\"mainNav\">
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1.html\" class=\"nav-link active\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tHome
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1-services.html\" class=\"nav-link dropdown-toggle\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Overview</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Accounting</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Tax Planning</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Business Advisory</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Payroll Management</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Global Accounting</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Admin Services</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-about.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tAbout
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-process.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tProcess
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-projects.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tProjects
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-news.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tNews
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-contact.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tContact
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</nav>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-2 col-xxl-3\">
\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-end align-items-center\">
\t\t\t\t\t\t\t\t\t<div class=\"d-none d-sm-flex d-lg-none d-xxl-flex\">
\t\t\t\t\t\t\t\t\t\t<img src=\"img/icons/phone-2.svg\" width=\"24\" height=\"24\" alt=\"\" data-icon data-plugin-options=\"{'onlySVG': true, 'extraClass': 'svg-fill-color-secondary pe-1'}\" />
\t\t\t\t\t\t\t\t\t\t<a href=\"tel:1234567890\" class=\"text-decoration-none font-secondary text-4 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap\">800 123 4567</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1-contact.html\" class=\"btn btn-rounded btn-dark box-shadow-7 font-weight-medium px-3 py-2 text-2-5 btn-swap-1 ms-3 d-none d-md-flex\" data-clone-element=\"1\">
\t\t\t\t\t\t\t\t\t\t<span>Get Free Quote <i class=\"fa-solid fa-arrow-right ms-2\"></i></span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<button class=\"btn header-btn-collapse-nav rounded-pill\" data-bs-toggle=\"offcanvas\" href=\"#offcanvasMain\" role=\"button\" aria-controls=\"offcanvasMain\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fas fa-bars\"></i>
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</header>

            ";
        // line 148
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 149
        yield "    
    </div>
    <div class=\"container pb-lg-4 pt-5\">
        <div class=\"row pt-3\">
            <div class=\"col-lg-4\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Porto</h4>

                <p class=\"text-3-5 text-color-grey\">Porto - Expert Accounting Solutions Tailored to Your Needs—Ensuring Accuracy, Compliance, and Financial Peace of Mind.</p>

                <div class=\"d-flex align-items-center pt-2 pb-4\">
                    <p class=\"d-inline-block mb-0 font-weight-bold line-height-1\"><mark class=\"text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-8 mark-height-30 n-ls-5 p-0\">30+</mark></p>
                    <span class=\"custom-font-tertiary text-5 text-dark n-ls-1 fst-italic ps-2\">Years of Experience</span>
                </div>

                <ul class=\"social-icons social-icons-clean social-icons-medium\">
                    <li class=\"social-icons-instagram\">
                        <a href=\"http://www.instagram.com/\" target=\"_blank\" title=\"Instagram\">
                            <i class=\"fab fa-instagram\"></i>
                        </a>
                    </li>
                    <li class=\"social-icons-x\">
                        <a href=\"http://www.x.com/\" target=\"_blank\" title=\"X\">
                            <i class=\"fab fa-x-twitter\"></i>
                        </a>
                    </li>
                    <li class=\"social-icons-facebook\">
                        <a href=\"http://www.facebook.com/\" target=\"_blank\" title=\"Facebook\">
                            <i class=\"fab fa-facebook-f\"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class=\"col-sm-6 col-lg-2 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">About</h4>
                <ul class=\"list list-unstyled\">
                    <li>
                        <a href=\"demo-accounting-1.html\" class=\"text-color-grey text-color-hover-primary\">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href=\"demo-accounting-1-services.html\" class=\"text-color-grey text-color-hover-primary\">Services</a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-about.html\">
                            About
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-process.html\">
                            Process
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-projects.html\">
                            Projects
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" target=\"_blank\" href=\"demo-accounting-1-news.html\">
                            News
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-contact.html\">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class=\"col-sm-6 col-lg-3 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Services</h4>
                <ul class=\"list list-unstyled\">
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Accounting</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Tax Planning</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Business Advisory</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Payroll Management</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Global Accounting</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Admin Services</a></li>
                </ul>
            </div>
            <div class=\"col-lg-3 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Newsletter</h4>
                <p class=\"text-3-5 text-color-grey\">Want to receive news and updates? Enter your email.</p>
                <div class=\"alert alert-success d-none\" id=\"newsletterSuccess\">
                    <strong>Success!</strong> You've been added to our email list.
                </div>
                <div class=\"alert alert-danger d-none\" id=\"newsletterError\"></div>
                <form id=\"newsletterForm\" action=\"https://www.okler.net/previews/porto/12.1.0/php/newsletter-subscribe.php\" method=\"POST\" class=\"mb-0\">
                    <div class=\"row\">
                        <div class=\"form-group col\">
                            <div class=\"position-relative\">
                                <i class=\"icons icon-envelope text-color-grey bg-light text-3-5 position-absolute right-15 top-50pct transform3dy-n50\"></i>
                                <input type=\"email\" value=\"\" placeholder=\"Enter your e-mail\" class=\"form-control form-control-icon text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2\" name=\"newsletterEmail\" id=\"newsletterEmail\">
                            </div>
                        </div>
                    </div>\t\t
                    <div class=\"row\">
                        <div class=\"form-group col\">
                            <button type=\"submit\" class=\"btn btn-rounded btn-dark box-shadow-7 font-weight-medium px-3 py-2 text-2-5 btn-swap-1\" data-clone-element=\"1\">
                                <span>Submit <i class=\"fa-solid fa-arrow-right ms-2\"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class=\"footer-copyright bg-transparent pb-5\">
        <div class=\"container\">
            <hr>
            <div class=\"row\">
                <div class=\"col-lg-6 text-center text-lg-start py-3\">
                    <p class=\"text-3 mb-0 opacity-6\">© 2025 Porto is Proudly Powered by <a href=\"http://www.okler.net/\" target=\"_blank\" class=\"text-decoration-underline text-color-secondary text-color-hover-primary\">Okler</a></p>
                </div>
                <div class=\"col-lg-6 py-3 text-center text-lg-end\">
                    <a href=\"#\" class=\"text-color-grey text-color-hover-primary\">Privacy Policy</a>
                    <a href=\"#\" class=\"text-color-grey text-color-hover-primary ms-3\">Terms of Use</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div class=\"offcanvas offcanvas-start\" data-bs-scroll=\"true\" tabindex=\"-1\" id=\"offcanvasMain\" aria-labelledby=\"offcanvasMain\">
<div class=\"offcanvas-header\">
    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
</div>
<div class=\"offcanvas-body\">
    <div class=\"mb-4\" id=\"offCanvasLogo\"></div>
    <nav class=\"offcanvas-nav w-100\" id=\"offCanvasNav\"></nav>
</div>
</div>

<a class=\"style-switcher-open-loader\" href=\"#\" data-base-path=\"\" data-skin-src=\"master/less/skin-accounting-1.less\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Style Switcher\" aria-label=\"Style Switcher\"><i class=\"fas fa-cogs\"></i><div class=\"style-switcher-tooltip\"><strong>Style Switcher</strong><p>Check out different color options and styles.</p></div></a>

<a class=\"envato-buy-redirect\" href=\"https://themeforest.net/checkout/from_item/4106987?license=regular&amp;support=bundle_6month&amp;ref=Okler\" target=\"_blank\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Buy Porto\"><i class=\"fas fa-shopping-cart\"></i></a>
<a class=\"demos-redirect\" href=\"index.html#demos\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Demos\"><img alt=\"Demos\" src=\"img/icons/demos-redirect.png\" class=\"img-fluid\" /></a>


<!-- Vendor -->
<script data-cfasync=\"false\" src=\"../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js\"></script><script src=\"vendor/plugins/js/plugins.min.js\"></script>

<!-- Theme Base, Components and Settings -->
<script src=\"js/theme.js\"></script>

<!-- Demo -->
<script src=\"js/demos/demo-accounting-1.js\"></script>

<!-- Theme Initialization Files -->
<script src=\"js/theme.init.js\"></script>

<!-- Current Page Vendor and Views -->
<script src=\"js/views/view.contact.js\"></script>

</body>

<!-- Mirrored from www.okler.net/previews/porto/12.1.0/demo-accounting-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 06:16:41 GMT -->
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 148
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        yield " ";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  416 => 148,  245 => 149,  243 => 148,  141 => 49,  135 => 46,  129 => 43,  123 => 40,  119 => 39,  115 => 38,  111 => 37,  105 => 34,  101 => 33,  97 => 32,  93 => 31,  89 => 30,  85 => 29,  81 => 28,  69 => 19,  49 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\" data-style-switcher-options=\"{'changeLogo': false, 'borderRadius': 0, 'colorPrimary': '#4be296', 'colorSecondary': '#2e895b', 'colorTertiary': '#1f2f28', 'colorQuaternary': '#f7f0e7'}\">
\t
<!-- Mirrored from www.okler.net/previews/porto/12.1.0/demo-accounting-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 06:16:29 GMT -->
<head>
\t\t
\t\t<!-- Basic -->
\t\t<meta charset=\"utf-8\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

\t\t<title>Demo Accounting 1 | Porto - Multipurpose Website Template</title>\t

\t\t<meta name=\"keywords\" content=\"WebSite Template\" />
\t\t<meta name=\"description\" content=\"Porto - Multipurpose Website Template\">
\t\t<meta name=\"author\" content=\"okler.net\">

\t\t<!-- Favicon -->
\t\t<link rel=\"shortcut icon\" href=\"img/favicon.ico\" type=\"image/x-icon\" />
\t\t<link rel=\"apple-touch-icon\" href=\"{{ asset('Front/img/apple-touch-icon.png')}}\">

\t\t<!-- Mobile Metas -->
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no\">

\t\t<!-- Web Fonts  -->
\t\t<link id=\"googleFonts\" href=\"https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&amp;family=Playfair+Display:ital,wght@0,400..900;1,400..900&amp;family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap\" rel=\"stylesheet\" type=\"text/css\">

\t\t<!-- Vendor CSS -->
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/bootstrap/css/bootstrap.min.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/fontawesome-free/css/all.min.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/animate/animate.compat.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/simple-line-icons/css/simple-line-icons.min.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/owl.carousel/assets/owl.carousel.min.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/owl.carousel/assets/owl.theme.default.min.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/vendor/magnific-popup/magnific-popup.min.css')}}\">

\t\t<!-- Theme CSS -->
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/theme.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/theme-elements.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/theme-blog.css')}}\">
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/theme-shop.css')}}\">

\t\t<!-- Demo CSS -->
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/demos/demo-accounting-1.css')}}\">

\t\t<!-- Skin CSS -->
\t\t<link id=\"skinCSS\" rel=\"stylesheet\" href=\"{{ asset('Front/css/skins/skin-accounting-1.css')}}\">

\t\t<!-- Theme Custom CSS -->
\t\t<link rel=\"stylesheet\" href=\"{{ asset('Front/css/custom.css')}}\">


\t\t<!-- Google tag (gtag.js) -->
\t\t<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-T21B0FFW8M\"></script>
\t\t<script>
\t\t\twindow.dataLayer = window.dataLayer || [];
\t\t\tfunction gtag(){dataLayer.push(arguments);}
\t\t\tgtag('js', new Date());

\t\t\tgtag('config', 'G-T21B0FFW8M');
\t\t</script>

\t</head>
\t<body>

\t\t<div class=\"body\">
\t\t\t<header id=\"header\" data-plugin-options=\"{'stickyScrollUp': true, 'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyChangeLogo': false, 'stickyStartAt': 100, 'stickyHeaderContainerHeight': 100}\">
\t\t\t\t<div class=\"header-body border-top-0 h-auto box-shadow-none\">
\t\t\t\t\t<div class=\"container-fluid px-3 px-lg-5 p-static\">
\t\t\t\t\t\t<div class=\"row align-items-center py-3\">
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-2 col-xxl-3 me-auto me-lg-0\">
\t\t\t\t\t\t\t\t<div class=\"header-logo\" data-clone-element-to=\"#offCanvasLogo\">
\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1.html\">
\t\t\t\t\t\t\t\t\t\t<img alt=\"Porto\" width=\"131\" height=\"27\" src=\"img/demos/accounting-1/logo.png\" data-img-suffix-primary>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-8 col-xxl-6 justify-content-lg-center\">
\t\t\t\t\t\t\t\t<div class=\"header-nav header-nav-links justify-content-lg-center\">
\t\t\t\t\t\t\t\t\t<div class=\"header-nav-main header-nav-main-text-capitalize header-nav-main-arrows header-nav-main-effect-2\">
\t\t\t\t\t\t\t\t\t\t<nav class=\"collapse\">
\t\t\t\t\t\t\t\t\t\t\t<ul class=\"nav nav-pills\" id=\"mainNav\">
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1.html\" class=\"nav-link active\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tHome
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1-services.html\" class=\"nav-link dropdown-toggle\">Services</a>
\t\t\t\t\t\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Overview</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Accounting</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Tax Planning</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Business Advisory</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Payroll Management</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Global Accounting</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<li><a href=\"demo-accounting-1-services-details.html\" class=\"dropdown-item anim-hover-translate-right-5px transition-3ms bg-transparent text-color-hover-primary text-lg-2 py-lg-2\">Admin Services</a></li>
\t\t\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-about.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tAbout
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-process.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tProcess
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-projects.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tProjects
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-news.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tNews
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"nav-link\" href=\"demo-accounting-1-contact.html\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\tContact
\t\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t\t\t</nav>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-auto col-lg-2 col-xxl-3\">
\t\t\t\t\t\t\t\t<div class=\"d-flex justify-content-end align-items-center\">
\t\t\t\t\t\t\t\t\t<div class=\"d-none d-sm-flex d-lg-none d-xxl-flex\">
\t\t\t\t\t\t\t\t\t\t<img src=\"img/icons/phone-2.svg\" width=\"24\" height=\"24\" alt=\"\" data-icon data-plugin-options=\"{'onlySVG': true, 'extraClass': 'svg-fill-color-secondary pe-1'}\" />
\t\t\t\t\t\t\t\t\t\t<a href=\"tel:1234567890\" class=\"text-decoration-none font-secondary text-4 font-weight-semibold text-color-dark text-color-hover-primary transition-2ms negative-ls-05 ws-nowrap\">800 123 4567</a>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<a href=\"demo-accounting-1-contact.html\" class=\"btn btn-rounded btn-dark box-shadow-7 font-weight-medium px-3 py-2 text-2-5 btn-swap-1 ms-3 d-none d-md-flex\" data-clone-element=\"1\">
\t\t\t\t\t\t\t\t\t\t<span>Get Free Quote <i class=\"fa-solid fa-arrow-right ms-2\"></i></span>
\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t<button class=\"btn header-btn-collapse-nav rounded-pill\" data-bs-toggle=\"offcanvas\" href=\"#offcanvasMain\" role=\"button\" aria-controls=\"offcanvasMain\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fas fa-bars\"></i>
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</header>

            {% block body %} {% endblock %}
    
    </div>
    <div class=\"container pb-lg-4 pt-5\">
        <div class=\"row pt-3\">
            <div class=\"col-lg-4\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Porto</h4>

                <p class=\"text-3-5 text-color-grey\">Porto - Expert Accounting Solutions Tailored to Your Needs—Ensuring Accuracy, Compliance, and Financial Peace of Mind.</p>

                <div class=\"d-flex align-items-center pt-2 pb-4\">
                    <p class=\"d-inline-block mb-0 font-weight-bold line-height-1\"><mark class=\"text-dark mark mark-pos-2 mark-height-50 mark-color bg-color-before-primary-rgba-30 font-secondary text-8 mark-height-30 n-ls-5 p-0\">30+</mark></p>
                    <span class=\"custom-font-tertiary text-5 text-dark n-ls-1 fst-italic ps-2\">Years of Experience</span>
                </div>

                <ul class=\"social-icons social-icons-clean social-icons-medium\">
                    <li class=\"social-icons-instagram\">
                        <a href=\"http://www.instagram.com/\" target=\"_blank\" title=\"Instagram\">
                            <i class=\"fab fa-instagram\"></i>
                        </a>
                    </li>
                    <li class=\"social-icons-x\">
                        <a href=\"http://www.x.com/\" target=\"_blank\" title=\"X\">
                            <i class=\"fab fa-x-twitter\"></i>
                        </a>
                    </li>
                    <li class=\"social-icons-facebook\">
                        <a href=\"http://www.facebook.com/\" target=\"_blank\" title=\"Facebook\">
                            <i class=\"fab fa-facebook-f\"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class=\"col-sm-6 col-lg-2 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">About</h4>
                <ul class=\"list list-unstyled\">
                    <li>
                        <a href=\"demo-accounting-1.html\" class=\"text-color-grey text-color-hover-primary\">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href=\"demo-accounting-1-services.html\" class=\"text-color-grey text-color-hover-primary\">Services</a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-about.html\">
                            About
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-process.html\">
                            Process
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-projects.html\">
                            Projects
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" target=\"_blank\" href=\"demo-accounting-1-news.html\">
                            News
                        </a>
                    </li>
                    <li>
                        <a class=\"text-color-grey text-color-hover-primary\" href=\"demo-accounting-1-contact.html\">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
            <div class=\"col-sm-6 col-lg-3 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Services</h4>
                <ul class=\"list list-unstyled\">
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Accounting</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Tax Planning</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Business Advisory</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Payroll Management</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Global Accounting</a></li>
                    <li><a href=\"demo-accounting-1-services-details.html\" class=\"text-color-grey text-color-hover-primary\">Admin Services</a></li>
                </ul>
            </div>
            <div class=\"col-lg-3 pt-4 pt-lg-0\">
                <h4 class=\"text-color-dark font-weight-bold mb-3\">Newsletter</h4>
                <p class=\"text-3-5 text-color-grey\">Want to receive news and updates? Enter your email.</p>
                <div class=\"alert alert-success d-none\" id=\"newsletterSuccess\">
                    <strong>Success!</strong> You've been added to our email list.
                </div>
                <div class=\"alert alert-danger d-none\" id=\"newsletterError\"></div>
                <form id=\"newsletterForm\" action=\"https://www.okler.net/previews/porto/12.1.0/php/newsletter-subscribe.php\" method=\"POST\" class=\"mb-0\">
                    <div class=\"row\">
                        <div class=\"form-group col\">
                            <div class=\"position-relative\">
                                <i class=\"icons icon-envelope text-color-grey bg-light text-3-5 position-absolute right-15 top-50pct transform3dy-n50\"></i>
                                <input type=\"email\" value=\"\" placeholder=\"Enter your e-mail\" class=\"form-control form-control-icon text-3 h-auto border-width-2 border-radius-2 border-color-grey-200 py-2\" name=\"newsletterEmail\" id=\"newsletterEmail\">
                            </div>
                        </div>
                    </div>\t\t
                    <div class=\"row\">
                        <div class=\"form-group col\">
                            <button type=\"submit\" class=\"btn btn-rounded btn-dark box-shadow-7 font-weight-medium px-3 py-2 text-2-5 btn-swap-1\" data-clone-element=\"1\">
                                <span>Submit <i class=\"fa-solid fa-arrow-right ms-2\"></i></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class=\"footer-copyright bg-transparent pb-5\">
        <div class=\"container\">
            <hr>
            <div class=\"row\">
                <div class=\"col-lg-6 text-center text-lg-start py-3\">
                    <p class=\"text-3 mb-0 opacity-6\">© 2025 Porto is Proudly Powered by <a href=\"http://www.okler.net/\" target=\"_blank\" class=\"text-decoration-underline text-color-secondary text-color-hover-primary\">Okler</a></p>
                </div>
                <div class=\"col-lg-6 py-3 text-center text-lg-end\">
                    <a href=\"#\" class=\"text-color-grey text-color-hover-primary\">Privacy Policy</a>
                    <a href=\"#\" class=\"text-color-grey text-color-hover-primary ms-3\">Terms of Use</a>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div class=\"offcanvas offcanvas-start\" data-bs-scroll=\"true\" tabindex=\"-1\" id=\"offcanvasMain\" aria-labelledby=\"offcanvasMain\">
<div class=\"offcanvas-header\">
    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
</div>
<div class=\"offcanvas-body\">
    <div class=\"mb-4\" id=\"offCanvasLogo\"></div>
    <nav class=\"offcanvas-nav w-100\" id=\"offCanvasNav\"></nav>
</div>
</div>

<a class=\"style-switcher-open-loader\" href=\"#\" data-base-path=\"\" data-skin-src=\"master/less/skin-accounting-1.less\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Style Switcher\" aria-label=\"Style Switcher\"><i class=\"fas fa-cogs\"></i><div class=\"style-switcher-tooltip\"><strong>Style Switcher</strong><p>Check out different color options and styles.</p></div></a>

<a class=\"envato-buy-redirect\" href=\"https://themeforest.net/checkout/from_item/4106987?license=regular&amp;support=bundle_6month&amp;ref=Okler\" target=\"_blank\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Buy Porto\"><i class=\"fas fa-shopping-cart\"></i></a>
<a class=\"demos-redirect\" href=\"index.html#demos\" data-bs-toggle=\"tooltip\" data-bs-animation=\"false\" data-bs-placement=\"right\" title=\"Demos\"><img alt=\"Demos\" src=\"img/icons/demos-redirect.png\" class=\"img-fluid\" /></a>


<!-- Vendor -->
<script data-cfasync=\"false\" src=\"../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js\"></script><script src=\"vendor/plugins/js/plugins.min.js\"></script>

<!-- Theme Base, Components and Settings -->
<script src=\"js/theme.js\"></script>

<!-- Demo -->
<script src=\"js/demos/demo-accounting-1.js\"></script>

<!-- Theme Initialization Files -->
<script src=\"js/theme.init.js\"></script>

<!-- Current Page Vendor and Views -->
<script src=\"js/views/view.contact.js\"></script>

</body>

<!-- Mirrored from www.okler.net/previews/porto/12.1.0/demo-accounting-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 27 Mar 2025 06:16:41 GMT -->
</html>
", "base.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\base.html.twig");
    }
}
