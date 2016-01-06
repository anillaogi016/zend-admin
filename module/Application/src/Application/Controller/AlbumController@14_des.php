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
 use Zend\Db\Sql\Sql;
 use Zend\Db\Sql\Select;
 use Zend\Paginator\Paginator;
 use Zend\Paginator\Adapter\Iterator as paginatorIterator;
 use Application\Model\Album;
 use Application\Form\AlbumForm;
 use Zend\Db\Sql\Where;
 //use Application\Controller\Thumbnail;
use Lib\Service1\SimpleImage;
 
 
 class AlbumController extends AbstractActionController{
	 
	protected $albumTable;
	 
	public function indexAction(){
		
		/* $service1=new \Lib\Service1\Custom();
		echo $service1->demo(); die; */
		
		/* $plugin=$this->CustomPlugin();
		print_r($plugin->doSomthing()); die; */
		/* $facebook = new \Facebook(array(
				'appId'  => 'xxx',
				'secret' => 'xxx',
			));
			print_r($facebook); die; */
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$select = new Select();
		$search= @$_REQUEST['search'];
		if(!empty($search)){
		    $select->where->like('name','%'.$search.'%')->or->like('email','%'.$search.'%')->or->like('mob','%'.$search.'%')->or->like('title','%'.$search.'%');
		}
		$order_by = $this->params()->fromRoute('order_by')?$this->params()->fromRoute('order_by'):'id';
		$order = $this->params()->fromRoute('order')? $this->params()->fromRoute('order'):Select::ORDER_ASCENDING; 
		$page = $this->params()->fromRoute('page')?(int)$this->params()->fromRoute('page'):1;
		
		$album=$this->getAdminTable()->fetchAll($select->order($order_by.' '.$order),$search);
		$itemPerPage=2;
		$album->current();
		$paginator=new Paginator(new PaginatorIterator($album));
		$paginator->setCurrentPageNumber($page);
		$paginator->setItemCountPerPage($itemPerPage);
		$paginator->setPageRange(10);
		//print_r($paginator); die;
		return new ViewModel(array('order_by'=>$order_by,'order'=>$order,'page'=>$page,'paginator'=>$paginator));
	}
	public function getAdminTable(){
		if(!$this->albumTable){
			$sm=$this->getServiceLocator();
			$this->albumTable=$sm->get('Application\Model\AlbumTable');
		}
		return $this->albumTable;
	}
	
    public function addAction(){
	    $auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
	    $form=new AlbumForm();
	    $form->get('submit')->setAttribute('value','Add');
	    $request=$this->getRequest();
        if($request->isPost()){
			$album=new Album();
			$form->setInputFilter($album->getInputFilter());
			$form->setData($request->getPost());
			if($form->isValid()){
				$album->exchangeArray($form->getData());
				$this->getAdminTable()->saveAlbum($album);
				return $this->redirect()->toRoute('album');
			}
		}		
	    $viewModel= new ViewModel(array('form'=>$form));
		$viewModel->setTerminal(true);
	    return $viewModel;
    }
	public function editAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$id=(int) $this->params('id');
		
		if(!$id){
			
			return $this->redirect()->toRoute('addalbum');
		}
	    $album=$this->getAdminTable()->getAlbum($id);
		$form= new AlbumForm();
		$form->bind($album);
		$form->get('submit')->setAttribute('value','edit');
		$request=$this->getRequest();
		if($request->isPost()){
			$form->setData($request->getPost());
			if($form->isValid()){
				$this->getAdminTable()->saveAlbum($album);
				return $this->redirect()->toRoute('album');
			}
			
		}
		
		$viewModel=new ViewModel(array('form'=>$form,'id'=>$id));
		$viewModel->setTerminal(true);
		return  $viewModel;
	}
	public function deleteAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$id=(int) $this->params('id');
		
		if(!$id){
			
			return $this->redirect()->toRoute('addalbum');
		}
		else{
			$this->getAdminTable()->deleteAlbum($id);
			return $this->redirect()->toRoute('album');
		}
	}
	public function generateAction(){
		$response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Content-Type', "image/png");
 
        $id = $this->params('id', false);
 
        if ($id) {
 
            $image = './data/captcha/' . $id;
 
            if (file_exists($image) !== false) {
                $imagegetcontent = @file_get_contents($image);
 
                $response->setStatusCode(200);
                $response->setContent($imagegetcontent);
 
                if (file_exists($image) == true) {
                    unlink($image);
                }
            }
 
        }
 
        return $response;
	}
	public function editimageAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$id=(int) $this->params('id');
		
		if(!$id){
			
			return $this->redirect()->toRoute('addalbum');
		}
		$form=new AlbumForm($this->getRequest()->getBaseUrl().'/application/album/edit/');
		$album=new Album();
		$request=$this->getRequest();
		if($request->isPost()){
			$file=$this->params()->fromFiles('image');
			$albumss=$this->getAdminTable()->getAlbum($id);
			//print_r($albumss); die;
			$data=array(
			'id'=>$albumss->id,
			'name'=>$albumss->name,
			'title'=>$albumss->title,
			'email'=>$albumss->email,
			'mob'=>$albumss->mob,
			'address'=>$albumss->address,
			'short_description'=>$albumss->short_description,
			'description'=>$albumss->description,
			'image'=>$file['name'],
			);
			$form->setData($data);
			if($form->isValid()){
				$adapter= new \Zend\File\Transfer\Adapter\Http();
				$adapter->setDestination(getcwd().'/public/adminModule/img/AlbumImage/');
				unlink(getcwd().'/public/adminModule/img/AlbumImage/'.$albumss->image);
				
				if($adapter->receive($file['name'])){
					//echo $file['name']; die;
					$album->exchangeArray($form->getData());
					$this->getAdminTable()->saveAlbum($album);
					return $this->redirect()->toRoute('album');
					
				}
				
			}
		}
		$viewModel=new ViewModel(array('form'=>$form,'id'=>$id));
		$viewModel->setTerminal(true);
		return $viewModel;
	}
 }