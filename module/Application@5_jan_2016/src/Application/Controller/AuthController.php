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
use Zend\Form\FormInterface;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;
use Zend\Authentication\AuthenticationService;

class AuthController extends AbstractActionController
{
    protected $authForm;
	protected $auth;
	
	public function __construct(FormInterface $authForm){
		$this->authForm=$authForm;
		$this->auth=new AuthenticationService();
		
	}
	public function loginAction(){
		$redirect='dashboard';
		if($this->auth->hasIdentity()){
			return $this->redirect()->toRoute($redirect);
		}
		$request=$this->getRequest();
		if($request->isPost()){
			$this->authForm->setData($request->getPost());
			if($this->authForm->isValid()){
				$authAdapter=new AuthAdapter($this->getServiceLocator()->get('Zend\Db\Adapter\Adapter'));
				$authAdapter->setTableName('admins')
				            ->setIdentityColumn('email')
							->setCredentialColumn('password')
							->setIdentity($request->getPost('email'))
							->setCredential($request->getPost('password'))
							->setCredentialTreatment('md5(?)');
			    $Site_Id=1;
			    $authAdapter->getDbSelect()->where('site_id='.$Site_Id);
				$result=$this->auth->authenticate($authAdapter);
				if($result->isValid()){
					if($request->getPost('remember_me') == 1){
						$storage=$this->getServiceLocator()
						              ->get('Application\Model\MyAuthStorage');
						$storage->setRememberMe(1);
						
					}
					$this->flashmessenger()->addMessage('You are looged in successfully');
					return $this->redirect()->toRoute($redirect);
				}
				else{
					$this->flashmessenger()->addErrorMessage('Invalid username or password, try again.');
					return $this->redirect()->toRoute('home');
				}
			}
		}
		$viewModel=new ViewModel(array('form'=>$this->authForm));
		$viewModel->setTerminal(true);
		return $viewModel;
	}
	public function logoutAction(){
		$storage=$this->getServiceLocator()
		              ->get('Application\Model\MyAuthStorage');
		$storage->forgetMe();
		$this->auth->clearIdentity();
		$this->flashmessenger()->addMessage("You've been logged out");
		$this->redirect()->toRoute('home');
	}
}
