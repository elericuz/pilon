<?php
namespace Security\Controller;

use Common\Controller\MainController;
use Common\Classes\Encrypt;
use Zend\Validator\NotEmpty;

/**
 * LoginController
 *
 * @author
 *
 * @version
 *
 */
class LoginController extends MainController
{
    public function loginAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $email = $request->getPost('user-email', false);
            $password = $request->getPost('user-password', false);

            $empty_obj = new NotEmpty();
            if(!$empty_obj->isValid($email) || !$email)
                throw new \RuntimeException("El usuario no es válido");

            if(!$empty_obj->isValid($password) || !$password)
                throw new \RuntimeException("La contraseña no es válida");

            $password = Encrypt::encrypt($password, $email);
            $email = md5($email);

            $user_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByCluvUser($email);

            if(!$empty_obj->isValid($user_obj))
                throw new \RuntimeException("El ussuario no es válido");

            if($user_obj->getCluvPassword()!==$password)
                throw new \RuntimeException("La contraseña no es válida");

            $client = array(
                'clientId' => $user_obj->getClii()->getCliiId(),
                'clientName' => $user_obj->getClii()->getClivName(),
                'clientType' => $user_obj->getClii()->getCliiType(),
                'userId' => $user_obj->getCluiId(),
                'userEmail' => $user_obj->getCluvEmail(),
                'userType' => $user_obj->getCluiType()
            );

            $this->getServiceLocator()->get('AuthService')->setStorage($this->getSessionStorage());

            $this->getServiceLocator()->get('AuthService')->getStorage()->write($client);

            return $this->redirect()->toRoute('dashboard');
        }
    }

    public function logoutAction()
    {
    	//$this->getSessionStorage()->forgetMe();
    	$this->getServiceLocator()->get('AuthService')->clearIdentity();

    	return $this->redirect()->toRoute('home');
    }
}