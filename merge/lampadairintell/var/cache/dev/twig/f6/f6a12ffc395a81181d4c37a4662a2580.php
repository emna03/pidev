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

/* quartier/index.html.twig */
class __TwigTemplate_866a1d69434b1657d435f7da64e4b830 extends Template
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

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'body' => [$this, 'block_body'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "baseBack.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/index.html.twig"));

        $this->parent = $this->loadTemplate("baseBack.html.twig", "quartier/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
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

        yield "Gestion des Quartiers";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        // line 6
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        .purple-theme {
            background: linear-gradient(135deg, #f5f7ff 0%, #f5effb 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .card-header {
            background: linear-gradient(90deg, #7e57c2 0%, #673ab7 100%);
            color: white;
            border: none;
        }
        
        .table thead th {
            background-color: #9575cd;
            color: white;
            border-color: #7e57c2;
        }
        
        .btn-purple {
            background-color: #673ab7;
            border-color: #5e35b1;
            color: white;
        }
        
        .btn-purple:hover {
            background-color: #5e35b1;
            border-color: #512da8;
            color: white;
        }
        
        .btn-outline-purple {
            color: #673ab7;
            border-color: #673ab7;
        }
        
        .btn-outline-purple:hover {
            background-color: #673ab7;
            color: white;
        }
        
        .action-btn {
            margin: 0 3px;
        }
        
        .page-title {
            color: #512da8;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #673ab7;
            padding-bottom: 0.5rem;
        }
        
        .consumption-high {
            color: #d32f2f;
            font-weight: bold;
        }
        
        .consumption-medium {
            color: #ff8f00;
            font-weight: bold;
        }
        
        .consumption-low {
            color: #388e3c;
            font-weight: bold;
        }
        
        .badge-purple {
            background-color: #673ab7;
            color: white;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 82
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

        // line 83
        yield "<div class=\"purple-theme\">
    <div class=\"container\">
        <div class=\"row mb-4\">
            <div class=\"col\">
                <h1 class=\"page-title\">
                    <i class=\"fas fa-map-marker-alt me-2\"></i>Gestion des Quartiers
                </h1>
            </div>
        </div>
        
        <div class=\"card shadow\">
            <div class=\"card-header d-flex justify-content-between align-items-center\">
                <h5 class=\"mb-0\">
                    <i class=\"fas fa-list me-2\"></i>Liste des Quartiers
                </h5>
              
            </div>
            <div class=\"card-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-striped table-hover align-middle\">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Quartier</th>
                                <th>Consommation Totale</th>
                                <th>Nombre de Lampadaires</th>
                                <th class=\"text-center\">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ";
        // line 113
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["quartiers"]) || array_key_exists("quartiers", $context) ? $context["quartiers"] : (function () { throw new RuntimeError('Variable "quartiers" does not exist.', 113, $this->source); })()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["quartier"]) {
            // line 114
            yield "                                <tr>
                                    <td>
                                        <span class=\"badge badge-purple\">#";
            // line 116
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 116), "html", null, true);
            yield "</span>
                                    </td>
                                    <td>
                                        <strong>";
            // line 119
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "nom", [], "any", false, false, false, 119), "html", null, true);
            yield "</strong>
                                    </td>
                                    <td>
                                        ";
            // line 122
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "consomTot", [], "any", false, false, false, 122) > 2000)) {
                // line 123
                yield "                                            <span class=\"consumption-high\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "consomTot", [], "any", false, false, false, 123), "html", null, true);
                yield " kWh</span>
                                        ";
            } elseif ((CoreExtension::getAttribute($this->env, $this->source,             // line 124
$context["quartier"], "consomTot", [], "any", false, false, false, 124) > 1000)) {
                // line 125
                yield "                                            <span class=\"consumption-medium\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "consomTot", [], "any", false, false, false, 125), "html", null, true);
                yield " kWh</span>
                                        ";
            } else {
                // line 127
                yield "                                            <span class=\"consumption-low\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "consomTot", [], "any", false, false, false, 127), "html", null, true);
                yield " kWh</span>
                                        ";
            }
            // line 129
            yield "                                    </td>
                                    <td>
                                        <span class=\"badge bg-secondary\">";
            // line 131
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "lampadaireCount", [], "any", false, false, false, 131), "html", null, true);
            yield "</span>
                                    </td>
                                    <td class=\"text-center\">
                                        <div class=\"btn-group\" role=\"group\">
                                            <a href=\"";
            // line 135
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quartier_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 135)]), "html", null, true);
            yield "\" class=\"btn btn-sm btn-outline-purple action-btn\" data-bs-toggle=\"tooltip\" title=\"Modifier\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"";
            // line 138
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quartier_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 138)]), "html", null, true);
            yield "\" style=\"display: inline-block;\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 139
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 139))), "html", null, true);
            yield "\">
                                                <button type=\"submit\" class=\"btn btn-sm btn-outline-danger action-btn\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce quartier?')\" data-bs-toggle=\"tooltip\" title=\"Supprimer\">
                                                    <i class=\"fas fa-trash-alt\"></i>
                                                </button>
                                            </form>
                                            <a href=\"#\" class=\"btn btn-sm btn-outline-info action-btn\" data-bs-toggle=\"tooltip\" title=\"Détails\">
                                                <i class=\"fas fa-info-circle\"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            ";
            $context['_iterated'] = true;
        }
        // line 150
        if (!$context['_iterated']) {
            // line 151
            yield "                                <tr>
                                    <td colspan=\"5\" class=\"text-center py-3\">
                                        <div class=\"alert alert-info mb-0\">
                                            <i class=\"fas fa-info-circle me-2\"></i>Aucun quartier trouvé. Créez votre premier quartier !
                                        </div>
                                    </td>
                                </tr>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['quartier'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 159
        yield "                        </tbody>
                    </table>
                </div>
            </div>
            <div class=\"card-footer bg-light\">
                <div class=\"d-flex justify-content-between align-items-center\">
                    <span class=\"text-muted\">Total: ";
        // line 165
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["quartiers"]) || array_key_exists("quartiers", $context) ? $context["quartiers"] : (function () { throw new RuntimeError('Variable "quartiers" does not exist.', 165, $this->source); })())), "html", null, true);
        yield " quartier(s)</span>
                  
                </div>
            </div>
        </div>
    </div>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 174
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 175
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "quartier/index.html.twig";
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
        return array (  368 => 175,  355 => 174,  336 => 165,  328 => 159,  315 => 151,  313 => 150,  297 => 139,  293 => 138,  287 => 135,  280 => 131,  276 => 129,  270 => 127,  264 => 125,  262 => 124,  257 => 123,  255 => 122,  249 => 119,  243 => 116,  239 => 114,  234 => 113,  202 => 83,  189 => 82,  102 => 6,  89 => 5,  66 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'baseBack.html.twig' %}

