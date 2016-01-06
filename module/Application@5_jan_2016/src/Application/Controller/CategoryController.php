<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator as paginatorIterator;
use Application\Model\Category;
use Application\Form\CategoryForm;
use Zend\Db\Sql\Where;

class CategoryController extends AbstractActionController{
	
	protected $categoryTable;
	
	public function indexAction(){
       
		$auth= new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$select= new Select();
		$search= @$_REQUEST['search'];
		if(!empty($search)){
			$select->where->like('name','%'.$search.'%');
		}
				
		$order_by=$this->params()->fromRoute('order_by')?$this->params()->fromRoute('order_by'):'id';
		$order=$this->params()->fromRoute('order')?$this->params()->fromRoute('order'):Select::ORDER_ASCENDING;
		$page= $this->params()->fromRoute('page')?(int)$this->params()->fromRoute('page'):1;
		$category=$this->getCategoryTable()->fetchAllCategory($select->order($order_by.' '.$order),$search);
		$itemPerPage=2;
		$category->current();
		$paginator= new Paginator( new PaginatorIterator($category));
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($itemPerPage);
		$paginator->setPageRange(10);
		return new ViewModel(array('order_by'=>$order_by,'order'=>$order,'page'=>$page,'paginator'=>$paginator));
	}
	public function getCategoryTable(){
		
		if(!$this->categoryTable){
			$sms=$this->getServiceLocator();
			$this->categoryTable=$sms->get('Application\Model\CategoryTable');
		}
		return $this->categoryTable;
	}
	public function addAction(){
		$auth= new AuthenticationService();
		if(!$auth){
			return $this->redirect()->toRoute('home');
		}
		$form= new CategoryForm();
		
		$form->get('submit')->setAttribute('value','Add Category');
		$request=$this->getRequest();
		if($request->isPost()){
			$category =$request->getPost();
			//print_r($category); die;
			$this->getCategoryTable()->saveCategory($category);
			return $this->redirect()->toRoute('category');
		    //echo '<pre>';print_r($category);echo '<pre>'; die; 
		}
		$viewModel=new ViewModel(array('form'=>$form));
		$viewModel->setTerminal(true);
		
		return $viewModel;
	}
	public function editAction(){
		$auth=new AuthenticationService();
		if(!$auth){
			return $this->redirect()->toRoute('home');
		}
		$form= new CategoryForm();
		$id=(int)$this->params('id');
		
		$category=$this->getCategoryTable()->getCategory($id);
		$form->bind($category);
		$form->get('submit')->setAttribute('value','edit');
		
		$request=$this->getRequest();
		if($request->isPost()){
			$category=$request->getPost();
			//echo '<pre>'; print_r($category); echo '<pre>'; die;
			$this->getCategoryTable()->saveCategory($category);
			return $this->redirect()->toRoute('category');
		}
		$viewModel=new ViewModel(array('form'=>$form,'id'=>$id));
		$viewModel->setTerminal(true);
		return $viewModel;
		
	}
	public function deleteAction(){
		$id=(int)$this->params()->fromRoute('id');
		if(!empty($id)){
			$this->getCategoryTable()->deleteCategory($id);
			return $this->redirect()->toRoute('category');
		}
	}
	public function checkcategoryAction(){
		$name=$_POST['name'];
		$response=false;
		if(!empty($name)){
			$data=$this->getCategoryTable()->checkCategory($name);
			if(!empty($data)){
				$response=false;
			}else{
				$response=true;
			}
		}
		echo json_encode($response);
		exit();
		
	}
}