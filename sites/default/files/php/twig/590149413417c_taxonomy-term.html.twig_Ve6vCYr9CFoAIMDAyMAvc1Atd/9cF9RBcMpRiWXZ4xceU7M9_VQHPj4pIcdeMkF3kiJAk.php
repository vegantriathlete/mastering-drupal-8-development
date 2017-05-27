<?php

/* core/themes/classy/templates/content/taxonomy-term.html.twig */
class __TwigTemplate_b75825067961de53a565e6ce66b1ce399a452812a47eb9d4cac4b94d4f1cd5b5 extends Twig_Template
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
        $tags = array("set" => 27, "if" => 34);
        $filters = array("clean_class" => 29);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('set', 'if'),
                array('clean_class'),
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

        // line 27
        $context["classes"] = array(0 => "taxonomy-term", 1 => ("vocabulary-" . \Drupal\Component\Utility\Html::getClass($this->getAttribute(        // line 29
(isset($context["term"]) ? $context["term"] : null), "bundle", array()))));
        // line 32
        echo "<div";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute((isset($context["attributes"]) ? $context["attributes"] : null), "setAttribute", array(0 => "id", 1 => ("taxonomy-term-" . $this->getAttribute((isset($context["term"]) ? $context["term"] : null), "id", array()))), "method"), "addClass", array(0 => (isset($context["classes"]) ? $context["classes"] : null)), "method"), "html", null, true));
        echo ">
  ";
        // line 33
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["title_prefix"]) ? $context["title_prefix"] : null), "html", null, true));
        echo "
  ";
        // line 34
        if ( !(isset($context["page"]) ? $context["page"] : null)) {
            // line 35
            echo "    <h2><a href=\"";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["url"]) ? $context["url"] : null), "html", null, true));
            echo "\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["name"]) ? $context["name"] : null), "html", null, true));
            echo "</a></h2>
  ";
        }
        // line 37
        echo "  ";
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["title_suffix"]) ? $context["title_suffix"] : null), "html", null, true));
        echo "
  <div class=\"content\">
    ";
        // line 39
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["content"]) ? $context["content"] : null), "html", null, true));
        echo "
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/content/taxonomy-term.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  71 => 39,  65 => 37,  57 => 35,  55 => 34,  51 => 33,  46 => 32,  44 => 29,  43 => 27,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display a taxonomy term.
 *
 * Available variables:
 * - url: URL of the current term.
 * - name: Name of the current term.
 * - content: Items for the content of the term (fields and description).
 *   Use 'content' to print them all, or print a subset such as
 *   'content.description'. Use the following code to exclude the
 *   printing of a given child element:
 *   @code
 *   {{ content|without('description') }}
 *   @endcode
 * - attributes: HTML attributes for the wrapper.
 * - page: Flag for the full page state.
 * - term: The taxonomy term entity, including:
 *   - id: The ID of the taxonomy term.
 *   - bundle: Machine name of the current vocabulary.
 * - view_mode: View mode, e.g. 'full', 'teaser', etc.
 *
 * @see template_preprocess_taxonomy_term()
 */
#}
{%
  set classes = [
    'taxonomy-term',
    'vocabulary-' ~ term.bundle|clean_class,
  ]
%}
<div{{ attributes.setAttribute('id', 'taxonomy-term-' ~ term.id).addClass(classes) }}>
  {{ title_prefix }}
  {% if not page %}
    <h2><a href=\"{{ url }}\">{{ name }}</a></h2>
  {% endif %}
  {{ title_suffix }}
  <div class=\"content\">
    {{ content }}
  </div>
</div>
";
    }
}
