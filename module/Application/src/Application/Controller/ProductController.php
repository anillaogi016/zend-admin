<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
use Application\Service\ProductService;
use Zend\Form\FormInterface;

class ProductController extends AbstractActionController{
	
	 protected $productForm;
	
	public function __construct(FormInterface $productForm){
		$this->productForm=$productForm;
	}
	 
	public function indexAction()
    {
		//$result=$this->forward()->dispatch('CategoryController',array('action'=>'index'));
		//echo '<pre>'; print_r($result); echo '<pre>'; die;
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$productService=$this->getServiceLocator()->get('Application\Service\ProductService');
		$search=@$_REQUEST['search'];
	    $products=$productService->findAll($search);
		$paginator= new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($products));
		$paginator->setCurrentPageNumber($this->params()->fromRoute('page'));
		$paginator->setItemCountPerPage(2);
		return new ViewModel(array('products'=>$paginator));
    }
	
	public function addAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$request=$this->getRequest();
		if($request->isPost()){
			$this->productForm->setData($request->getPost());
			if($this->productForm->isValid()){
				$productService=$this->getServiceLocator()->get('Application\Service\ProductService');
				$productData=$this->productForm->getData();
				$productService->saveProduct($productData['product-fieldset']);
				return $this->redirect()->toRoute('productlist');
			}
		}
		$viewModel= new ViewModel(array('form'=>$this->productForm));
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	
	public function deleteproductAction($id=null){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$id = $this->params('id');
		if(!empty($id)){
			$productService=$this->getServiceLocator()->get('Application\Service\ProductService');
			$checkResponse=$productService->deleteProduct($id);
			if($checkResponse){
				$this->flashmessenger()->addMessage('Product Delete Successfully!');
				return $this->redirect()->toRoute('productlist');
			}
		}
		else{
			$this->flashmessenger()->addErrorMessage('product id do not match please try again');
			return $this->redirect()->toRoute('productlist');
			
		}
	}
	public function editproductAction($id=null){
		$auth = new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$request=$this->getRequest();
		$productService=$this->getServiceLocator()->get('Application\Service\ProductService');
		$product=$productService->findProduct($this->params('id'));
		$mf=$this->productForm->get('product-fieldset');
		$mf->populateValues($product[0]);
		if($request->isPost()){
			$this->productForm->setData($request->getPost());
			if($this->productForm->isValid()){
				$productService=$this->getServiceLocator()->get('Application\Service\ProductService');
				$productData=$this->productForm->getData();
				$productService->updateProduct($productData['product-fieldset']);
				return $this->redirect()->toRoute('productlist');
			}
		}
		
		$viewModel= new ViewModel(array('form'=>$this->productForm));
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	public function viewproductAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$id=$this->params('id');
		$postService=$this->getServiceLocator()->get('Application\Service\ProductService');
		$product=$postService->findProduct($id);
		$viewmodel=new ViewModel(array('product'=>$product));
		$viewmodel->setTerminal(true);
		return $viewmodel;
	}
}