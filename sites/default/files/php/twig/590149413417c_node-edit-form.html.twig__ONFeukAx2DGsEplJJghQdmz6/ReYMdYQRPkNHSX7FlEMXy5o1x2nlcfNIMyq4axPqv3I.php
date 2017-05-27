<?php

/* core/themes/classy/templates/content-edit/node-edit-form.html.twig */
class __TwigTemplate_3a5aac7a2c9bc920e75b32fba7eee6185dced5fc1415920d0ca718c8a6680dd6 extends Twig_Template
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
        $tags = array();
        $filters = array("without" => 20);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
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

        // line 18
        echo "<div class=\"layout-node-form clearfix\">
  <div class=\"layout-region layout-region-node-main\">
    ";
        // line 20
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, twig_without((isset($context["form"]) ? $context["form"] : null), "advanced", "actions"), "html", null, true));
        echo "
  </div>
  <div class=\"layout-region layout-region-node-secondary\">
    ";
        // line 23
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "advanced", array()), "html", null, true));
        echo "
  </div>
  <div class=\"layout-region layout-region-node-footer\">
    ";
        // line 26
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "actions", array()), "html", null, true));
        echo "
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/content-edit/node-edit-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 26,  53 => 23,  47 => 20,  43 => 18,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for a node edit form.
 *
 * Two column template for the node add/edit form.
 *
 * This template will be used when a node edit form specifies 'node_edit_form'
 * as its #theme callback.  Otherwise, by default, node add/edit forms will be
 * themed by form.html.twig.
 *
 * Available variables:
 * - form: The node add/edit form.
 *
 * @see seven_form_node_form_alter()
 */
#}
<div class=\"layout-node-form clearfix\">
  <div class=\"layout-region layout-region-node-main\">
    {{ form|without('advanced', 'actions') }}
  </div>
  <div class=\"layout-region layout-region-node-secondary\">
    {{ form.advanced }}
  </div>
  <div class=\"layout-region layout-region-node-footer\">
    {{ form.actions }}
  </div>
</div>
";
    }
}
