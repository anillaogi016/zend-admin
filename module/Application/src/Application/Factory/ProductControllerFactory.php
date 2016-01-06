<?php

namespace Application\Factory;

use  Application\Controller\ProductController;
use  Zend\ServiceManager\FactoryInterface;
use  Zend\ServiceManager\ServiceLocatorInterface;

class ProductControllerFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $realServiceLocator = $serviceLocator->getServiceLocator();
		$productService = $realServiceLocator->get('FormElementManager')->get('Application\Form\ProductForm');
        return new ProductController(
            $productService
        );
    }

}
