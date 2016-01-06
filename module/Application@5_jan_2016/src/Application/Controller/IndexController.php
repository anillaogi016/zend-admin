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
use Zend\Authentication\AuthenticationService;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	
	public function indexAction()
    {
		
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$useremail=$auth->getIdentity();
		return new ViewModel(array('uemail'=>$useremail));
    }
	public function loginAction(){
		
		return new ViewModel();
	}
	public function listAction(){
		
		return new ViewModel();
	}
}
