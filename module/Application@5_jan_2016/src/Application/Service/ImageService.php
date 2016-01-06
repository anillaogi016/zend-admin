<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Service;

use Application\Model\Product;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\Hydrator\HydratorInterface;
use Zend\Sql\Sql\Expression;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\ResultSet\ResultSet;

class ProductService{
	
	protected $dbAdapter;
	
	public function __construct(AdapterInterface $dbAdapter){
		$this->dbAdapter=$dbAdapter;
	}
	
	public function findProduct($id=null){
		$sql=new Sql($this->dbAdapter);
		$select=$sql->select('products');
		$select->where(array('id=?'=>$id));
		$stmt=$sql->prepareStatementForSqlObject($select);
		$result=$stmt->execute();
		if($result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()){
			$resultSet=new ResultSet;
			$resultSet->initialize($result);
			$return=array();
			foreach($resultSet as $row){
				$return[]=$row;
			}
			return $return;
		}
		throw new \InvalidArgumentException('Product do not found!');
	}
	public function findAll($search=null){
		$sql=new Sql($this->dbAdapter);
		$select=$sql->select('products');
		if(!empty($search)){
			$select->where->like('name',"%$search%");
		}
		$select->order(array('id desc'));
		$stmt=$sql->prepareStatementForSqlObject($select);
		$result=$stmt->execute();
		if( $result instanceof ResultInterface && $result->isQueryResult() && $result->getAffectedRows()){
			$resultSet=new ResultSet;
			$resultSet->initialize($result);
			$return=array();
			foreach($resultSet as $row){
				$return []=$row;
			}
			return $return;
		}
		$test=array();
		return $test;
		throw new \InvalidArgumentException('Product do not found!');
	}
	public function saveProduct($productData){
		
		$action=new Insert('products');
		$action->values($productData);
		$sql = new Sql($this->dbAdapter);
		$stmt=$sql->prepareStatementForSqlObject($action);
		$result=$stmt->execute();
		if($result instanceof ResultInterface){
			if($newId=$result->getGeneratedValue()){
				return $newId;
			}
			return true;
		}
		throw new \Exception('Database Error');
	}
	public function updateProduct($productData){
		
		$id = $productData['id'];
		if(!empty($id)){
			$action=new Update('products');
			$action->set($productData);
			$action->where(array('id=?'=>$id));
		}
		$sql = new Sql($this->dbAdapter);
		$stmt=$sql->prepareStatementForSqlObject($action);
		$result=$stmt->execute();
		if($result instanceof ResultInterface){
			if($newId=$result->getGeneratedValue()){
				return $newId;
			}
			return true;
		}
		throw new \Exception('Database Error');
	}
	public function deleteProduct($id){
		$action=new Delete('products');
		$action->where(array('id=?'=>$id));
		$sql=new Sql($this->dbAdapter);
		$stmt=$sql->prepareStatementForSqlObject($action);
		$result=$stmt->execute();
		return (boolean) $result->getAffectedRows();
		
	}
}
