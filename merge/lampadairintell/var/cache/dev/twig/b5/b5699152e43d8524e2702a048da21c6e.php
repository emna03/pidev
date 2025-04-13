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

/* lampadaire/showc.html.twig */
class __TwigTemplate_9b9e8685de16b499a49f2d3ea0e05619 extends Template
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
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/showc.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/showc.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "lampadaire/showc.html.twig", 1);
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

        yield "Détails du Lampadaire";
        
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
        yield "<h1 class=\"mb-4\">Détails du Lampadaire</h1>

<div class=\"card\">
    <div class=\"card-header\">
        Lampadaire n°";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 10, $this->source); })()), "id", [], "any", false, false, false, 10), "html", null, true);
        yield "
    </div>
    <div class=\"card-body\">
        <table class=\"table table-bordered\">
            <tbody>
                <tr>
                    <th scope=\"row\">ID</th>
                    <td>";
        // line 17
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 17, $this->source); })()), "id", [], "any", false, false, false, 17), "html", null, true);
        yield "</td>
                </tr>
                <tr>
                    <th scope=\"row\">Localisation</th>
                    <td>";
        // line 21
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 21, $this->source); })()), "localisation", [], "any", false, false, false, 21), "html", null, true);
        yield "</td>
                </tr>
                <tr>
                    <th scope=\"row\">État</th>
                    <td>
                        ";
        // line 26
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 26, $this->source); })()), "etat", [], "any", false, false, false, 26)) {
            // line 27
            yield "                            <span class=\"badge bg-success\">Fonctionnel</span>
                        ";
        } else {
            // line 29
            yield "                            <span class=\"badge bg-danger\">Hors service</span>
                        ";
        }
        // line 31
        yield "                    </td>
                </tr>
                <tr>
                    <th scope=\"row\">Consommation</th>
                    <td>";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["lampadaire"]) || array_key_exists("lampadaire", $context) ? $context["lampadaire"] : (function () { throw new RuntimeError('Variable "lampadaire" does not exist.', 35, $this->source); })()), "consommation", [], "any", false, false, false, 35), "html", null, true);
        yield " kWh</td>
                </tr>
            
            </tbody>
        </table>
        <a href=\"";
        // line 40
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("citizen_lampadaire_index");
        yield "\" class=\"btn btn-secondary\">← Retour à la liste</a>
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
        return "lampadaire/showc.html.twig";
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
        return array (  155 => 40,  147 => 35,  141 => 31,  137 => 29,  133 => 27,  131 => 26,  123 => 21,  116 => 17,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails du Lampadaire{% endblock %}

{% block body %}
<h1 class=\"mb-4\">Détails du Lampadaire</h1>

<div class=\"card\">
    <div class=\"card-header\">
        Lampadaire n°{{ lampadaire.id }}
    </div>
    <div class=\"card-body\">
        <table class=\"table table-bordered\">
            <tbody>
                <tr>
                    <th scope=\"row\">ID</th>
                    <td>{{ lampadaire.id }}</td>
                </tr>
                <tr>
                    <th scope=\"row\">Localisation</th>
                    <td>{{ lampadaire.localisation }}</td>
                </tr>
                <tr>
                    <th scope=\"row\">État</th>
                    <td>
                        {% if lampadaire.etat %}
                            <span class=\"badge bg-success\">Fonctionnel</span>
                        {% else %}
                            <span class=\"badge bg-danger\">Hors service</span>
                        {% endif %}
                    </td>
                </tr>
                <tr>
                    <th scope=\"row\">Consommation</th>
                    <td>{{ lampadaire.consommation }} kWh</td>
                </tr>
            
            </tbody>
        </table>
        <a href=\"{{ path('citizen_lampadaire_index') }}\" class=\"btn btn-secondary\">← Retour à la liste</a>
    </div>
</div>
{% endblock %}
", "lampadaire/showc.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\lampadaire\\showc.html.twig");
    }
}
