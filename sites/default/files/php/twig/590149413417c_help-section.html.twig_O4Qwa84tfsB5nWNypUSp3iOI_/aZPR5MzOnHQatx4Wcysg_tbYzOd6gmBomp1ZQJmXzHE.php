<?php

/* core/themes/classy/templates/misc/help-section.html.twig */
class __TwigTemplate_0d20c0763be39656d51b97b07dc663d7fa13a0083435143c7864231f1df736ad extends Twig_Template
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
        $tags = array("if" => 18, "set" => 20, "for" => 27);
        $filters = array("length" => 20);
        $functions = array();

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if', 'set', 'for'),
                array('length'),
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
        echo "<div class=\"clearfix\">
  <h2>";
        // line 16
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true));
        echo "</h2>
  <p>";
        // line 17
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["description"]) ? $context["description"] : null), "html", null, true));
        echo "</p>
  ";
        // line 18
        if ((isset($context["links"]) ? $context["links"] : null)) {
            // line 19
            echo "    ";
            // line 20
            echo "    ";
            $context["size"] = (int) floor((twig_length_filter($this->env, (isset($context["links"]) ? $context["links"] : null)) / 4));
            // line 21
            echo "    ";
            if ((((isset($context["size"]) ? $context["size"] : null) * 4) < twig_length_filter($this->env, (isset($context["links"]) ? $context["links"] : null)))) {
                // line 22
                echo "      ";
                $context["size"] = ((isset($context["size"]) ? $context["size"] : null) + 1);
                // line 23
                echo "    ";
            }
            // line 24
            echo "
    ";
            // line 26
            echo "    ";
            $context["count"] = 0;
            // line 27
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["links"]) ? $context["links"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
                // line 28
                echo "      ";
                if (((isset($context["count"]) ? $context["count"] : null) == 0)) {
                    // line 29
                    echo "        ";
                    // line 30
                    echo "        <div class=\"layout-column layout-column--quarter\"><ul>
      ";
                }
                // line 32
                echo "      <li>";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $context["link"], "html", null, true));
                echo "</li>
      ";
                // line 33
                $context["count"] = ((isset($context["count"]) ? $context["count"] : null) + 1);
                // line 34
                echo "      ";
                if (((isset($context["count"]) ? $context["count"] : null) >= (isset($context["size"]) ? $context["size"] : null))) {
                    // line 35
                    echo "        ";
                    // line 36
                    echo "        ";
                    $context["count"] = 0;
                    // line 37
                    echo "        </ul></div>
      ";
                }
                // line 39
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['link'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 40
            echo "
    ";
            // line 42
            echo "    ";
            if (((isset($context["count"]) ? $context["count"] : null) > 0)) {
                // line 43
                echo "      </ul></div>
    ";
            }
            // line 45
            echo "  ";
        } else {
            // line 46
            echo "    <p>";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["empty"]) ? $context["empty"] : null), "html", null, true));
            echo "</p>
  ";
        }
        // line 48
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/misc/help-section.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  134 => 48,  128 => 46,  125 => 45,  121 => 43,  118 => 42,  115 => 40,  109 => 39,  105 => 37,  102 => 36,  100 => 35,  97 => 34,  95 => 33,  90 => 32,  86 => 30,  84 => 29,  81 => 28,  76 => 27,  73 => 26,  70 => 24,  67 => 23,  64 => 22,  61 => 21,  58 => 20,  56 => 19,  54 => 18,  50 => 17,  46 => 16,  43 => 15,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for a section of the help page.
 *
 * This implementation divides the links into 4 columns.
 *
 * Available variables:
 * - title: The section title.
 * - description: The description text for the section.
 * - links: Links to display in the section.
 * - empty: Text to display if there are no links.
 */
#}
<div class=\"clearfix\">
  <h2>{{ title }}</h2>
  <p>{{ description }}</p>
  {% if links %}
    {# Calculate the column length, to divide links into 4 columns. #}
    {% set size = links|length // 4 %}
    {% if size * 4 < links|length %}
      {% set size = size + 1 %}
    {% endif %}

    {# Output the links in 4 columns. #}
    {% set count = 0 %}
    {% for link in links %}
      {% if count == 0 %}
        {# Start a new column. #}
        <div class=\"layout-column layout-column--quarter\"><ul>
      {% endif %}
      <li>{{ link }}</li>
      {% set count = count + 1 %}
      {% if count >= size %}
        {# End the current column. #}
        {% set count = 0 %}
        </ul></div>
      {% endif %}
    {% endfor %}

    {# End the last column, if one is open. #}
    {% if count > 0 %}
      </ul></div>
    {% endif %}
  {% else %}
    <p>{{ empty }}</p>
  {% endif %}
</div>
";
    }
}
