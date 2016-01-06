<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace  Application\Model;

class Product{
	
	protected $id;
	protected $name;
	protected $price;
	protected $quantity;
	
	public function getId(){
		return $this->$id;
	}
	public function setId($id){
		$this->id=$id;
	}
	public function getName(){
		return $this->name;
	}
	public function setName($name){
		$this->name=$name;
	}
	public function getPrice(){
		return $this->price;
	}
	public function setPrice($price){
		$this->price=$price;
	}
	public function getQuantity(){
		return $this->quantity;
	}
	public function setQuantity($quantity){
		$this->quantity=$quantity;
	}
}