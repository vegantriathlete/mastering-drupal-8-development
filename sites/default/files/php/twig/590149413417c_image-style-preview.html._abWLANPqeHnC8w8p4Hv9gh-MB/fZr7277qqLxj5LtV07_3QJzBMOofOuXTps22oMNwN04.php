<?php

/* core/themes/stable/templates/admin/image-style-preview.html.twig */
class __TwigTemplate_37bfb8fb522f780d54e102d76957516cc3706e890d46aa74e743bdcae8404cd7 extends Twig_Template
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
        $filters = array("t" => 34);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array(),
                array('t'),
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

        // line 31
        echo "<div class=\"image-style-preview preview clearfix\">
  ";
        // line 33
        echo "  <div class=\"preview-image-wrapper\">
      ";
        // line 34
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("original")));
        echo " (<a href=\"";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["original"]) ? $context["original"] : null), "url", array()), "html", null, true));
        echo "\">";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("view actual size")));
        echo "</a>)
      <div class=\"preview-image original-image\" style=\"width: ";
        // line 35
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "original", array()), "width", array()), "html", null, true));
        echo "px; height: ";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "original", array()), "height", array()), "html", null, true));
        echo "px;\">
        <a href=\"";
        // line 36
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["original"]) ? $context["original"] : null), "url", array()), "html", null, true));
        echo "\">
          ";
        // line 37
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["original"]) ? $context["original"] : null), "rendered", array()), "html", null, true));
        echo "
        </a>
      <div class=\"height\" style=\"height: ";
        // line 39
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "original", array()), "height", array()), "html", null, true));
        echo "px\"><span>";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["original"]) ? $context["original"] : null), "height", array()), "html", null, true));
        echo "px</span></div>
      <div class=\"width\" style=\"width: ";
        // line 40
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "original", array()), "width", array()), "html", null, true));
        echo "px\"><span>";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["original"]) ? $context["original"] : null), "width", array()), "html", null, true));
        echo "px</span></div>
    </div>
  </div>

  ";
        // line 45
        echo "  <div class=\"preview-image-wrapper\">
    ";
        // line 46
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["style_name"]) ? $context["style_name"] : null), "html", null, true));
        echo " (<a href=\"";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["derivative"]) ? $context["derivative"] : null), "url", array()), "html", null, true));
        echo "?";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["cache_bypass"]) ? $context["cache_bypass"] : null), "html", null, true));
        echo "\">";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("view actual size")));
        echo "</a>)
    <div class=\"preview-image modified-image\" style=\"width: ";
        // line 47
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "derivative", array()), "width", array()), "html", null, true));
        echo "px; height: ";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "derivative", array()), "height", array()), "html", null, true));
        echo "px;\">
      <a href=\"";
        // line 48
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["derivative"]) ? $context["derivative"] : null), "url", array()), "html", null, true));
        echo "?";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["cache_bypass"]) ? $context["cache_bypass"] : null), "html", null, true));
        echo "\">
        ";
        // line 49
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["derivative"]) ? $context["derivative"] : null), "rendered", array()), "html", null, true));
        echo "
      </a>
      <div class=\"height\" style=\"height: ";
        // line 51
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "derivative", array()), "height", array()), "html", null, true));
        echo "px\"><span>";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["derivative"]) ? $context["derivative"] : null), "height", array()), "html", null, true));
        echo "px</span></div>
      <div class=\"width\" style=\"width: ";
        // line 52
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["preview"]) ? $context["preview"] : null), "derivative", array()), "width", array()), "html", null, true));
        echo "px\"><span>";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["derivative"]) ? $context["derivative"] : null), "width", array()), "html", null, true));
        echo "px</span></div>
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/image-style-preview.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 52,  117 => 51,  112 => 49,  106 => 48,  100 => 47,  90 => 46,  87 => 45,  78 => 40,  72 => 39,  67 => 37,  63 => 36,  57 => 35,  49 => 34,  46 => 33,  43 => 31,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display a preview of an image style.
 *
 * Available variables:
 * - style_id: The ID of the image style.
 * - style_name: The name of the image style.
 * - cache_bypass: A timestamp token used to avoid browser caching of images.
 * - original: An associative array containing:
 *   - url: The URL of the original image.
 *   - width: The width in pixels of the original image.
 *   - height: The height in pixels of the original image.
 *   - rendered: The render array for the original image.
 * - derivative: An associative array containing:
 *   - url: The URL of the derivative image.
 *   - width: The width in pixels of the derivative image.
 *   - height: The height in pixels of the derivative image.
 *   - rendered:  The rendered derivative image.
 * - preview: An associative array containing:
 *   - original: An associative array containing:
 *     - width: The width in pixels of the original image in the preview.
 *     - height: The height in pixels of the original image in the preview.
 *   - derivative: An associative array containing:
 *     - width: The width in pixels of the derivative image in the preview.
 *     - height: The height in pixels of the derivative image in the preview.
 *
 * @see template_preprocess_image_style_preview()
 */
#}
<div class=\"image-style-preview preview clearfix\">
  {# Preview of the original image. #}
  <div class=\"preview-image-wrapper\">
      {{ 'original'|t }} (<a href=\"{{ original.url }}\">{{ 'view actual size'|t }}</a>)
      <div class=\"preview-image original-image\" style=\"width: {{ preview.original.width }}px; height: {{ preview.original.height }}px;\">
        <a href=\"{{ original.url }}\">
          {{ original.rendered }}
        </a>
      <div class=\"height\" style=\"height: {{ preview.original.height }}px\"><span>{{ original.height }}px</span></div>
      <div class=\"width\" style=\"width: {{ preview.original.width }}px\"><span>{{ original.width }}px</span></div>
    </div>
  </div>

  {# Derivative of the image style. #}
  <div class=\"preview-image-wrapper\">
    {{ style_name }} (<a href=\"{{ derivative.url }}?{{ cache_bypass }}\">{{ 'view actual size'|t }}</a>)
    <div class=\"preview-image modified-image\" style=\"width: {{ preview.derivative.width }}px; height: {{ preview.derivative.height }}px;\">
      <a href=\"{{ derivative.url }}?{{ cache_bypass }}\">
        {{ derivative.rendered }}
      </a>
      <div class=\"height\" style=\"height: {{ preview.derivative.height }}px\"><span>{{ derivative.height }}px</span></div>
      <div class=\"width\" style=\"width: {{ preview.derivative.width }}px\"><span>{{ derivative.width }}px</span></div>
    </div>
  </div>
</div>
";
    }
}
