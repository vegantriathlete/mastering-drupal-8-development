<?php

/* core/themes/seven/templates/status-report-counter.html.twig */
class __TwigTemplate_0fba2c0016838398b367c1ef7e2e8c5b4923ef35c3695c61413c93b1ee7bcb97 extends Twig_Template
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
        $tags = array("set" => 15);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set'),
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
        $context["classes"] = array(0 => "system-status-counter", 1 => ("system-status-counter--" .         // line 17
(isset($context["severity"]) ? $context["severity"] : null)));
        // line 20
        echo "<span";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  <span class=\"system-status-counter__status-icon system-status-counter__status-icon--";
        // line 21
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["severity"]) ? $context["severity"] : null), "html", null, true));
        echo "\"></span>
  <span class=\"system-status-counter__status-title\">
    <span class=\"system-status-counter__title-count\">";
        // line 23
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["amount"]) ? $context["amount"] : null), "html", null, true));
        echo " ";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["text"]) ? $context["text"] : null), "html", null, true));
        echo "</span>
    <span class=\"system-status-counter__details\"><a href=\"#";
        // line 24
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["severity"]) ? $context["severity"] : null), "html", null, true));
        echo "\" ><span class=\"visually-hidden\">";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["text"]) ? $context["text"] : null), "html", null, true));
        echo " </span>Details</a></span>
  </span>
</span>
";
    }

    public function getTemplateName()
    {
        return "core/themes/seven/templates/status-report-counter.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 24,  56 => 23,  51 => 21,  46 => 20,  44 => 17,  43 => 15,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for status report counter.
 *
 * Available variables:
 * - amount: The number shown on counter.
 * - text: The text shown on counter.
 * - severity: The severity of the counter.
 *
 * @ingroup themable
 */
#}
{%
  set classes = [
    'system-status-counter',
    'system-status-counter--' ~ severity,
  ]
%}
<span{{ attributes.addClass(classes) }}>
  <span class=\"system-status-counter__status-icon system-status-counter__status-icon--{{ severity }}\"></span>
  <span class=\"system-status-counter__status-title\">
    <span class=\"system-status-counter__title-count\">{{ amount }} {{ text }}</span>
    <span class=\"system-status-counter__details\"><a href=\"#{{ severity }}\" ><span class=\"visually-hidden\">{{ text }} </span>Details</a></span>
  </span>
</span>
";
    }
}
