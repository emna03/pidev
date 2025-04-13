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

/* quartier/show.html.twig */
class __TwigTemplate_61cfaecd4b1cb132dcd1a3e1c5ef9367 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "quartier/show.html.twig", 1);
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

        yield "Détails du Quartier";
        
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
        yield "<h1 class=\"mb-4\">Détails du Quartier</h1>

<div class=\"card\">
    <div class=\"card-header\">
        Quartier n°";
        // line 10
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quartier"]) || array_key_exists("quartier", $context) ? $context["quartier"] : (function () { throw new RuntimeError('Variable "quartier" does not exist.', 10, $this->source); })()), "id", [], "any", false, false, false, 10), "html", null, true);
        yield "
    </div>
    <div class=\"card-body\">
        <table class=\"table table-bordered\">
            <tbody>
               
                <tr>
                    <th scope=\"row\">Nom</th>
                    <td>";
        // line 18
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["quartier"] ?? null), "nom", [], "any", true, true, false, 18) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["quartier"]) || array_key_exists("quartier", $context) ? $context["quartier"] : (function () { throw new RuntimeError('Variable "quartier" does not exist.', 18, $this->source); })()), "nom", [], "any", false, false, false, 18)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quartier"]) || array_key_exists("quartier", $context) ? $context["quartier"] : (function () { throw new RuntimeError('Variable "quartier" does not exist.', 18, $this->source); })()), "nom", [], "any", false, false, false, 18), "html", null, true)) : ("Non spécifié"));
        yield "</td>
                </tr>
                <tr>
                    <th scope=\"row\">Description</th>
                    <td>";
        // line 22
        yield (((CoreExtension::getAttribute($this->env, $this->source, ($context["quartier"] ?? null), "description", [], "any", true, true, false, 22) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, (isset($context["quartier"]) || array_key_exists("quartier", $context) ? $context["quartier"] : (function () { throw new RuntimeError('Variable "quartier" does not exist.', 22, $this->source); })()), "description", [], "any", false, false, false, 22)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["quartier"]) || array_key_exists("quartier", $context) ? $context["quartier"] : (function () { throw new RuntimeError('Variable "quartier" does not exist.', 22, $this->source); })()), "description", [], "any", false, false, false, 22), "html", null, true)) : ("Aucune description"));
        yield "</td>
                </tr>
                <tr>
                    <th scope=\"row\">Nombre de lampadaires</th>
                    <td>";
        // line 26
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["lampCount"]) || array_key_exists("lampCount", $context) ? $context["lampCount"] : (function () { throw new RuntimeError('Variable "lampCount" does not exist.', 26, $this->source); })()), "html", null, true);
        yield "</td>
                </tr>
                
            </tbody>
        </table>
        <a href=\"";
        // line 31
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quartier_show_all");
        yield "\" class=\"btn btn-secondary mt-3\">← Retour à la liste</a>
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
        return "quartier/show.html.twig";
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
        return array (  139 => 31,  131 => 26,  124 => 22,  117 => 18,  106 => 10,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Détails du Quartier{% endblock %}

{% block body %}
<h1 class=\"mb-4\">Détails du Quartier</h1>

<div class=\"card\">
    <div class=\"card-header\">
        Quartier n°{{ quartier.id }}
    </div>
    <div class=\"card-body\">
        <table class=\"table table-bordered\">
            <tbody>
               
                <tr>
                    <th scope=\"row\">Nom</th>
                    <td>{{ quartier.nom ?? 'Non spécifié' }}</td>
                </tr>
                <tr>
                    <th scope=\"row\">Description</th>
                    <td>{{ quartier.description ?? 'Aucune description' }}</td>
                </tr>
                <tr>
                    <th scope=\"row\">Nombre de lampadaires</th>
                    <td>{{ lampCount }}</td>
                </tr>
                
            </tbody>
        </table>
        <a href=\"{{ path('app_quartier_show_all') }}\" class=\"btn btn-secondary mt-3\">← Retour à la liste</a>
    </div>
</div>
{% endblock %}
", "quartier/show.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\quartier\\show.html.twig");
    }
}
