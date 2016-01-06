<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Form;

use Zend\Form\Fieldset;

class AdminFieldset extends Fieldset{
	
	
	public function __construct($name=null,$options=array()){
		parent::__construct($name=null,$options);
		$this->add(array('type'=>'hidden','name'=>'id'));
		$this->add(array('type'=>'text','name'=>'user_name','options'=>array('label'=>'Email')));
		$this->add(array('type'=>'password','name'=>'password','options'=>array('label'=>'Password')));
	}
}