<?php

/* core/themes/stable/templates/admin/views-ui-expose-filter-form.html.twig */
class __TwigTemplate_4acc67414614e62a4892534987c69986b2b0c894dd1ff79863b1c98f2e1bfb5a extends Twig_Template
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
        $tags = array("if" => 30, "set" => 40);
        $filters = array("without" => 40);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'set'),
                array('without'),
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

        // line 20
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "form_description", array()), "html", null, true));
        echo "
";
        // line 21
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "expose_button", array()), "html", null, true));
        echo "
";
        // line 22
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "group_button", array()), "html", null, true));
        echo "
";
        // line 23
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "required", array()), "html", null, true));
        echo "
";
        // line 24
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "label", array()), "html", null, true));
        echo "
";
        // line 25
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "description", array()), "html", null, true));
        echo "

";
        // line 27
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "operator", array()), "html", null, true));
        echo "
";
        // line 28
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "value", array()), "html", null, true));
        echo "

";
        // line 30
        if ($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "use_operator", array())) {
            // line 31
            echo "  <div class=\"views-left-40\">
  ";
            // line 32
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "use_operator", array()), "html", null, true));
            echo "
  </div>
";
        }
        // line 35
        echo "
";
        // line 40
        $context["remaining_form"] = twig_without((isset($context["form"]) ? $context["form"] : null), "form_description", "expose_button", "group_button", "required", "label", "description", "operator", "value", "use_operator", "more");
        // line 53
        echo "
";
        // line 57
        if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "operator", array()), "#type", array(), "array")) {
            // line 58
            echo "  <div class=\"views-right-60\">
  ";
            // line 59
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["remaining_form"]) ? $context["remaining_form"] : null), "html", null, true));
            echo "
  </div>
";
        } else {
            // line 62
            echo "  ";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["remaining_form"]) ? $context["remaining_form"] : null), "html", null, true));
            echo "
";
        }
        // line 64
        echo "
";
        // line 65
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "more", array()), "html", null, true));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/views-ui-expose-filter-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 65,  113 => 64,  107 => 62,  101 => 59,  98 => 58,  96 => 57,  93 => 53,  91 => 40,  88 => 35,  82 => 32,  79 => 31,  77 => 30,  72 => 28,  68 => 27,  63 => 25,  59 => 24,  55 => 23,  51 => 22,  47 => 21,  43 => 20,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for exposed filter form.
 *
 * Available variables:
 * - form_description: The exposed filter's description.
 * - expose_button: The button to toggle the expose filter form.
 * - group_button: Toggle options between single and grouped filters.
 * - required: A checkbox to require this filter or not.
 * - label: A filter label input field.
 * - description: A filter description field.
 * - operator: The operators for how the filters value should be treated.
 *   - #type: The operator type.
 * - value: The filters available values.
 * - use_operator: Checkbox to allow the user to expose the operator.
 * - more: A details element for additional field exposed filter fields.
 */
#}
{{ form.form_description }}
{{ form.expose_button }}
{{ form.group_button }}
{{ form.required }}
{{ form.label }}
{{ form.description }}

{{ form.operator }}
{{ form.value }}

{% if form.use_operator %}
  <div class=\"views-left-40\">
  {{ form.use_operator }}
  </div>
{% endif %}

{#
  Collect a list of elements printed to exclude when printing the
  remaining elements.
#}
{% set remaining_form = form|without(
  'form_description',
  'expose_button',
  'group_button',
  'required',
  'label',
  'description',
  'operator',
  'value',
  'use_operator',
  'more'
  )
%}

{#
  Only output the right column markup if there's a left column to begin with.
#}
{% if form.operator['#type'] %}
  <div class=\"views-right-60\">
  {{ remaining_form }}
  </div>
{% else %}
  {{ remaining_form }}
{% endif %}

{{ form.more }}
";
    }
}
