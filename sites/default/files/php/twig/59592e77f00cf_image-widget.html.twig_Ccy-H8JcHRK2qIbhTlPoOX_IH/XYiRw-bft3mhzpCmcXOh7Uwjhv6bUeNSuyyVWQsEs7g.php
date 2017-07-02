<?php

/* core/themes/seven/templates/image-widget.html.twig */
class __TwigTemplate_506ee911819ad7d1c1c1568c7873be5c47207642f52ddc30a463650f09ddae8a extends Twig_Template
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
        $tags = array("include" => 11);
        $filters = array();
        $functions = array("attach_library" => 12);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('include'),
                array(),
                array('attach_library')
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

        // line 11
        $this->loadTemplate("@classy/content-edit/image-widget.html.twig", "core/themes/seven/templates/image-widget.html.twig", 11)->display($context);
        // line 12
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("classy/image-widget"), "html", null, true));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/themes/seven/templates/image-widget.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 12,  43 => 11,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for an image field widget.
 *
 * Included from Classy theme.
 *
 * @see template_preprocess_image_widget()
 */
#}
{% include '@classy/content-edit/image-widget.html.twig' %}
{{ attach_library('classy/image-widget') }}
";
    }
}
