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

/* quartier/show_all.html.twig */
class __TwigTemplate_ad196522b84a954de8d15985b48398dc extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/show_all.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "quartier/show_all.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "quartier/show_all.html.twig", 1);
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

        yield "Tous les Quartiers";
        
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
        yield "<h1 class=\"mb-4\">Liste des Quartiers</h1>

";
        // line 8
        if ( !Twig\Extension\CoreExtension::testEmpty((isset($context["quartiers"]) || array_key_exists("quartiers", $context) ? $context["quartiers"] : (function () { throw new RuntimeError('Variable "quartiers" does not exist.', 8, $this->source); })()))) {
            // line 9
            yield "    <table class=\"table table-striped table-hover\">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Quartier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["quartiers"]) || array_key_exists("quartiers", $context) ? $context["quartiers"] : (function () { throw new RuntimeError('Variable "quartiers" does not exist.', 18, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["quartier"]) {
                // line 19
                yield "                <tr>
                    <td>";
                // line 20
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 20), "html", null, true);
                yield "</td>
                    <td>";
                // line 21
                yield (((CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "nom", [], "any", true, true, false, 21) &&  !(null === CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "nom", [], "any", false, false, false, 21)))) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "nom", [], "any", false, false, false, 21), "html", null, true)) : ("Sans nom"));
                yield "</td>
                    <td>
                        <a href=\"";
                // line 23
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quartier_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["quartier"], "id", [], "any", false, false, false, 23)]), "html", null, true);
                yield "\" class=\"btn btn-sm btn-outline-primary\">
                            Voir
                        </a>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['quartier'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            yield "        </tbody>
    </table>
";
        } else {
            // line 32
            yield "    <div class=\"alert alert-info\">
        Aucun quartier trouvé.
    </div>
";
        }
        // line 36
        yield "
<div class=\"mt-4\">
    <a href=\"";
        // line 38
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_quartier_new");
        yield "\" class=\"btn btn-success\">➕ Ajouter un nouveau quartier</a>
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
        return "quartier/show_all.html.twig";
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
        return array (  160 => 38,  156 => 36,  150 => 32,  145 => 29,  133 => 23,  128 => 21,  124 => 20,  121 => 19,  117 => 18,  106 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Tous les Quartiers{% endblock %}

{% block body %}
<h1 class=\"mb-4\">Liste des Quartiers</h1>

{% if quartiers is not empty %}
    <table class=\"table table-striped table-hover\">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Quartier</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {% for quartier in quartiers %}
                <tr>
                    <td>{{ quartier.id }}</td>
                    <td>{{ quartier.nom ?? 'Sans nom' }}</td>
                    <td>
                        <a href=\"{{ path('app_quartier_show', {'id': quartier.id}) }}\" class=\"btn btn-sm btn-outline-primary\">
                            Voir
                        </a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% else %}
    <div class=\"alert alert-info\">
        Aucun quartier trouvé.
    </div>
{% endif %}

<div class=\"mt-4\">
    <a href=\"{{ path('app_quartier_new') }}\" class=\"btn btn-success\">➕ Ajouter un nouveau quartier</a>
</div>
{% endblock %}
", "quartier/show_all.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\quartier\\show_all.html.twig");
    }
}
