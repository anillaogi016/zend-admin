<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
		    'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'login',
                    ),
                ),
            ),
			
            'dashboard' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/dashboard/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'Index',
                        'page' => 1,
                    ),
                ),
            ),
			'album' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/album[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ),
					'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'Index',
                    ),
                ),
            ),
			'category' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/category[/:action][/:id][/page/:page][/order_by/:order_by][/:order]',
                    'constraints' => array(
                        'action' => '(?!\bpage\b)(?!\border_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ),
					'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'Index',
                    ),
                ),
            ),
			'addcategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/addcategory',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'add',
                    ),
                ),
            ),
			'editcategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editcategory/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'edit',
                    ),
                ),
            ),
			'deletecategory' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/deletecategory/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Category',
                        'action' => 'delete',
                    ),
                ),
            ),
			'productlist' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/productlist/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'Index',
                        'page' => 1,
                    ),
                ),
            ),
			'userlist' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/userlist/[page/:page]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\User',
                        'action' => 'list',
                        'page' => 1,
                    ),
                ),
            ),
			'edituser' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/edituser/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\User',
                        'action' => 'edituser',
                    ),
                ),
            ),
			'addproduct' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/addproduct',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'add',
                    ),
                ),
            ),
			'editproduct' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editproduct/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'editproduct',
                    ),
                ),
            ),
			'deleteproduct' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/deleteproduct/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'deleteproduct',
                    ),
                ),
            ),
			'viewproduct' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/viewproduct/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Product',
                        'action' => 'viewproduct',
                    ),
                ),
            ),
			'addalbum' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/addalbum',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'add',
                    ),
                ),
            ),
			'editalbum' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editalbum/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'edit',
                    ),
                ),
            ),
			'editimage' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/editimage/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'editimage',
                    ),
                ),
            ),
			'deletealbum' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/deletealbum/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'delete',
                    ),
                ),
            ),
			'viewalbum' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/viewalbum/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Album',
                        'action' => 'viewproduct',
                    ),
                ),
            ),
			'deleteuser' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/deleteuser/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\User',
                        'action' => 'deleteuser',
                    ),
                ),
            ),
			'viewuser' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/viewuser/[:id]',
                    'defaults' => array(
                        'controller' => 'Application\Controller\User',
                        'action' => 'viewuser',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/logout',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'logout',
                    ),
                ),
            ),
            'logout' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/logout',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'logout',
                    ),
                ),
            ),
            'editProfile' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/edit_profile',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Auth',
                        'action' => 'editProfile'
                    ),
                )
            ),
            'forgotPassword' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/forgot_password',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Mailer',
                        'action' => 'forgotPassword',
                    ),
                ),
            ),
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
	    'factories'=>array(
		    'Application\Service\ProductService'=>'Application\Factory\ProductServiceFactory',
		),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
			'Zend\Authentication\AuthenticationService' => 'my_auth_service',
        ),
		'invokables' => array(
			'my_auth_service' => 'Zend\Authentication\AuthenticationService',
		),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\User' => 'Application\Controller\UserController',
			'Application\Controller\Album' => 'Application\Controller\AlbumController',
			'Application\Controller\Category' => 'Application\Controller\CategoryController',
	
        ),
        'factories' => array(
            'Application\Controller\Auth' => 'Application\Factory\AuthControllerFactory',
            'Application\Controller\Product' => 'Application\Factory\ProductControllerFactory',
        )
    ),
    'service_factory' => array(
		'invokables' => array(
		   'Application\Model\AlbumTable' => 'Application\Model\AlbumTable',
		   'Application\Model\CategoryTable' => 'Application\Model\CategoryTable',
		 ),
	),
	'controller_plugins' => array(
        'invokables' => array(
            'CustomPlugin' => 'Application\Controller\Plugin\CustomPlugin',
        )
    ),
	'view_helpers' => array(
        'invokables' => array(
            'CustomHelper' => 'Application\Form\View\Helper\CustomHelper',
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
			 /*'cronroute' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/send_cron_mailers',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Console',
                        'action' => 'sendCronMailers'
                    )
                )
            ),*/
            
            ),
        ),
    ),
);
