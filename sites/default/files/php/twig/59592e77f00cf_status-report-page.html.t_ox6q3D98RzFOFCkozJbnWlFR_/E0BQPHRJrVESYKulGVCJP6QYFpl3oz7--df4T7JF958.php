<?php

/* core/themes/seven/templates/status-report-page.html.twig */
class __TwigTemplate_55070e1f6dc4640b26b46aa85388e10b3ab999c48a4b7b29b08e53926f399bd9 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 14, "set" => 15, "for" => 20);
        $filters = array("length" => 14);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'set', 'for'),
                array('length'),
                array()
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setTemplateFile($this->getTemplateName());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 14
        if ((twig_length_filter($this->env, (isset($context["counters"]) ? $context["counters"] : null)) == 3)) {
            // line 15
            echo "  ";
            $context["element_width_class"] = " system-status-report-counters__item--third-width";
        } elseif ((twig_length_filter($this->env,         // line 16
(isset($context["counters"]) ? $context["counters"] : null)) == 2)) {
            // line 17
            echo "  ";
            $context["element_width_class"] = " system-status-report-counters__item--half-width";
        }
        // line 19
        echo "<div class=\"system-status-report-counters\">
  ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["counters"]) ? $context["counters"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["counter"]) {
            // line 21
            echo "    <div class=\"system-status-report-counters__item";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["element_width_class"]) ? $context["element_width_class"] : null), "html", null, true));
            echo "\">
      ";
            // line 22
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $context["counter"], "html", null, true));
            echo "
    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['counter'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 25
        echo "</div>

";
        // line 27
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["general_info"]) ? $context["general_info"] : null), "html", null, true));
        echo "
";
        // line 28
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["requirements"]) ? $context["requirements"] : null), "html", null, true));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/themes/seven/templates/status-report-page.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 28,  79 => 27,  75 => 25,  66 => 22,  61 => 21,  57 => 20,  54 => 19,  50 => 17,  48 => 16,  45 => 15,  43 => 14,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for the status report page.
 *
 * Available variables:
 * - counters: The list of counter elements.
 * - general_info: A render array to create general info element.
 * - requirements: A render array to create requirements table.
 *
 * @see template_preprocess_status_report()
 */
#}
{% if counters|length == 3 %}
  {% set element_width_class = ' system-status-report-counters__item--third-width' %}
{% elseif counters|length == 2 %}
  {% set element_width_class = ' system-status-report-counters__item--half-width' %}
{% endif %}
<div class=\"system-status-report-counters\">
  {% for counter in counters %}
    <div class=\"system-status-report-counters__item{{ element_width_class }}\">
      {{ counter }}
    </div>
  {% endfor %}
</div>

{{ general_info }}
{{ requirements }}
";
    }
}
