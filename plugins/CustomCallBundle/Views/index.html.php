<?php
// plugins/HelloWorldBundle/Views/World/index.html.php

// Extend the base content
$view->extend('MauticCoreBundle:Default:content.html.php');

// Get tmpl from sub-template
$tmpl = $view['slots']->get('tmpl', 'Details');

// Tell Mautic to call JS onLoad method
$view['slots']->set('mauticContent', 'helloWorld'.$tmpl);

// Set the page and header title
$header = ($tmpl == 'World')
    ? $view['translator']->trans(
        'plugin.helloworld.worlds',
        array('%world%' => ucfirst($world))
    ) : $view['translator']->trans('plugin.helloworld.manage_worlds');
$view['slots']->set('headerTitle', $header);
?>

<div class="helloworld-content">
    <?php $view['slots']->output('_content'); ?>
</div>

<?php

// Extends the full document with menu, page header, etc
$view->extend('MauticCoreBundle:Default:content.html.php');

// Extends the "slim" document which includes just the head and body with main content; does not include menu, page header, etc.
$view->extend('MauticCoreBundle:Default:content.html.php');

?>