<?php
namespace Security\Controller;

use Common\Controller\MainController;
use Zend\View\Model\ViewModel;
use Application\Entity\ClientUser;
use Common\Classes\Encrypt;

/**
 * UserController
 *
 * @author
 *
 * @version
 *
 */
class UserController extends MainController
{
    protected $needAdmin = 1;

    public function indexAction()
    {
        $users = $this->em->getRepository('Application\Entity\ClientUser')
                          ->findByCluiStatus(1);
        return new ViewModel(array('users' => $users));
    }

    public function deleteAction()
    {
        $request = $this->getRequest();
        if($request->isPost()) {
            foreach ($request->getPost('cluiId') as $user) {
                if ($user != 1) {
                    $userObj = $this->em->find('Application\Entity\ClientUser', $user);
                    if ($userObj instanceof ClientUser) {
                        $userObj->setCluiStatus(0);
                        $this->em->persist($userObj);
                    }
                }
            }

            $this->em->flush();
        }

        return $this->redirect()->toRoute('users');
    }

    public function createAction()
    {
        $request = $this->getRequest();
        if($request->isPost()) {
            $user = $this->em->find('Application\Entity\ClientUser', $request->getPost('cluiId', 0));
            if ($user instanceof ClientUser) {
                $password = $request->getPost('cluvPassword');
                if (!empty(trim($password))) {
                    $repassword = $request->getPost('cluvPassword2');
                    if (md5($password == md5($repassword))) {
                        $password = Encrypt::encrypt(trim($password), trim($request->getPost('cluvEmail')));
                        $user->setCluvPassword($password);
                    }
                }
            } else {
                $user = new ClientUser();
                $password = $request->getPost('cluvPassword');
                $repassword = $request->getPost('cluvPassword2');
                if (md5($password == md5($repassword))) {
                    $password = Encrypt::encrypt(trim($password), trim($request->getPost('cluvEmail')));
                    $user->setCluvPassword($password);
                } else {
                    return $this->redirect()->toRoute('users');
                }
                $client = $this->em->find('Application\Entity\Client', 1);
                $user->setClii($client);
            }
            $user->setCluvName($request->getPost('cluvName'))
                 ->setCluvLastname($request->getPost('cluvLastname'))
                 ->setCluvEmail($request->getPost('cluvEmail'))
                 ->setCluiType($request->getPost('cluiType', 0))
                 ->setCluvUser(md5(trim($request->getPost('cluvEmail'))));

            $this->em->persist($user);
            $this->em->flush();

            return $this->redirect()->toRoute('users');
        } else {
            if ($id = $this->params()->fromRoute('id', false)) {
                $user = $this->em->find('Application\Entity\ClientUser', $id);
                return new ViewModel(array('user' => $user));
            } else {
                return new ViewModel();
            }
        }
    }
}