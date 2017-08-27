<?php

/* core/themes/stable/templates/admin/views-ui-display-tab-setting.html.twig */
class __TwigTemplate_0837b1dd901ab1b9ddb45589a6da0356de91ea8c4d2bc531b78866ce7f086223 extends Twig_Template
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
        $tags = array("set" => 20, "if" => 29);
        $filters = array("safe_join" => 33);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set', 'if'),
                array('safe_join'),
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
        $context["classes"] = array(0 => "views-display-setting", 1 => "clearfix", 2 => "views-ui-display-tab-setting", 3 => ((        // line 24
(isset($context["defaulted"]) ? $context["defaulted"] : null)) ? ("defaulted") : ("")), 4 => ((        // line 25
(isset($context["overridden"]) ? $context["overridden"] : null)) ? ("overridden") : ("")));
        // line 28
        echo "<div";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  ";
        // line 29
        if ((isset($context["description"]) ? $context["description"] : null)) {
            // line 30
            echo "<span class=\"label\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["description"]) ? $context["description"] : null), "html", null, true));
            echo "</span>";
        }
        // line 32
        echo "  ";
        if ((isset($context["settings_links"]) ? $context["settings_links"] : null)) {
            // line 33
            echo "    ";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar($this->env->getExtension('drupal_core')->safeJoin($this->env, (isset($context["settings_links"]) ? $context["settings_links"] : null), "<span class=\"label\">&nbsp;|&nbsp;</span>")));
            echo "
  ";
        }
        // line 35
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/views-ui-display-tab-setting.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 35,  62 => 33,  59 => 32,  54 => 30,  52 => 29,  47 => 28,  45 => 25,  44 => 24,  43 => 20,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for Views UI display tab settings.
 *
 * Template for each row inside the \"boxes\" on the display query edit screen.
 *
 * Available variables:
 * - attributes: HTML attributes such as class for the container.
 * - description: The description or label for this setting.
 * - settings_links: A list of links for this setting.
 * - defaulted: A boolean indicating the setting is in its default state.
 * - overridden: A boolean indicating the setting has been overridden from the
 *   default.
 *
 * @see template_preprocess_views_ui_display_tab_setting()
 */
#}
{%
  set classes = [
    'views-display-setting',
    'clearfix',
    'views-ui-display-tab-setting',
    defaulted ? 'defaulted',
    overridden ? 'overridden',
]
%}
<div{{ attributes.addClass(classes) }}>
  {% if description -%}
    <span class=\"label\">{{ description }}</span>
  {%- endif %}
  {% if settings_links %}
    {{ settings_links|safe_join('<span class=\"label\">&nbsp;|&nbsp;</span>') }}
  {% endif %}
</div>
";
    }
}
