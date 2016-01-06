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
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class AlbumForm extends Form{
	
	protected $adapter;
	public function __construct( /* AdapterInterface $dbAdapter,*/  $name=null,$urlcaptcha = null  ){
		//$this->Adapter=$dbAdapter;
		parent::__construct('album');
		$this->add(array(
		    'name'=>'id',
			'attributes'=>array(
			    'type'=>'hidden',
			),
		));
		$this->add(array(
             'type' => 'Zend\Form\Element\Select',
             'name' => 'category_id',
             'options' => array(
                     'value_options' => //$this->selectCategoryOptions(),
					   array(
                             '0' => 'Anil',
                             '1' => 'Sunil',
                             '2' => 'Lucky',
                             '3' => 'Sums',
                     ),
					 'disable_inarray_validator' => true,
                    					 
             ),
			'attributes'=>array(
			    'class'=>'form-control required',
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
		    'name'=>'email',
			'attributes'=>array(
			    'type'=>'text',
				'class'=>'form-control required email',
			),
		));
		$this->add(array(
		   'name'=>'mob',
		   'attributes'=>array(
	            'type'=>'text',	
                'class'=>'form-control required',				
		   ),
		));
		$this->add(array(
		    'name'=>'address',
			'attributes'=>array(
			    'type'=>'text',
				'class'=>'form-control required',
			),
		));
		$this->add(array(
		    'name'=>'title',
			'attributes'=>array(
			    'type'=>'text',
				'class'=>'form-control required',
			),
		));
		$this->add(array(
		    'name'=>'short_description',
			'attributes'=>array(
			     'type'=>'textarea',
				 'class'=>'form-control required',
			),
		));
		$this->add(array(
		    'name'=>'description',
			'attributes'=>array(
			    'type'=>'textarea',
				'id'=>'description',
				'class'=>'form-control required',
			),
		));
		$this->add(array(
				'name'=>'image',
				'attributes'=>array(
					'type'=>'file',
					'class'=>'required',
					'id'=>'albumimage',
				),
			)
		);
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
	
	// this function used for select category in droup down box
	public function selectCategoryOptions(){
		
		  $adapter = new Adapter(array('driver' => 'mysqli',
		 'host' => 'localhost',
		 'port' => '3306',
		 'dbname' => 'zndemo',
		 'username' => 'root',
		 'password' => ''));
		 $result = $adapter->getDriver()->getConnection()->execute('select id,name from categories where status=1'); 
		
		$selectData=array(0=>'--Select Category--');
		 foreach ($result as $res) {
            $selectData[$res['id']] = $res['name'];
        }
        return $selectData;
	}
}