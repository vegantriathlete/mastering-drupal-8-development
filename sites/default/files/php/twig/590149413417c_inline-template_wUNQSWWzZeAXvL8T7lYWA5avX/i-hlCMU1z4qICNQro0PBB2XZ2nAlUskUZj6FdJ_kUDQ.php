<?php

/* {# inline_template_start #}<a href="#" role="button" aria-label="{{ button_separator_text }}" class="ckeditor-separator"></a> */
class __TwigTemplate_ccebd9f03dea86296ed5614b7414711c58b47ab230ad1ad32bf3e9e19647e238 extends Twig_Template
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
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
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

        // line 1
        echo "<a href=\"#\" role=\"button\" aria-label=\"";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["button_separator_text"]) ? $context["button_separator_text"] : null), "html", null, true));
        echo "\" class=\"ckeditor-separator\"></a>";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<a href=\"#\" role=\"button\" aria-label=\"{{ button_separator_text }}\" class=\"ckeditor-separator\"></a>";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSource()
    {
        return "{# inline_template_start #}<a href=\"#\" role=\"button\" aria-label=\"{{ button_separator_text }}\" class=\"ckeditor-separator\"></a>";
    }
}
