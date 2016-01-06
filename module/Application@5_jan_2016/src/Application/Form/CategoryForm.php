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

class CategoryForm extends Form{
	
	public function __construct($name=null){
		parent::__construct('category');
		$this->add(array(
		    'name'=>'id',
			'attributes'=>array(
			    'type'=>'hidden',
			),
		));
		$this->add(array(
		    'name'=>'name',
			'attributes'=>array(
			    'type'=>'text',
				'class'=>'form-control required',
			),
		));
		$this->add(array(
		    'name'=>'submit',
			'attributes'=>array(
			    'type'=>'submit',
				'value'=>'Save',
				'id'=>'submitalbum',
				'class'=>'btn btn-primary'
			),
		));
	}
}