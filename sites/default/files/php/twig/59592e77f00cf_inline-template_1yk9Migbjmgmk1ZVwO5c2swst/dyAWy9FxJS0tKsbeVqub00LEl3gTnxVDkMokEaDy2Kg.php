<?php

/* {# inline_template_start #}<code>/admin/structure/menu/item/{menu_link_content}/edit</code>: GET, PATCH, DELETE</br><code>/entity/menu_link_content</code>: POST */
class __TwigTemplate_0c5576cfce89002e0559dde9f0a3c77e82da3fbd7eb046f5ff129f4b25bfadcb extends Twig_Template
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
        echo "<code>/admin/structure/menu/item/{menu_link_content}/edit</code>: GET, PATCH, DELETE</br><code>/entity/menu_link_content</code>: POST";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<code>/admin/structure/menu/item/{menu_link_content}/edit</code>: GET, PATCH, DELETE</br><code>/entity/menu_link_content</code>: POST";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSource()
    {
        return "{# inline_template_start #}<code>/admin/structure/menu/item/{menu_link_content}/edit</code>: GET, PATCH, DELETE</br><code>/entity/menu_link_content</code>: POST";
    }
}
