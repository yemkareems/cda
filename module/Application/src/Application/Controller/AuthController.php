<?php
namespace Application\Controller;

use Application\page\LoginFilter;
use Application\page\LoginForm;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {
        return $this->redirect()->toRoute('login');
    }

    public function loginAction()
    {
        $messages = array();
        $loginForm = new LoginForm();
        $config = $this->getServiceLocator()->get('config');
        $loginForm->setAttribute('action', $config['router']['routes']['login']['options']['route']);
        $request = $this->getRequest();

        //redirect to default screen, if user is already logged in
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($auth->hasIdentity()) {
            return $this->redirect()->toRoute('internal-routing');
        }

        if ($request->isPost()) {
            $loginForm->setInputFilter(new LoginFilter());
            $loginForm->setData($request->getPost());
            if ($loginForm->isValid()) {
                $data = $loginForm->getData();
                $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

                $adapter = $authService->getAdapter();
                $adapter->setIdentity($data['email']);
                $adapter->setCredential(md5($data['password']));
                $authResult = $authService->authenticate();

                if ($authResult->isValid()) {
                    $identity = $authResult->getIdentity();
                    $authService->getStorage()->write($identity);
                    return $this->redirect()->toRoute('internal-routing');
                } else {
                    $messages[] = 'Invalid user authentication.';
                }
            }
        }

        return new ViewModel(array(
            'loginForm' => $loginForm,
            'messages' => $messages,
        ));
    }

    public function logoutAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
        }

        return $this->redirect()->toRoute('login');
    }
}