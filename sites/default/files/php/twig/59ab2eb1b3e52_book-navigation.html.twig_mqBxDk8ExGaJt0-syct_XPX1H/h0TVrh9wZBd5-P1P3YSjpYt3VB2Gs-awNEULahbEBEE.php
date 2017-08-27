<?php

/* core/themes/classy/templates/navigation/book-navigation.html.twig */
class __TwigTemplate_b95faa2d6c558c11ddc96ad5b59d8d93401e37c8e2d02f0a99cf1d28a9c1b383 extends Twig_Template
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
        $tags = array("if" => 32);
        $filters = array("t" => 36);
        $functions = array("attach_library" => 31);

        try {
            $this->env->getExtension('sandbox')->checkSecurity(
                array('if'),
                array('t'),
                array('attach_library')
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
        echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, $this->env->getExtension('drupal_core')->attachLibrary("classy/book-navigation"), "html", null, true));
        echo "
";
        // line 32
        if (((isset($context["tree"]) ? $context["tree"] : null) || (isset($context["has_links"]) ? $context["has_links"] : null))) {
            // line 33
            echo "  <nav id=\"book-navigation-";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["book_id"]) ? $context["book_id"] : null), "html", null, true));
            echo "\" class=\"book-navigation\" role=\"navigation\" aria-labelledby=\"book-label-";
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["book_id"]) ? $context["book_id"] : null), "html", null, true));
            echo "\">
    ";
            // line 34
            echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["tree"]) ? $context["tree"] : null), "html", null, true));
            echo "
    ";
            // line 35
            if ((isset($context["has_links"]) ? $context["has_links"] : null)) {
                // line 36
                echo "      <h2 class=\"visually-hidden\" id=\"book-label-";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["book_id"]) ? $context["book_id"] : null), "html", null, true));
                echo "\">";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Book traversal links for")));
                echo " ";
                echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["book_title"]) ? $context["book_title"] : null), "html", null, true));
                echo "</h2>
      <ul class=\"book-pager\">
      ";
                // line 38
                if ((isset($context["prev_url"]) ? $context["prev_url"] : null)) {
                    // line 39
                    echo "        <li class=\"book-pager__item book-pager__item--previous\">
          <a href=\"";
                    // line 40
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["prev_url"]) ? $context["prev_url"] : null), "html", null, true));
                    echo "\" rel=\"prev\" title=\"";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Go to previous page")));
                    echo "\"><b>";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("‹")));
                    echo "</b> ";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["prev_title"]) ? $context["prev_title"] : null), "html", null, true));
                    echo "</a>
        </li>
      ";
                }
                // line 43
                echo "      ";
                if ((isset($context["parent_url"]) ? $context["parent_url"] : null)) {
                    // line 44
                    echo "        <li class=\"book-pager__item book-pager__item--center\">
          <a href=\"";
                    // line 45
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["parent_url"]) ? $context["parent_url"] : null), "html", null, true));
                    echo "\" title=\"";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Go to parent page")));
                    echo "\">";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Up")));
                    echo "</a>
        </li>
      ";
                }
                // line 48
                echo "      ";
                if ((isset($context["next_url"]) ? $context["next_url"] : null)) {
                    // line 49
                    echo "        <li class=\"book-pager__item book-pager__item--next\">
          <a href=\"";
                    // line 50
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["next_url"]) ? $context["next_url"] : null), "html", null, true));
                    echo "\" rel=\"next\" title=\"";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("Go to next page")));
                    echo "\">";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->escapeFilter($this->env, (isset($context["next_title"]) ? $context["next_title"] : null), "html", null, true));
                    echo " <b>";
                    echo $this->env->getExtension('sandbox')->ensureToStringAllowed($this->env->getExtension('drupal_core')->renderVar(t("›")));
                    echo "</b></a>
        </li>
      ";
                }
                // line 53
                echo "    </ul>
    ";
            }
            // line 55
            echo "  </nav>
";
        }
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/navigation/book-navigation.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 55,  123 => 53,  111 => 50,  108 => 49,  105 => 48,  95 => 45,  92 => 44,  89 => 43,  77 => 40,  74 => 39,  72 => 38,  62 => 36,  60 => 35,  56 => 34,  49 => 33,  47 => 32,  43 => 31,);
    }

    public function getSource()
    {
        return "{#
/**
 * @file
 * Theme override to navigate books.
 *
 * Presented under nodes that are a part of book outlines.
 *
 * Available variables:
 * - tree: The immediate children of the current node rendered as an unordered
 *   list.
 * - current_depth: Depth of the current node within the book outline. Provided
 *   for context.
 * - prev_url: URL to the previous node.
 * - prev_title: Title of the previous node.
 * - parent_url: URL to the parent node.
 * - parent_title: Title of the parent node. Not printed by default. Provided
 *   as an option.
 * - next_url: URL to the next node.
 * - next_title: Title of the next node.
 * - has_links: Flags TRUE whenever the previous, parent or next data has a
 *   value.
 * - book_id: The book ID of the current outline being viewed. Same as the node
 *   ID containing the entire outline. Provided for context.
 * - book_url: The book/node URL of the current outline being viewed. Provided
 *   as an option. Not used by default.
 * - book_title: The book/node title of the current outline being viewed.
 *
 * @see template_preprocess_book_navigation()
 */
#}
{{ attach_library('classy/book-navigation') }}
{% if tree or has_links %}
  <nav id=\"book-navigation-{{ book_id }}\" class=\"book-navigation\" role=\"navigation\" aria-labelledby=\"book-label-{{ book_id }}\">
    {{ tree }}
    {% if has_links %}
      <h2 class=\"visually-hidden\" id=\"book-label-{{ book_id }}\">{{ 'Book traversal links for'|t }} {{ book_title }}</h2>
      <ul class=\"book-pager\">
      {% if prev_url %}
        <li class=\"book-pager__item book-pager__item--previous\">
          <a href=\"{{ prev_url }}\" rel=\"prev\" title=\"{{ 'Go to previous page'|t }}\"><b>{{ '‹'|t }}</b> {{ prev_title }}</a>
        </li>
      {% endif %}
      {% if parent_url %}
        <li class=\"book-pager__item book-pager__item--center\">
          <a href=\"{{ parent_url }}\" title=\"{{ 'Go to parent page'|t }}\">{{ 'Up'|t }}</a>
        </li>
      {% endif %}
      {% if next_url %}
        <li class=\"book-pager__item book-pager__item--next\">
          <a href=\"{{ next_url }}\" rel=\"next\" title=\"{{ 'Go to next page'|t }}\">{{ next_title }} <b>{{ '›'|t }}</b></a>
        </li>
      {% endif %}
    </ul>
    {% endif %}
  </nav>
{% endif %}
";
    }
}
