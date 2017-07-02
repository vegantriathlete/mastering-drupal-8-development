<?php

/* core/themes/seven/templates/status-report-grouped.html.twig */
class __TwigTemplate_aaf05997d2688fe211e7c6e29fe5dccbcfbfc04df9fa67e4884a3627d1ed3a52 extends Twig_Template
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
        $tags = array("for" => 23, "set" => 29, "if" => 35);
        $filters = array();
        $functions = array("attach_library" => 19, "create_attribute" => 34);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for', 'set', 'if'),
                array(),
                array('attach_library', 'create_attribute')
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

        // line 19
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("core/drupal.collapse"), "html", null, true));
        echo "
";
        // line 20
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("seven/drupal.responsive-detail"), "html", null, true));
        echo "

<div class=\"system-status-report\">
  ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["grouped_requirements"]) ? $context["grouped_requirements"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 24
            echo "    <div class=\"system-status-report__requirements-group\">
      <h3 id=\"";
            // line 25
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["group"], "type", array()), "html", null, true));
            echo "\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["group"], "title", array()), "html", null, true));
            echo "</h3>
      ";
            // line 26
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["group"], "items", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["requirement"]) {
                // line 27
                echo "        <details class=\"system-status-report__entry system-status-report__entry--";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["group"], "type", array()), "html", null, true));
                echo " color-";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["group"], "type", array()), "html", null, true));
                echo "\">
          ";
                // line 29
                $context["summary_classes"] = array(0 => "system-status-report__status-title", 1 => ((twig_in_filter($this->getAttribute(                // line 31
$context["group"], "type", array()), array(0 => "warning", 1 => "error"))) ? (("system-status-report__status-icon system-status-report__status-icon--" . $this->getAttribute($context["group"], "type", array()))) : ("")));
                // line 34
                echo "          <summary";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->createAttribute(array("class" => (isset($context["summary_classes"]) ? $context["summary_classes"] : null))), "html", null, true));
                echo " role=\"button\">
            ";
                // line 35
                if ($this->getAttribute($context["requirement"], "severity_title", array())) {
                    // line 36
                    echo "              <span class=\"visually-hidden\">";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["requirement"], "severity_title", array()), "html", null, true));
                    echo "</span>
            ";
                }
                // line 38
                echo "            ";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["requirement"], "title", array()), "html", null, true));
                echo "
          </summary>
          <div class=\"system-status-report__entry__value\">
            ";
                // line 41
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["requirement"], "value", array()), "html", null, true));
                echo "
            ";
                // line 42
                if ($this->getAttribute($context["requirement"], "description", array())) {
                    // line 43
                    echo "              <div class=\"description\">";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["requirement"], "description", array()), "html", null, true));
                    echo "</div>
            ";
                }
                // line 45
                echo "          </div>
        </details>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['requirement'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            echo "    </div>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "core/themes/seven/templates/status-report-grouped.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 50,  120 => 48,  112 => 45,  106 => 43,  104 => 42,  100 => 41,  93 => 38,  87 => 36,  85 => 35,  80 => 34,  78 => 31,  77 => 29,  70 => 27,  66 => 26,  60 => 25,  57 => 24,  53 => 23,  47 => 20,  43 => 19,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to display status report.
 *
 * - grouped_requirements: Contains grouped requirements.
 *   Each group contains:
 *   - title: The title of the group.
 *   - type: The severity of the group.
 *   - items: The requirement instances.
 *     Each requirement item contains:
 *     - title: The title of the requirement.
 *     - value: (optional) The requirement's status.
 *     - description: (optional) The requirement's description.
 *     - severity_title: The title of the severity.
 *     - severity_status: Indicates the severity status.
 */
#}
{{ attach_library('core/drupal.collapse') }}
{{ attach_library('seven/drupal.responsive-detail') }}

<div class=\"system-status-report\">
  {% for group in grouped_requirements %}
    <div class=\"system-status-report__requirements-group\">
      <h3 id=\"{{ group.type }}\">{{ group.title }}</h3>
      {% for requirement in group.items %}
        <details class=\"system-status-report__entry system-status-report__entry--{{ group.type }} color-{{ group.type }}\">
          {%
            set summary_classes = [
              'system-status-report__status-title',
              group.type in ['warning', 'error'] ? 'system-status-report__status-icon system-status-report__status-icon--' ~ group.type
            ]
          %}
          <summary{{ create_attribute({'class': summary_classes}) }} role=\"button\">
            {% if requirement.severity_title  %}
              <span class=\"visually-hidden\">{{ requirement.severity_title }}</span>
            {% endif %}
            {{ requirement.title }}
          </summary>
          <div class=\"system-status-report__entry__value\">
            {{ requirement.value }}
            {% if requirement.description %}
              <div class=\"description\">{{ requirement.description }}</div>
            {% endif %}
          </div>
        </details>
      {% endfor %}
    </div>
  {% endfor %}
</div>
";
    }
}