{% block title %}Gestion des Quartiers{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .purple-theme {
            background: linear-gradient(135deg, #f5f7ff 0%, #f5effb 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .card-header {
            background: linear-gradient(90deg, #7e57c2 0%, #673ab7 100%);
            color: white;
            border: none;
        }
        
        .table thead th {
            background-color: #9575cd;
            color: white;
            border-color: #7e57c2;
        }
        
        .btn-purple {
            background-color: #673ab7;
            border-color: #5e35b1;
            color: white;
        }
        
        .btn-purple:hover {
            background-color: #5e35b1;
            border-color: #512da8;
            color: white;
        }
        
        .btn-outline-purple {
            color: #673ab7;
            border-color: #673ab7;
        }
        
        .btn-outline-purple:hover {
            background-color: #673ab7;
            color: white;
        }
        
        .action-btn {
            margin: 0 3px;
        }
        
        .page-title {
            color: #512da8;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #673ab7;
            padding-bottom: 0.5rem;
        }
        
        .consumption-high {
            color: #d32f2f;
            font-weight: bold;
        }
        
        .consumption-medium {
            color: #ff8f00;
            font-weight: bold;
        }
        
        .consumption-low {
            color: #388e3c;
            font-weight: bold;
        }
        
        .badge-purple {
            background-color: #673ab7;
            color: white;
        }
    </style>
{% endblock %}

{% block body %}
<div class=\"purple-theme\">
    <div class=\"container\">
        <div class=\"row mb-4\">
            <div class=\"col\">
                <h1 class=\"page-title\">
                    <i class=\"fas fa-map-marker-alt me-2\"></i>Gestion des Quartiers
                </h1>
            </div>
        </div>
        
        <div class=\"card shadow\">
            <div class=\"card-header d-flex justify-content-between align-items-center\">
                <h5 class=\"mb-0\">
                    <i class=\"fas fa-list me-2\"></i>Liste des Quartiers
                </h5>
              
            </div>
            <div class=\"card-body\">
                <div class=\"table-responsive\">
                    <table class=\"table table-striped table-hover align-middle\">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom du Quartier</th>
                                <th>Consommation Totale</th>
                                <th>Nombre de Lampadaires</th>
                                <th class=\"text-center\">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% for quartier in quartiers %}
                                <tr>
                                    <td>
                                        <span class=\"badge badge-purple\">#{{ quartier.id }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ quartier.nom }}</strong>
                                    </td>
                                    <td>
                                        {% if quartier.consomTot > 2000 %}
                                            <span class=\"consumption-high\">{{ quartier.consomTot }} kWh</span>
                                        {% elseif quartier.consomTot > 1000 %}
                                            <span class=\"consumption-medium\">{{ quartier.consomTot }} kWh</span>
                                        {% else %}
                                            <span class=\"consumption-low\">{{ quartier.consomTot }} kWh</span>
                                        {% endif %}
                                    </td>
                                    <td>
                                        <span class=\"badge bg-secondary\">{{ quartier.lampadaireCount }}</span>
                                    </td>
                                    <td class=\"text-center\">
                                        <div class=\"btn-group\" role=\"group\">
                                            <a href=\"{{ path('app_quartier_edit', {'id': quartier.id}) }}\" class=\"btn btn-sm btn-outline-purple action-btn\" data-bs-toggle=\"tooltip\" title=\"Modifier\">
                                                <i class=\"fas fa-edit\"></i>
                                            </a>
                                            <form method=\"post\" action=\"{{ path('app_quartier_delete', {'id': quartier.id}) }}\" style=\"display: inline-block;\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ quartier.id) }}\">
                                                <button type=\"submit\" class=\"btn btn-sm btn-outline-danger action-btn\" onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce quartier?')\" data-bs-toggle=\"tooltip\" title=\"Supprimer\">
                                                    <i class=\"fas fa-trash-alt\"></i>
                                                </button>
                                            </form>
                                            <a href=\"#\" class=\"btn btn-sm btn-outline-info action-btn\" data-bs-toggle=\"tooltip\" title=\"Détails\">
                                                <i class=\"fas fa-info-circle\"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            {% else %}
                                <tr>
                                    <td colspan=\"5\" class=\"text-center py-3\">
                                        <div class=\"alert alert-info mb-0\">
                                            <i class=\"fas fa-info-circle me-2\"></i>Aucun quartier trouvé. Créez votre premier quartier !
                                        </div>
                                    </td>
                                </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
            <div class=\"card-footer bg-light\">
                <div class=\"d-flex justify-content-between align-items-center\">
                    <span class=\"text-muted\">Total: {{ quartiers|length }} quartier(s)</span>
                  
                </div>
            </div>
        </div>
    </div>
</div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle=\"tooltip\"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });
    </script>
{% endblock %}", "quartier/index.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\quartier\\index.html.twig");
    }
}
