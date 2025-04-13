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

/* lampadaire/baseBack.html.twig */
class __TwigTemplate_df589c0431282932e402c2d4e5ad075f extends Template
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
            'title' => [$this, 'block_title'],
            'stylesheet' => [$this, 'block_stylesheet'],
            'body' => [$this, 'block_body'],
            'javascript' => [$this, 'block_javascript'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/baseBack.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/baseBack.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">

<head>
    <meta charset=\"utf-8\" />
    <title>";
        // line 7
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 10
        yield "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta content=\"Career Bridge\" name=\"description\" />
    <meta content=\"Career Bridge\" name=\"author\" />
    
    <!-- App favicon -->
    <link rel=\"shortcut icon\" href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/images/favicon.ico"), "html", null, true);
        yield "\">

    <!-- Bootstrap Css -->
    <link href=\"";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/css/bootstrap.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\" type=\"text/css\" />
    <!-- Icons Css -->
    <link href=\"";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/css/icons.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\" type=\"text/css\" />
    <!-- App Css-->
    <link href=\"";
        // line 23
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/css/app.min.css"), "html", null, true);
        yield "\" rel=\"stylesheet\" type=\"text/css\" />
    
    <style>
        /* Custom Admin Styles */
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --text-primary: #6e84a3;
            --text-secondary: #8492a6;
            --bg-sidebar: #2c3e50;
            --bg-sidebar-active: #34495e;
        }

        body {
            background-color: var(--light-color);
            font-family: 'Nunito', sans-serif;
        }

        /* Sidebar Styles */
        .vertical-menu {
            background: linear-gradient(180deg, var(--bg-sidebar) 0%, var(--bg-sidebar-active) 100%);
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .navbar-brand {
            padding: 1.5rem 1rem;
            color: white;
            font-size: 1.15rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: rgba(255, 255, 255, 0.05);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .menu-title {
            padding: 0.8rem 1.5rem;
            color: var(--text-secondary);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-link {
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 0.9rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Header Styles */
        .header {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            padding: 2px;
        }

        .dropdown-toggle {
            color: var(--text-primary);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: none;
            background: transparent;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            color: var(--primary-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.85rem;
            color: var(--text-primary);
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Content Area */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .vertical-menu {
                left: -250px;
            }

            .main-content {
                margin-left: 0;
            }

            body.sidebar-enable .vertical-menu {
                left: 0;
            }

            body.sidebar-enable .main-content {
                margin-left: 250px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        /* Animations */
        .nav-link, .dropdown-item {
            transition: all 0.2s ease;
        }

        /* Sub-menu styles */
        .nav-item .nav-link[data-bs-toggle=\"collapse\"] {
            position: relative;
        }

        .nav-item .nav-link[data-bs-toggle=\"collapse\"]::after {
            content: '\\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            transition: transform 0.3s ease;
        }

        .nav-item .nav-link[data-bs-toggle=\"collapse\"][aria-expanded=\"true\"]::after {
            transform: rotate(180deg);
        }

        .sub-menu {
            padding-left: 2.5rem;
            background: rgba(0, 0, 0, 0.1);
        }

        .sub-menu .nav-link {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }
    </style>

    ";
        // line 248
        yield from $this->unwrap()->yieldBlock('stylesheet', $context, $blocks);
        // line 249
        yield "</head>

<body>
    <!-- Begin page -->
    <div id=\"layout-wrapper\">
        <!-- ========== Left Sidebar Start ========== -->
        <div class=\"vertical-menu\">
            <a href=\"#\" class=\"navbar-brand\">
                <i class=\"bx bx-bridge\"></i>
                Career Bridge
            </a>

            <div class=\"h-100\">
                <div id=\"sidebar-menu\">
                    <!-- Left Menu Start -->
                    <ul class=\"nav flex-column\" id=\"side-menu\">
                        <li class=\"menu-title\">MENU</li>

                        <li class=\"nav-item\">
                            <a href=\"#\" class=\"nav-link ";
        // line 268
        if ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 268, $this->source); })()), "request", [], "any", false, false, false, 268), "get", ["_route"], "method", false, false, false, 268) == "app_home_back")) {
            yield "active";
        }
        yield "\">
                                <i class=\"bx bx-home-circle\"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#userSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-user\"></i>
                                <span>Users</span>
                            </a>
                            <div class=\"collapse\" id=\"userSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Users</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Add User</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#jobSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-briefcase\"></i>
                                <span>Jobs</span>
                            </a>
                            <div class=\"collapse\" id=\"jobSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Jobs</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Add Job</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#applicationSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-file\"></i>
                                <span>Applications</span>
                            </a>
                            <div class=\"collapse\" id=\"applicationSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Applications</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Pending Applications</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#settingSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-cog\"></i>
                                <span>Settings</span>
                            </a>
                            <div class=\"collapse\" id=\"settingSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">General Settings</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Email Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class=\"main-content\">
            <header class=\"header\">
                <div class=\"d-flex justify-content-between align-items-center\">
                    <button type=\"button\" class=\"btn btn-link text-dark p-0\" id=\"vertical-menu-btn\">
                        <i class=\"bx bx-menu font-size-24\"></i>
                    </button>

                    <div class=\"user-profile\">
                        <img src=\"";
        // line 358
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/images/users/avatar-1.jpg"), "html", null, true);
        yield "\" alt=\"Header Avatar\">
                        <div class=\"dropdown\">
                            <button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                <span class=\"d-none d-xl-inline-block ms-1\">Admin</span>
                                <i class=\"bx bx-chevron-down\"></i>
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-user\"></i> Profile</a></li>
                                <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-cog\"></i> Settings</a></li>
                                <li><hr class=\"dropdown-divider\"></li>
                                <li><a class=\"dropdown-item text-danger\" href=\"#\"><i class=\"bx bx-power-off\"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            ";
        // line 375
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 376
        yield "        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src=\"";
        // line 382
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/libs/jquery/jquery.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 383
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/libs/bootstrap/js/bootstrap.bundle.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 384
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/libs/metismenu/metisMenu.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 385
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/libs/simplebar/simplebar.min.js"), "html", null, true);
        yield "\"></script>
    <script src=\"";
        // line 386
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl("Back/libs/node-waves/waves.min.js"), "html", null, true);
        yield "\"></script>

    <script>
        // Toggle sidebar
        document.getElementById('vertical-menu-btn').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-enable');
            if (window.innerWidth >= 992) {
                document.body.classList.toggle('vertical-collpsed');
            }
        });

        // Collapse menu on mobile
        if (window.innerWidth < 992) {
            document.body.classList.add('vertical-collpsed');
        }

        // Active link handling
        document.querySelectorAll('.nav-link').forEach(function(element) {
            element.addEventListener('click', function(e) {
                if (this.getAttribute('data-bs-toggle') !== 'collapse') {
                    document.querySelector('.nav-link.active')?.classList.remove('active');
                    this.classList.add('active');
                }
            });
        });
    </script>

    ";
        // line 413
        yield from $this->unwrap()->yieldBlock('javascript', $context, $blocks);
        // line 414
        yield "</body>
