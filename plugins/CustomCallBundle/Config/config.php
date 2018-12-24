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
                'path'       => '/call/{call}',
                'controller' => 'CustomCallBundle:Call:index',
                'defaults'    => array(
                    'call' => 'call'
                ),
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
            'priority' => 4,
            'items'    => array(
                'plugin.customcall.index' => array(
                    'id'        => 'plugin_helloworld_index',
                    'iconClass' => 'fa-globe',
                    'access'    => 'plugin:helloworld:worlds:view',
                    'parent'    => 'mautic.core.channels',
                    'children'  => array(
                        'plugin.customcall.manage_worlds'     => array(
                            'route' => 'plugin_helloworld_list'
                        ),
                        'mautic.category.menu.index' => array(
                            'bundle' => 'plugin:helloWorld'
                        )
                    )
                )
            )
        ),
        'admin' => array(
            'plugin.customcall.admin' => array(
                'route'     => 'plugin_customcall_admin',
                'iconClass' => 'fa-gears',
                'access'    => 'admin',
                'checks'    => array(
                    'parameters' => array(
                        'customcall_api_enabled' => true
                    )
                ),
                'priority'  => 60
            )
        )
    ),

    'services'    => array(
        'models' =>  [
            'mautic.helloworld.model.world' => [
                'class' => 'MauticPlugin\HelloWorldBundle\Model\WorldModel',
                'arguments' => [
                    'mautic.factory'
                ]
                
        ],
        ],
        
        'events' => array(
            'plugin.helloworld.leadbundle.subscriber' => array(
                'class' => 'MauticPlugin\HelloWorldBundle\EventListener\LeadSubscriber'
            )
        ),
        'forms'  => array(
            'plugin.helloworld.form' => array(
                'class' => 'MauticPlugin\HelloWorldBundle\Form\Type\HelloWorldType',
                'alias' => 'helloworld'
            )
        ),
        'helpers' => array(
            'mautic.helper.helloworld' => array(
                'class'     => 'MauticPlugin\HelloWorldBundle\Helper\HelloWorldHelper',
                'alias'     => 'helloworld'
            )
        ),
        'other'   => array(
            'plugin.helloworld.mars.validator' => array(
                'class'     => 'MauticPlugin\HelloWorldBundle\Form\Validator\Constraints\MarsValidator',
                'arguments' => 'mautic.factory',
                'tag'       => 'validator.constraint_validator',
                'alias'     => 'helloworld_mars'
            )
        )
    ),

    'categories' => array(
        'plugin:helloWorld' => 'mautic.helloworld.world.categories'
    ),

    'parameters' => array(
        'helloworld_api_enabled' => false
    )

    );