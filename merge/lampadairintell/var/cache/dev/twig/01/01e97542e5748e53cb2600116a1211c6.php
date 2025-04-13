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

/* lampadaire/show.html.twig */
class __TwigTemplate_cf15093658b8965429c7c40508555da5 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/show.html.twig"));

        $this->parent = $this->loadTemplate("baseBack.html.twig", "lampadaire/show.html.twig", 1);
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

        yield "Lampadaire Details";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
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

        // line 6
        yield "    <div class=\"container py-4\">
        <h2 class=\"mb-4\">Streetlight Details</h2>

        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                <table class=\"table\">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>";
        // line 15
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 15, $this->source); })()), "id", [], "any", false, false, false, 15), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 19, $this->source); })()), "localisation", [], "any", false, false, false, 19), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class=\"badge ";
        // line 24
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 24, $this->source); })()), "etat", [], "any", false, false, false, 24)) {
            yield "bg-success";
        } else {
            yield "bg-secondary";
        }
        yield "\">
                                    ";
        // line 25
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 25, $this->source); })()), "etat", [], "any", false, false, false, 25)) ? ("On") : ("Off"));
        yield "
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Consumption</th>
                            <td>";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 31, $this->source); })()), "consommation", [], "any", false, false, false, 31), "html", null, true);
        yield " W</td>
                        </tr>
                        <tr>
                            <th>District ID</th>
                            <td>";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 35, $this->source); })()), "idQuartier", [], "any", false, false, false, 35), "html", null, true);
        yield "</td>
                        </tr>
                        <tr>
                            <th>Installation Date</th>
                            <td>";
        // line 39
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 39, $this->source); })()), "dateInstallation", [], "any", false, false, false, 39)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 39, $this->source); })()), "dateInstallation", [], "any", false, false, false, 39), "Y-m-d"), "html", null, true)) : ("N/A"));
        yield "</td>
                        </tr>
                    </tbody>
                </table>

                <div class=\"mt-4 d-flex gap-2\">
                    <a href=\"";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 45, $this->source); })()), "id", [], "any", false, false, false, 45)]), "html", null, true);
        yield "\" class=\"btn btn-outline-warning\">Edit</a>
                    <a href=\"";
        // line 46
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_lampadaire_index");
        yield "\" class=\"btn btn-outline-secondary\">Back to list</a>
                </div>
            </div>
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
        return "lampadaire/show.html.twig";
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
        return array (  170 => 46,  166 => 45,  157 => 39,  150 => 35,  143 => 31,  134 => 25,  126 => 24,  118 => 19,  111 => 15,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'baseBack.html.twig' %}

{% block title %}Lampadaire Details{% endblock %}

{% block body %}
    <div class=\"container py-4\">
        <h2 class=\"mb-4\">Streetlight Details</h2>

        <div class=\"card shadow-sm\">
            <div class=\"card-body\">
                <table class=\"table\">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>{{ lampadaire.id }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ lampadaire.localisation }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class=\"badge {% if lampadaire.etat %}bg-success{% else %}bg-secondary{% endif %}\">
                                    {{ lampadaire.etat ? 'On' : 'Off' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Consumption</th>
                            <td>{{ lampadaire.consommation }} W</td>
                        </tr>
                        <tr>
                            <th>District ID</th>
                            <td>{{ lampadaire.idQuartier }}</td>
                        </tr>
                        <tr>
                            <th>Installation Date</th>
                            <td>{{ lampadaire.dateInstallation ? lampadaire.dateInstallation|date('Y-m-d') : 'N/A' }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class=\"mt-4 d-flex gap-2\">
                    <a href=\"{{ path('app_lampadaire_edit', {'id': lampadaire.id}) }}\" class=\"btn btn-outline-warning\">Edit</a>
                    <a href=\"{{ path('app_lampadaire_index') }}\" class=\"btn btn-outline-secondary\">Back to list</a>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
", "lampadaire/show.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\lampadaire\\show.html.twig");
    }
}
