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

class AdminForm extends Form{
	
	public function __construct($name=null,$options=array()){
		parent::__construct($name,$options);
		$this->add(array(
		    'type'=>'text',
			'name'=>'email'
		));
		$this->add(array(
		    'type'=>'password',
			'name'=>'password'
		));
		$this->add(array(
		    'type'=>'checkbox',
			'name'=>'remember_me'
		));
		$this->add(array(
		    'type'=>'submit',
			'name'=>'submit',
			'attributes'=>array(
			    'value'=>'LogIn'
			)
		));
	}
}