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

/* lampadaire/indexc.html.twig */
class __TwigTemplate_3ed4cd8d2e13250ac47ecfe961c30048 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/indexc.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "lampadaire/indexc.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "lampadaire/indexc.html.twig", 1);
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

        yield "Lampadaires publics";
        
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
        yield "<h1>Liste des Lampadaires</h1>

";
        // line 8
        if ( !Twig\Extension\CoreExtension::testEmpty((isset($context["lampadaires"]) || array_key_exists("lampadaires", $context) ? $context["lampadaires"] : (function () { throw new RuntimeError('Variable "lampadaires" does not exist.', 8, $this->source); })()))) {
            // line 9
            yield "    <table class=\"table table-striped\">
        <thead>
            <tr>
                <th>Localisation</th>
                <th>Consommation</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["lampadaires"]) || array_key_exists("lampadaires", $context) ? $context["lampadaires"] : (function () { throw new RuntimeError('Variable "lampadaires" does not exist.', 19, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["lampadaire"]) {
                // line 20
                yield "                <tr>
                    <td>";
                // line 21
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "localisation", [], "any", false, false, false, 21), "html", null, true);
                yield "</td>
                    <td>";
                // line 22
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "consommation", [], "any", false, false, false, 22), "html", null, true);
                yield " kWh</td>
                    <td>
                        ";
                // line 24
                if (CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "etat", [], "any", false, false, false, 24)) {
                    // line 25
                    yield "                            <span class=\"badge bg-success\">Actif</span>
                        ";
                } else {
                    // line 27
                    yield "                            <span class=\"badge bg-danger\">Inactif</span>
                        ";
                }
                // line 29
                yield "                    </td>
                    <td>
                        <a href=\"";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("citizen_lampadaire_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["lampadaire"], "id", [], "any", false, false, false, 31)]), "html", null, true);
                yield "\" class=\"btn btn-primary btn-sm\">Voir</a>
                    </td>
                </tr>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['lampadaire'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            yield "        </tbody>
    </table>
";
        } else {
            // line 38
            yield "    <p>Aucun lampadaire trouvé.</p>
";
        }
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "lampadaire/indexc.html.twig";
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
        return array (  163 => 38,  158 => 35,  148 => 31,  144 => 29,  140 => 27,  136 => 25,  134 => 24,  129 => 22,  125 => 21,  122 => 20,  118 => 19,  106 => 9,  104 => 8,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Lampadaires publics{% endblock %}

{% block body %}
<h1>Liste des Lampadaires</h1>

{% if lampadaires is not empty %}
    <table class=\"table table-striped\">
        <thead>
            <tr>
                <th>Localisation</th>
                <th>Consommation</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {% for lampadaire in lampadaires %}
                <tr>
                    <td>{{ lampadaire.localisation }}</td>
                    <td>{{ lampadaire.consommation }} kWh</td>
                    <td>
                        {% if lampadaire.etat %}
                            <span class=\"badge bg-success\">Actif</span>
                        {% else %}
                            <span class=\"badge bg-danger\">Inactif</span>
                        {% endif %}
                    </td>
                    <td>
                        <a href=\"{{ path('citizen_lampadaire_show', {'id': lampadaire.id}) }}\" class=\"btn btn-primary btn-sm\">Voir</a>
                    </td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% else %}
    <p>Aucun lampadaire trouvé.</p>
{% endif %}
{% endblock %}
", "lampadaire/indexc.html.twig", "C:\\Users\\pc\\Desktop\\pidev\\lampadairintell\\templates\\lampadaire\\indexc.html.twig");
    }
}
