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

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Db\Adapter\Adapter as DbAdapter;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Db\TableGateway\TableGateway;
use Application\Model\Auth;
use Zend\Db\Sql\Where;


class UserController extends AbstractActionController
{
	protected $usersTable = null;
	
	public function indexAction()
    {
		
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$useremail=$auth->getIdentity();
		return new ViewModel(array('uemail'=>$useremail));
    }
	public function UsersTable()
	{		
		if (!$this->usersTable) {			
			$sm = $this->getServiceLocator();
			$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');			
			$this->usersTable = new TableGateway('users',$dbAdapter);
		}		
		
		return $this->usersTable;
	}
	public function listAction(){
		$auth=new AuthenticationService();
		if(!$auth->hasIdentity()){
			return $this->redirect()->toRoute('home');
		}
		$search=@$_REQUEST['search'];
		$rowset=$this->UsersTable()->select();
		$select=array('rowset'=>$rowset,'action'=>$this->params()->fromRoute('action'));
		$select= new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($select));
		$select->setCurrentPageNumber($this->params()->fromRoute('page'));
		$select->setItemCountPerPage(2);
		$view = new ViewModel($select);
		return $view;
	}
}
