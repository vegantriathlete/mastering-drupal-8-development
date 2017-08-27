<?php

/* core/themes/stable/templates/admin/views-ui-view-displays-list.html.twig */
class __TwigTemplate_3f0403d2194f880cb9d4dbb525e0a23b2a87976df9081fca679dea7a532b00f8 extends Twig_Template
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
        $tags = array("for" => 13, "if" => 15);
        $filters = array();
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for', 'if'),
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

        // line 12
        echo "<ul>
  ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["displays"]) ? $context["displays"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["display"]) {
            // line 14
            echo "    <li>
      ";
            // line 15
            if ($this->getAttribute($context["display"], "path", array())) {
                // line 16
                echo "        ";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["display"], "display", array()), "html", null, true));
                echo " <span data-drupal-selector=\"views-table-filter-text-source\">(";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["display"], "path", array()), "html", null, true));
                echo ")</span>
      ";
            } else {
                // line 18
                echo "        ";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["display"], "display", array()), "html", null, true));
                echo "
      ";
            }
            // line 20
            echo "    </li>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['display'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "</ul>
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/views-ui-view-displays-list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  76 => 22,  69 => 20,  63 => 18,  55 => 16,  53 => 15,  50 => 14,  46 => 13,  43 => 12,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for views displays on the views listing page.
 *
 * Available variables:
 * - displays: Contains multiple display instances. Each display contains:
 *   - display: Display name.
 *   - path: Path to display, if any.
 */
#}
<ul>
  {% for display in displays %}
    <li>
      {% if display.path %}
        {{ display.display }} <span data-drupal-selector=\"views-table-filter-text-source\">({{ display.path }})</span>
      {% else %}
        {{ display.display }}
      {% endif %}
    </li>
  {% endfor %}
</ul>
";
    }
}
