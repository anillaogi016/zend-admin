<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Factory;

use  Application\Controller\AuthController;
use  Zend\ServiceManager\FactoryInterface;
use  Zend\ServiceManager\ServiceLocatorInterface;

class AuthControllerFactory implements FactoryInterface{
	
	public function createService(ServiceLocatorInterface $serviceLocator){
		$realServiceLocator=$serviceLocator->getServiceLocator();
		$adminLoginForm=$realServiceLocator->get('FormElementManager')->get('Application\Form\AdminForm');
		return new AuthController($adminLoginForm);
	}
}