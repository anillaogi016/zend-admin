<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;


class CategoryTable extends AbstractTableGateway{
	
	protected $table = 'categories';
	
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
		$this->resultSetPrototype = new ResultSet();
        $this->resultSetPrototype->setArrayObjectPrototype(new Category());
        $this->initialize();	
	}
	public function fetchAllCategory(Select $select=null,$search=null){
		if(null===$select)
		$select = new Select();
		$select->from($this->table);
		$resultSet = $this->selectWith($select);
		$resultSet->buffer();
		return $resultSet;
		
	}
	public function saveCategory($category){
		$data=array('name'=>$category->name);
		$id=(int)$category->id;
		if($id==0){
			$this->insert($data);	
		}
		else{
			
			if($this->getCategory($id)){
				$this->update($data,array('id'=>$id));
			}else{
			     throw new \Exception('Could not found id');	
			}
		}
       	
	}
	public function getCategory($id){
		$id=(int)$id;
		$rowset=$this->select(array('id'=>$id));
		$row=$rowset->current();
		//echo '<pre>'; print_r($row); echo '<pre>'; 
		return $row;
	}
	public function deleteCategory($id){
		$id=(int)$id;
		if($id){
			$this->delete(array('id'=>$id));
		}
	}
	public function checkCategory($name){
		$rowset=$this->select(array('name'=>$name));
		$row=$rowset->current();
		return $row;
	}
}