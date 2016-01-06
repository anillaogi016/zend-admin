<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    'db' => array(
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=zndemo;host=localhost',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
        ),
        //other adapter when it needed...
        'adapters' => array(
            'db' => array(
                'driver' => 'Pdo',
                'dsn' => 'mysql:dbname=zndemo;host=localhost',
                'driver_options' => array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
                ),
            ),
        ),
    ),
    'service_manager' => array(
        // for primary db adapter that called
        // by $sm->get('Zend\Db\Adapter\Adapter')
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
            => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
        // to allow other adapter to be called by
        // $sm->get('db1') or $sm->get('db2') based on the adapters config.
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
    ),
);
