<?php

/* DTUserBundle::layout.html.twig */
class __TwigTemplate_59d83441a1a57fdb5e2713b87a054bc440cdebfc6ddd936ff92ca1063be32a6e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    </head>
    <body>

        <div id=\"content\">
            ";
        // line 11
        $this->displayBlock('body', $context, $blocks);
        // line 12
        echo "        </div>
    </body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo "Test Application";
    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "DTUserBundle::layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  49 => 11,  43 => 6,  37 => 12,  35 => 11,  27 => 6,  21 => 2,);
    }
}
