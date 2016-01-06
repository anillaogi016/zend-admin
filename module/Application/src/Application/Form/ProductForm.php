<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Form;

use Zend\Form\Form;

class ProductForm extends Form{
	
	 public function init()
    {
        $this->add(array(
            'name' => 'product-fieldset',
            'type' => 'ProductFieldset',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));
        $this->add(array(
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Save'
            )
        ));
    }
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
    }
}