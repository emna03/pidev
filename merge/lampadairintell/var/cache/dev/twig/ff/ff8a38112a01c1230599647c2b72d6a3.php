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

/* lampadaire/index.html.twig */
class __TwigTemplate_29bcc202b7d1d904e88023ec3b48b739 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/index.html.twig"));

        $this->parent = $this->loadTemplate("baseBack.html.twig", "lampadaire/index.html.twig", 1);
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

        yield "Streetlight Management";
        
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
        .table thead th {
            white-space: nowrap;
        }
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 18
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

        // line 19
        yield "    <div class=\"container py-4\">
        <div class=\"d-flex justify-content-between align-items-center mb-4\">
            <h2 class=\"m-0\">Streetlight Management</h2>
            <a href=\"";
        // line 22
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_new");
        yield "\" class=\"btn btn-primary\">Add New Streetlight</a>
        </div>

        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                ";
        // line 27
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["lampadaires"]) || array_key_exists("lampadaires", $context) ? $context["lampadaires"] : (function () { throw new RuntimeError('Variable "lampadaires" does not exist.', 27, $this->source); })())) > 0)) {
            // line 28
            yield "                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th scope=\"col\">ID</th>
                                    <th scope=\"col\">Location</th>
                                    <th scope=\"col\">Status</th>
                                    <th scope=\"col\">Consumption</th>
                                    <th scope=\"col\">District ID</th>
                                    <th scope=\"col\">Installation Date</th>
                                    <th scope=\"col\" class=\"text-center\">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            ";
            // line 42
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["lampadaires"]) || array_key_exists("lampadaires", $context) ? $context["lampadaires"] : (function () { throw new RuntimeError('Variable "lampadaires" does not exist.', 42, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["lampadaire"]) {
                // line 43
                yield "                                <tr>
                                    <td>";
                // line 44
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 44), "html", null, true);
                yield "</td>
                                    <td>";
                // line 45
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "localisation", [], "any", false, false, false, 45), "html", null, true);
                yield "</td>
                                    <td>
                                        <span class=\"badge ";
                // line 47
                if (CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "etat", [], "any", false, false, false, 47)) {
                    yield "bg-success";
                } else {
                    yield "bg-secondary";
                }
                yield "\">
                                            ";
                // line 48
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "etat", [], "any", false, false, false, 48)) ? ("On") : ("Off"));
                yield "
                                        </span>
                                    </td>
                                    <td>";
                // line 51
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "consommation", [], "any", false, false, false, 51), "html", null, true);
                yield " W</td>
                                    <td>";
                // line 52
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "idQuartier", [], "any", false, false, false, 52), "html", null, true);
                yield "</td>
                                    <td>";
                // line 53
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "dateInstallation", [], "any", false, false, false, 53)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "dateInstallation", [], "any", false, false, false, 53), "Y-m-d"), "html", null, true)) : ("N/A"));
                yield "</td>
                                    <td>
                                        <div class=\"d-flex justify-content-center gap-2\">
                                            <a href=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-primary\">Details</a>
                                            <a href=\"";
                // line 57
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 57)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-warning\">Edit</a>
                                            <form method=\"post\" action=\"";
                // line 58
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 58)]), "html", null, true);
                yield "\" onsubmit=\"return confirm('Are you sure you want to delete this streetlight?');\" class=\"d-inline\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
                // line 59
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 59))), "html", null, true);
                yield "\">
                                                <button class=\"btn btn-sm btn-outline-danger\">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['lampadaire'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            yield "                            </tbody>
                        </table>
                    </div>
                ";
        } else {
            // line 70
            yield "                    <div class=\"text-center py-5\">
                        <p class=\"text-muted mb-3\">No streetlights have been added yet.</p>
                        <a href=\"";
            // line 72
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_new");
            yield "\" class=\"btn btn-outline-primary\">Add your first streetlight</a>
                    </div>
                ";
        }
        // line 75
        yield "            </div>
        </div>
    </div>
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
        return "lampadaire/index.html.twig";
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
        return array (  253 => 75,  247 => 72,  243 => 70,  237 => 66,  224 => 59,  220 => 58,  216 => 57,  212 => 56,  206 => 53,  202 => 52,  198 => 51,  192 => 48,  184 => 47,  179 => 45,  175 => 44,  172 => 43,  168 => 42,  152 => 28,  150 => 27,  142 => 22,  137 => 19,  124 => 18,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'baseBack.html.twig' %}

{% block title %}Streetlight Management{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        .table thead th {
            white-space: nowrap;
        }
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
{% endblock %}

{% block body %}
    <div class=\"container py-4\">
        <div class=\"d-flex justify-content-between align-items-center mb-4\">
            <h2 class=\"m-0\">Streetlight Management</h2>
            <a href=\"{{ path('app_lampadaire_new') }}\" class=\"btn btn-primary\">Add New Streetlight</a>
        </div>

        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                {% if lampadaires|length > 0 %}
                    <div class=\"table-responsive\">
                        <table class=\"table table-hover\">
                            <thead class=\"table-light\">
                                <tr>
                                    <th scope=\"col\">ID</th>
                                    <th scope=\"col\">Location</th>
                                    <th scope=\"col\">Status</th>
                                    <th scope=\"col\">Consumption</th>
                                    <th scope=\"col\">District ID</th>
                                    <th scope=\"col\">Installation Date</th>
                                    <th scope=\"col\" class=\"text-center\">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            {% for lampadaire in lampadaires %}
                                <tr>
                                    <td>{{ lampadaire.id }}</td>
                                    <td>{{ lampadaire.localisation }}</td>
                                    <td>
                                        <span class=\"badge {% if lampadaire.etat %}bg-success{% else %}bg-secondary{% endif %}\">
                                            {{ lampadaire.etat ? 'On' : 'Off' }}
                                        </span>
                                    </td>
                                    <td>{{ lampadaire.consommation }} W</td>
                                    <td>{{ lampadaire.idQuartier }}</td>
                                    <td>{{ lampadaire.dateInstallation ? lampadaire.dateInstallation|date('Y-m-d') : 'N/A' }}</td>
                                    <td>
                                        <div class=\"d-flex justify-content-center gap-2\">
                                            <a href=\"{{ path('app_lampadaire_show', {'id': lampadaire.id}) }}\" class=\"btn btn-sm btn-outline-primary\">Details</a>
                                            <a href=\"{{ path('app_lampadaire_edit', {'id': lampadaire.id}) }}\" class=\"btn btn-sm btn-outline-warning\">Edit</a>
                                            <form method=\"post\" action=\"{{ path('app_lampadaire_delete', {'id': lampadaire.id}) }}\" onsubmit=\"return confirm('Are you sure you want to delete this streetlight?');\" class=\"d-inline\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ lampadaire.id) }}\">
                                                <button class=\"btn btn-sm btn-outline-danger\">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            {% endfor %}
                            </tbody>
                        </table>
                    </div>
                {% else %}
                    <div class=\"text-center py-5\">
                        <p class=\"text-muted mb-3\">No streetlights have been added yet.</p>
                        <a href=\"{{ path('app_lampadaire_new') }}\" class=\"btn btn-outline-primary\">Add your first streetlight</a>
                    </div>
                {% endif %}
            </div>
        </div>
    </div>
{% endblock %}
", "lampadaire/index.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\lampadaire\\index.html.twig");
    }
}
