<?php

namespace Application\Factory;

use  Application\Controller\UserController;
use  Zend\ServiceManager\FactoryInterface;
use  Zend\ServiceManager\ServiceLocatorInterface;

class UserControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
		$userRegistrationForm = $realServiceLocator->get('FormElementManager')->get('Application\Form\UserForm');
        return new UserController(
            $userRegistrationForm
        );
    }

}