</html> ";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 7
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        // line 8
        yield "CiviSmart";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 248
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheet(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheet"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheet"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 375
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

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 413
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascript(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascript"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascript"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "lampadaire/baseBack.html.twig";
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
        return array (  589 => 413,  567 => 375,  545 => 248,  534 => 8,  521 => 7,  509 => 414,  507 => 413,  477 => 386,  473 => 385,  469 => 384,  465 => 383,  461 => 382,  453 => 376,  451 => 375,  431 => 358,  336 => 268,  315 => 249,  313 => 248,  85 => 23,  80 => 21,  75 => 19,  69 => 16,  61 => 10,  59 => 7,  52 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"en\">

<head>
    <meta charset=\"utf-8\" />
    <title>
        {%- block title -%}
        CiviSmart
        {%- endblock -%}
    </title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta content=\"Career Bridge\" name=\"description\" />
    <meta content=\"Career Bridge\" name=\"author\" />
    
    <!-- App favicon -->
    <link rel=\"shortcut icon\" href=\"{{ asset('Back/images/favicon.ico') }}\">

    <!-- Bootstrap Css -->
    <link href=\"{{ asset('Back/css/bootstrap.min.css') }}\" rel=\"stylesheet\" type=\"text/css\" />
    <!-- Icons Css -->
    <link href=\"{{ asset('Back/css/icons.min.css') }}\" rel=\"stylesheet\" type=\"text/css\" />
    <!-- App Css-->
    <link href=\"{{ asset('Back/css/app.min.css') }}\" rel=\"stylesheet\" type=\"text/css\" />
    
    <style>
        /* Custom Admin Styles */
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --text-primary: #6e84a3;
            --text-secondary: #8492a6;
            --bg-sidebar: #2c3e50;
            --bg-sidebar-active: #34495e;
        }

        body {
            background-color: var(--light-color);
            font-family: 'Nunito', sans-serif;
        }

        /* Sidebar Styles */
        .vertical-menu {
            background: linear-gradient(180deg, var(--bg-sidebar) 0%, var(--bg-sidebar-active) 100%);
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .navbar-brand {
            padding: 1.5rem 1rem;
            color: white;
            font-size: 1.15rem;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            background: rgba(255, 255, 255, 0.05);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .menu-title {
            padding: 0.8rem 1.5rem;
            color: var(--text-secondary);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .nav-link {
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 0.9rem;
            font-weight: 500;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        .nav-link i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Header Styles */
        .header {
            background: white;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e3e6f0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
            padding: 2px;
        }

        .dropdown-toggle {
            color: var(--text-primary);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border: none;
            background: transparent;
        }

        .dropdown-toggle:hover,
        .dropdown-toggle:focus {
            color: var(--primary-color);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            font-size: 0.85rem;
            color: var(--text-primary);
        }

        .dropdown-item:hover {
            background-color: var(--light-color);
            color: var(--primary-color);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            font-size: 1rem;
        }

        /* Content Area */
        .main-content {
            margin-left: 250px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .vertical-menu {
                left: -250px;
            }

            .main-content {
                margin-left: 0;
            }

            body.sidebar-enable .vertical-menu {
                left: 0;
            }

            body.sidebar-enable .main-content {
                margin-left: 250px;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 3px;
        }

        /* Animations */
        .nav-link, .dropdown-item {
            transition: all 0.2s ease;
        }

        /* Sub-menu styles */
        .nav-item .nav-link[data-bs-toggle=\"collapse\"] {
            position: relative;
        }

        .nav-item .nav-link[data-bs-toggle=\"collapse\"]::after {
            content: '\\f107';
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            transition: transform 0.3s ease;
        }

        .nav-item .nav-link[data-bs-toggle=\"collapse\"][aria-expanded=\"true\"]::after {
            transform: rotate(180deg);
        }

        .sub-menu {
            padding-left: 2.5rem;
            background: rgba(0, 0, 0, 0.1);
        }

        .sub-menu .nav-link {
            padding: 0.6rem 1rem;
            font-size: 0.85rem;
        }
    </style>

    {% block stylesheet %}{% endblock %}
</head>

<body>
    <!-- Begin page -->
    <div id=\"layout-wrapper\">
        <!-- ========== Left Sidebar Start ========== -->
        <div class=\"vertical-menu\">
            <a href=\"#\" class=\"navbar-brand\">
                <i class=\"bx bx-bridge\"></i>
                Career Bridge
            </a>

            <div class=\"h-100\">
                <div id=\"sidebar-menu\">
                    <!-- Left Menu Start -->
                    <ul class=\"nav flex-column\" id=\"side-menu\">
                        <li class=\"menu-title\">MENU</li>

                        <li class=\"nav-item\">
                            <a href=\"#\" class=\"nav-link {% if app.request.get('_route') == 'app_home_back' %}active{% endif %}\">
                                <i class=\"bx bx-home-circle\"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#userSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-user\"></i>
                                <span>Users</span>
                            </a>
                            <div class=\"collapse\" id=\"userSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Users</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Add User</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#jobSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-briefcase\"></i>
                                <span>Jobs</span>
                            </a>
                            <div class=\"collapse\" id=\"jobSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Jobs</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Add Job</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#applicationSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-file\"></i>
                                <span>Applications</span>
                            </a>
                            <div class=\"collapse\" id=\"applicationSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">All Applications</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Pending Applications</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class=\"nav-item\">
                            <a href=\"#settingSubmenu\" class=\"nav-link\" data-bs-toggle=\"collapse\">
                                <i class=\"bx bx-cog\"></i>
                                <span>Settings</span>
                            </a>
                            <div class=\"collapse\" id=\"settingSubmenu\">
                                <ul class=\"nav flex-column sub-menu\">
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">General Settings</a>
                                    </li>
                                    <li class=\"nav-item\">
                                        <a href=\"#\" class=\"nav-link\">Email Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class=\"main-content\">
            <header class=\"header\">
                <div class=\"d-flex justify-content-between align-items-center\">
                    <button type=\"button\" class=\"btn btn-link text-dark p-0\" id=\"vertical-menu-btn\">
                        <i class=\"bx bx-menu font-size-24\"></i>
                    </button>

                    <div class=\"user-profile\">
                        <img src=\"{{ asset('Back/images/users/avatar-1.jpg') }}\" alt=\"Header Avatar\">
                        <div class=\"dropdown\">
                            <button class=\"btn dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                <span class=\"d-none d-xl-inline-block ms-1\">Admin</span>
                                <i class=\"bx bx-chevron-down\"></i>
                            </button>
                            <ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">
                                <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-user\"></i> Profile</a></li>
                                <li><a class=\"dropdown-item\" href=\"#\"><i class=\"bx bx-cog\"></i> Settings</a></li>
                                <li><hr class=\"dropdown-divider\"></li>
                                <li><a class=\"dropdown-item text-danger\" href=\"#\"><i class=\"bx bx-power-off\"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            {% block body %}{% endblock %}
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src=\"{{ asset('Back/libs/jquery/jquery.min.js') }}\"></script>
    <script src=\"{{ asset('Back/libs/bootstrap/js/bootstrap.bundle.min.js') }}\"></script>
    <script src=\"{{ asset('Back/libs/metismenu/metisMenu.min.js') }}\"></script>
    <script src=\"{{ asset('Back/libs/simplebar/simplebar.min.js') }}\"></script>
    <script src=\"{{ asset('Back/libs/node-waves/waves.min.js') }}\"></script>

    <script>
        // Toggle sidebar
        document.getElementById('vertical-menu-btn').addEventListener('click', function() {
            document.body.classList.toggle('sidebar-enable');
            if (window.innerWidth >= 992) {
                document.body.classList.toggle('vertical-collpsed');
            }
        });

        // Collapse menu on mobile
        if (window.innerWidth < 992) {
            document.body.classList.add('vertical-collpsed');
        }

        // Active link handling
        document.querySelectorAll('.nav-link').forEach(function(element) {
            element.addEventListener('click', function(e) {
                if (this.getAttribute('data-bs-toggle') !== 'collapse') {
                    document.querySelector('.nav-link.active')?.classList.remove('active');
                    this.classList.add('active');
                }
            });
        });
    </script>

    {% block javascript %}{% endblock %}
</body>
</html> ", "lampadaire/baseBack.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\lampadaire\\baseBack.html.twig");
    }
}
