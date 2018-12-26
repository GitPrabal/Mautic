<?php
//plugins/HelloWorldBundle/Views/World/details.html.php

// Check if the request is Ajax

if (!$app->getRequest()->isXmlHttpRequest()) {

    // Set tmpl for parent template
    $view['slots']->set('tmpl', 'Call Centre');

    // Extend index.html.php as the parent
    $view->extend('CustomCallBundle:Call:index.html.php');
}
?>

<div>
    <!-- Desired content/markup -->
</div>