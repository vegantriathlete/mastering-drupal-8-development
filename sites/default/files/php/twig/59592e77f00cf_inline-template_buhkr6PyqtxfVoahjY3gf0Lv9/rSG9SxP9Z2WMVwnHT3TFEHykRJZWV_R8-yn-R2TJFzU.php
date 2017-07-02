<?php

/* {# inline_template_start #}<code>/node/{node}</code>: GET, PATCH, DELETE</br><code>/entity/node</code>: POST */
class __TwigTemplate_7a89418d63f1cc9f4d6493c078a415a3add37a6275b869fa06de1e4b1410e77b extends Twig_Template
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
        echo "<code>/node/{node}</code>: GET, PATCH, DELETE</br><code>/entity/node</code>: POST";
    }

    public function getTemplateName()
    {
        return "{# inline_template_start #}<code>/node/{node}</code>: GET, PATCH, DELETE</br><code>/entity/node</code>: POST";
    }

    public function getDebugInfo()
    {
        return array (  43 => 1,);
    }

    public function getSource()
    {
        return "{# inline_template_start #}<code>/node/{node}</code>: GET, PATCH, DELETE</br><code>/entity/node</code>: POST";
    }
}
