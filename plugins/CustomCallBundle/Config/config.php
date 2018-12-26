<?php
// plugins/HelloWorldBundle/Config/config.php

return array(
    'name'        => 'Custom Call',
    'description' => 'This is an example config file for a simple Hellow World plugin.',
    'author'      => 'Marty Mautibot',
    'version'     => '1.0.0',

    'routes'   => array(
        'main' => array(
            'plugin_customcall' => array(
                'path'       => '/call',
                'controller' => 'CustomCallBundle:Call:index',
                'defaults'    => array(
                    'call' => 'call'
                ),
            ),
            'ddi_lead_actions_call_index' => array(
                'path' => '/call',
                'controller' => 'CustomCallBundle:Call:index'
            ),
            'mautic_customcall_default_action'       => array(
                'path'       => '/call/{objectAction}/{objectId}',
                'controller' => 'CustomCallBundle:Call:execute'
            ),
            'plugin_customcall_list'  => array(
                'path'       => '/call/{page}',
                'controller' => 'CustomCallBundle:Call:index'
             ),
            'plugin_customcall_admin' => array(
                'path'       => '/call/admin',
                'controller' => 'CustomCallBundle:Call:admin'
            ),
        ),
        'public' => array(
            'plugin_customcall_goodbye' => array(
                'path'       => '/call/goodbye',
                'controller' => 'CustomCallBundle:Call:goodbye'
            ),
            'plugin_customcall_contact' => array(
                'path'       => '/call/contact',
                'controller' => 'CustomCallBundle:Call:contact'
            )
        ),
        'api' => array(
            'plugin_customcall_api' => array(
                'path'       => '/call',
                'controller' => 'CustomCallBundle:Call:howdy',
                'method'     => 'GET'
            )
        )
    ),

    'menu'     => array(
        'main' => array(
            'priority' => 1,
            'items'    => array(
                'customcall.call' => array(
                    'id'        => 'Call Centre',
                    'iconClass' => 'fa-phone',
                    'access'    => 'plugin:customcall:call:view',
                    'route' => 'plugin_customcall'
                )
            )
        ),
        'admin' => array(
            'plugin.customcall.admin' => array(
                'route'     => 'plugin_customcall_admin',
                'iconClass' => 'fa-gears',
                'access'    => 'admin',
                'priority'  => 60
            )
        )
    ),

    'services'    => array(
        'models' =>  [
            'mautic.customcall.model.call' => [
                'class' => 'MauticPlugin\CustomCallBundle\Model\CallModel',
                'arguments' => [
                    'mautic.factory'
                ]
                
        ],
        ],
        
        'events' => array(
            'plugin.customcall.leadbundle.subscriber' => array(
                'class' => 'MauticPlugin\CustomCallBundle\EventListener\LeadSubscriber'
            )
        ),
        'forms'  => array(
            'plugin.customcall.form' => array(
                'class' => 'MauticPlugin\CustomCallBundle\Form\Type\HelloWorldType',
                'alias' => 'helloworld'
            )
        ),
        'helpers' => array(
            'mautic.helper.customcall' => array(
                'class'     => 'MauticPlugin\CustomCallBundle\Helper\HelloWorldHelper',
                'alias'     => 'helloworld'
            )
        ),
        'other'   => array(
            'plugin.helloworld.mars.validator' => array(
                'class'     => 'MauticPlugin\CustomCallBundle\Form\Validator\Constraints\MarsValidator',
                'arguments' => 'mautic.factory',
                'tag'       => 'validator.constraint_validator',
                'alias'     => 'helloworld_mars'
            )
        )
    ),

    'categories' => array(
        'plugin:helloWorld' => 'mautic.customcall.world.categories'
    ),

    'parameters' => array(
        'customcall_api_enabled' => false
    )

    );