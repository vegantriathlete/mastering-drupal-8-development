<?php

/* core/themes/stable/templates/admin/admin-block.html.twig */
class __TwigTemplate_289ae0213d7cd07c5750f359e6176d4755723fac80327ed2936482f8573085b5 extends Twig_Template
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
        $tags = array("if" => 16);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
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

        // line 15
        echo "<div class=\"panel\">
  ";
        // line 16
        if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "title", array())) {
            // line 17
            echo "    <h3 class=\"panel__title\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "title", array()), "html", null, true));
            echo "</h3>
  ";
        }
        // line 19
        echo "  ";
        if ($this->getAttribute((isset($context["block"]) ? $context["block"] : null), "content", array())) {
            // line 20
            echo "    <div class=\"panel__content\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "content", array()), "html", null, true));
            echo "</div>
  ";
        } elseif ($this->getAttribute(        // line 21
(isset($context["block"]) ? $context["block"] : null), "description", array())) {
            // line 22
            echo "    <div class=\"panel__description\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["block"]) ? $context["block"] : null), "description", array()), "html", null, true));
            echo "</div>
  ";
        }
        // line 24
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/admin-block.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 24,  64 => 22,  62 => 21,  57 => 20,  54 => 19,  48 => 17,  46 => 16,  43 => 15,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for an administrative block.
 *
 * Available variables:
 * - block: An array of information about the block, including:
 *   - show: A flag indicating if the block should be displayed.
 *   - title: The block title.
 *   - content: (optional) The content of the block.
 *   - description: (optional) A description of the block.
 *     (Description should only be output if content is not available).
 */
#}
<div class=\"panel\">
  {% if block.title %}
    <h3 class=\"panel__title\">{{ block.title }}</h3>
  {% endif %}
  {% if block.content %}
    <div class=\"panel__content\">{{ block.content }}</div>
  {% elseif block.description %}
    <div class=\"panel__description\">{{ block.description }}</div>
  {% endif %}
</div>
";
    }
}
