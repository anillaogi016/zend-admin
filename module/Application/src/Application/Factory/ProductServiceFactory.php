<?php

namespace Application\Factory;

use Application\Service\ProductService;
use  Zend\ServiceManager\FactoryInterface;
use  Zend\ServiceManager\ServiceLocatorInterface;

class ProductServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
       return new ProductService($serviceLocator->get('Zend\Db\Adapter\Adapter'));
    }

}
