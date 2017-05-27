<?php

/* core/themes/stable/templates/admin/system-modules-uninstall.html.twig */
class __TwigTemplate_c0020fb71206992830619f6a33228d7a693adbde8ee09ecd9f371a13d9fc824d extends Twig_Template
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
        $tags = array("for" => 33, "set" => 34, "if" => 44, "trans" => 46);
        $filters = array("t" => 27, "safe_join" => 57, "without" => 73);
        $functions = array("cycle" => 34);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('for', 'set', 'if', 'trans'),
                array('t', 'safe_join', 'without'),
                array('cycle')
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

        // line 22
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute((isset($context["form"]) ? $context["form"] : null), "filters", array()), "html", null, true));
        echo "

<table class=\"responsive-enabled\" data-striping=\"1\">
  <thead>
    <tr>
      <th>";
        // line 27
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Uninstall")));
        echo "</th>
      <th>";
        // line 28
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Name")));
        echo "</th>
      <th>";
        // line 29
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Description")));
        echo "</th>
    </tr>
  </thead>
  <tbody>
    ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["modules"]) ? $context["modules"] : null));
        $context['_iterated'] = false;
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
            // line 34
            echo "      ";
            $context["zebra"] = twig_cycle(array(0 => "odd", 1 => "even"), $this->getAttribute($context["loop"], "index0", array()));
            // line 35
            echo "<tr";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["module"], "attributes", array()), "addClass", array(0 => (isset($context["zebra"]) ? $context["zebra"] : null)), "method"), "html", null, true));
            echo ">
        <td align=\"center\">";
            // line 37
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["module"], "checkbox", array()), "html", null, true));
            // line 38
            echo "</td>
        <td>
          <label for=\"";
            // line 40
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["module"], "checkbox_id", array()), "html", null, true));
            echo "\" class=\"module-name table-filter-text-source\">";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["module"], "name", array()), "html", null, true));
            echo "</label>
        </td>
        <td class=\"description\">
          <span class=\"text module-description\">";
            // line 43
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->getAttribute($context["module"], "description", array()), "html", null, true));
            echo "</span>
          ";
            // line 44
            if (($this->getAttribute($context["module"], "reasons_count", array()) > 0)) {
                // line 45
                echo "            <div class=\"admin-requirements\">";
                // line 46
                echo \Drupal::translation()->formatPlural(abs($this->getAttribute(                // line 48
$context["module"], "reasons_count", array())), "The following reason prevents @module.module_name from being uninstalled:", "The following reasons prevent @module.module_name from being uninstalled:", array("@module.module_name" => $this->getAttribute(                // line 47
$context["module"], "module_name", array()), "@module.module_name" => $this->getAttribute(                // line 49
$context["module"], "module_name", array()), ));
                // line 51
                echo "              <div class=\"item-list\">
                <ul>";
                // line 53
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["module"], "validation_reasons", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["reason"]) {
                    // line 54
                    echo "<li>";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $context["reason"], "html", null, true));
                    echo "</li>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['reason'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 56
                if ($this->getAttribute($context["module"], "required_by", array())) {
                    // line 57
                    echo "<li>";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Required by: @module-list", array("@module-list" => $this->env->getExtension('drupal_core')->safeJoin($this->env, $this->getAttribute($context["module"], "required_by", array()), ", ")))));
                    echo "</li>";
                }
                // line 59
                echo "</ul>
              </div>
            </div>
          ";
            }
            // line 63
            echo "        </td>
      </tr>
    ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        if (!$context['_iterated']) {
            // line 66
            echo "      <tr class=\"odd\">
        <td colspan=\"3\" class=\"empty message\">";
            // line 67
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("No modules are available to uninstall.")));
            echo "</td>
      </tr>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 70
        echo "  </tbody>
</table>

";
        // line 73
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, twig_without((isset($context["form"]) ? $context["form"] : null), "filters", "modules", "uninstall"), "html", null, true));
        echo "
";
    }

    public function getTemplateName()
    {
        return "core/themes/stable/templates/admin/system-modules-uninstall.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 73,  174 => 70,  165 => 67,  162 => 66,  147 => 63,  141 => 59,  136 => 57,  134 => 56,  126 => 54,  122 => 53,  119 => 51,  117 => 49,  116 => 47,  115 => 48,  114 => 46,  112 => 45,  110 => 44,  106 => 43,  98 => 40,  94 => 38,  92 => 37,  87 => 35,  84 => 34,  66 => 33,  59 => 29,  55 => 28,  51 => 27,  43 => 22,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override for the modules uninstall page.
 *
 * Available variables:
 * - form: The modules uninstall form.
 * - modules: Contains multiple module instances. Each module contains:
 *   - attributes: Attributes on the row.
 *   - module_name: The name of the module.
 *   - checkbox: A checkbox for uninstalling the module.
 *   - checkbox_id: A unique identifier for interacting with the checkbox
 *     element.
 *   - name: The human-readable name of the module.
 *   - description: The description of the module.
 *   - disabled_reasons: (optional) A list of reasons why this module cannot be
 *     uninstalled.
 *
 * @see template_preprocess_system_modules_uninstall()
 */
#}
{{ form.filters }}

<table class=\"responsive-enabled\" data-striping=\"1\">
  <thead>
    <tr>
      <th>{{ 'Uninstall'|t }}</th>
      <th>{{ 'Name'|t }}</th>
      <th>{{ 'Description'|t }}</th>
    </tr>
  </thead>
  <tbody>
    {% for module in modules %}
      {% set zebra = cycle(['odd', 'even'], loop.index0) -%}
      <tr{{ module.attributes.addClass(zebra) }}>
        <td align=\"center\">
          {{- module.checkbox -}}
        </td>
        <td>
          <label for=\"{{ module.checkbox_id }}\" class=\"module-name table-filter-text-source\">{{ module.name }}</label>
        </td>
        <td class=\"description\">
          <span class=\"text module-description\">{{ module.description }}</span>
          {% if module.reasons_count > 0 %}
            <div class=\"admin-requirements\">
              {%- trans -%}
                The following reason prevents {{ module.module_name }} from being uninstalled:
              {%- plural module.reasons_count -%}
                The following reasons prevent {{ module.module_name }} from being uninstalled:
              {%- endtrans %}
              <div class=\"item-list\">
                <ul>
                  {%- for reason in module.validation_reasons -%}
                    <li>{{ reason }}</li>
                  {%- endfor -%}
                  {%- if module.required_by -%}
                    <li>{{ 'Required by: @module-list'|t({'@module-list': module.required_by|safe_join(', ') }) }}</li>
                  {%- endif -%}
                </ul>
              </div>
            </div>
          {% endif %}
        </td>
      </tr>
    {% else %}
      <tr class=\"odd\">
        <td colspan=\"3\" class=\"empty message\">{{ 'No modules are available to uninstall.'|t }}</td>
      </tr>
    {% endfor %}
  </tbody>
</table>

{{ form|without('filters', 'modules', 'uninstall') }}
";
    }
}
