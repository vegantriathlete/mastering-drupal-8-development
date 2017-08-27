<?php

/* core/themes/stable/templates/admin/language-negotiation-configure-form.html.twig */
class __TwigTemplate_aaf6a1dbbb09c5a45737ebd7cd1bb6083c098e3a41bbe74a6c1eaf66d9a07357 extends Twig_Template
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
        $tags = array("for" => 21, "set" => 23);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for', 'set'),
                array(),
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

        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["language_types"]) ? $context["language_types"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["language_type"]) {
            // line 22
            echo "  ";
            // line 23
            $context["language_classes"] = array(0 => "js-form-item", 1 => "form-item", 2 => "table-language-group", 3 => (("table-" . $this->getAttribute(            // line 27
$context["language_type"], "type", array())) . "-wrapper"));
            // line 30
            echo "  <div";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["language_type"], "attributes", array()), "addClass", array(0 => (isset($context["language_classes"]) ? $context["language_classes"] : null)), "method"), "html", null, true));
            echo ">
    <h2>";
            // line 31
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["language_type"], "title", array()), "html", null, true));
            echo "</h2>
    <div class=\"description\">";
            // line 32
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["language_type"], "description", array()), "html", null, true));
            echo "</div>
    ";
            // line 33
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["language_type"], "configurable", array()), "html", null, true));
            echo "
    ";
            // line 34
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["language_type"], "table", array()), "html", null, true));
            echo "
    ";
            // line 35
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["language_type"], "children", array()), "html", null, true));
            echo "
  </div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language_type'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["children"]) ? $context["children"] : null), "html", null, true));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/language-negotiation-configure-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  82 => 38,  73 => 35,  69 => 34,  65 => 33,  61 => 32,  57 => 31,  52 => 30,  50 => 27,  49 => 23,  47 => 22,  43 => 21,);
    }

    public function getSource()
    {
        return "{#
/**
* @file
* Theme override for a language negotiation configuration form.
*
* Available variables:
* - language_types: A list of language negotiation types. Each language type
*   contains the following:
*   - type: The machine name for the negotiation type.
*   - title: The language negotiation type name.
*   - description: A description for how the language negotiation type operates.
*   - configurable: A radio element to toggle the table.
*   - table: A draggable table for the language detection methods of this type.
*   - children: Remaining form items for the group.
*   - attributes: A list of HTML attributes for the wrapper element.
* - children: Remaining form items for all groups.
*
* @see template_preprocess_language_negotiation_configure_form()
*/
#}
{% for language_type in language_types %}
  {%
    set language_classes = [
      'js-form-item',
      'form-item',
      'table-language-group',
      'table-' ~ language_type.type ~ '-wrapper',
    ]
  %}
  <div{{ language_type.attributes.addClass(language_classes) }}>
    <h2>{{ language_type.title }}</h2>
    <div class=\"description\">{{ language_type.description }}</div>
    {{ language_type.configurable }}
    {{ language_type.table }}
    {{ language_type.children }}
  </div>
{% endfor %}
{{ children }}
";
    }
}
