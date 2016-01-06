<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Form;

use Zend\Form\Fieldset;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;

class ProductFieldset extends Fieldset{
	
	
	public function __construct(AdapterInterface $dbAdapter,$name=null,$options=array()){
		parent::__construct($name,$options);
		$this->dbAdapter=$dbAdapter;
		$this->add(array('type'=>'hidden','name'=>'id'));
		$this->add(array('type'=>'text','name'=>'name','attributes'=>array('class'=>'form-control required','maxlength'=>50)));
		$this->add(array('type'=>'text','name'=>'price','attributes'=>array('class'=>'form-control required number')));
		$this->add(array('type'=>'text','name'=>'quantity','attributes'=>array('class'=>'form-control required number')));
	}
}