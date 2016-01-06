<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Form\ProductFieldset;
use Zend\ModuleManger\Feature\FormElementProviderInerface;

use Application\Model\Auth;
use Application\Model\UserTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\CategoryTable;
use Application\Model\AlbumTable;


class Module
{
    public function onBootstrap(MvcEvent $e)
    {
		$eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
		    'Zend\Loader\ClassMapAutoloader' => array(
					__DIR__ . '/autoload_classmap.php',
				),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
					'Lib' => __DIR__ . '/../../vendor/Lib'
                ),
            ),
        );
    }
	public function getFormElementConfig() {
		return array(
			'factories' => array(
				'ProductFieldset' => function($sm) {
					$serviceLocator = $sm->getServiceLocator();
					$dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
					$fieldset = new Form\ProductFieldset($dbAdapter);
					return $fieldset;
				}
			)
		);
    }
	public function getServiceConfig(){
		
		return array(
		    'factories'=>array(
			    'Application\Model\MyAuthStorage'=>function($sm){
					return new \Application\Model\MyAuthStorage('zf_tutorial');
				},
				'Application\Model\AlbumTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table = new AlbumTable($dbAdapter);
                    return $table;
                },
				'Application\Model\CategoryTable' =>  function($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $table1 = new CategoryTable($dbAdapter);
                    return $table1;
                },
			),
		);
	}
}
