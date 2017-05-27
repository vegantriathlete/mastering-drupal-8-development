<?php

/* core/themes/stable/templates/admin/image-scale-summary.html.twig */
class __TwigTemplate_b5b0ff029877f5d12a8c25443e559ed316decc03cb64772d8c2bcf0d50ca9208 extends Twig_Template
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
        $tags = array("if" => 17, "trans" => 21);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'trans'),
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

        // line 17
        if (($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "width", array()) && $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "height", array()))) {
            // line 18
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "width", array()), "html", null, true));
            echo "×";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["data"]) ? $context["data"] : null), "height", array()), "html", null, true));
        } else {
            // line 20
            if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "width", array())) {
                // line 21
                echo "    ";
                echo t("width @data.width", array("@data.width" => $this->getAttribute(                // line 22
(isset($context["data"]) ? $context["data"] : null), "width", array()), ));
                // line 24
                echo "  ";
            } elseif ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "height", array())) {
                // line 25
                echo "    ";
                echo t("height @data.height", array("@data.height" => $this->getAttribute(                // line 26
(isset($context["data"]) ? $context["data"] : null), "height", array()), ));
                // line 28
                echo "  ";
            }
        }
        // line 30
        echo "
";
        // line 31
        if ($this->getAttribute((isset($context["data"]) ? $context["data"] : null), "upscale", array())) {
            // line 32
            echo "  ";
            echo t("(upscaling allowed)", array());
        }
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/image-scale-summary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 32,  70 => 31,  67 => 30,  63 => 28,  61 => 26,  59 => 25,  56 => 24,  54 => 22,  52 => 21,  50 => 20,  45 => 18,  43 => 17,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for a summary of an image scale effect.
 *
 * Available variables:
 * - data: The current configuration for this resize effect, including:
 *   - width: The width of the resized image.
 *   - height: The height of the resized image.
 *   - upscale: If images larger than their original size can scale.
 * - effect: The effect information, including:
 *   - id: The effect identifier.
 *   - label: The effect name.
 *   - description: The effect description.
 */
#}
{% if data.width and data.height -%}
  {{ data.width }}×{{ data.height }}
{%- else -%}
  {% if data.width %}
    {% trans %}
      width {{ data.width }}
    {% endtrans %}
  {% elseif data.height %}
    {% trans %}
      height {{ data.height }}
    {% endtrans %}
  {% endif %}
{%- endif %}

{% if data.upscale %}
  {% trans %}
    (upscaling allowed)
  {% endtrans %}
{% endif %}
";
    }
}
