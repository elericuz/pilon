<?php
namespace Security\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Application\Entity\Client;
use Application\Entity\ClientUser;
use Common\Classes\Encrypt;
use Zend\Validator\NotEmpty;

/**
 * ClientController
 *
 * @author
 *
 * @version
 *
 */
class ClientController extends MainController
{
    protected $needAdmin = 1;

    public function indexAction()
    {
        $client_obj = $this->em->getRepository('Application\Entity\Client')->findAll(array('clii_id'=>1));

        $clients = array();
        foreach($client_obj as $client)
        {
            $user_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByClii($client->getCliiId());

            $clients[] = array(
                'clui_id' => $user_obj->getCluiId(),
                'clii_id' => $user_obj->getClii()->getCliiId(),
                'cliv_name' => $user_obj->getClii()->getClivName(),
                'clid_creation' => $user_obj->getClii()->getClidCreationDate(),
                'cluv_user' => $user_obj->getCluvUser(),
                'cluv_email' => $user_obj->getCluvEmail()
            );
        }

        $array = array(
            'clients' => $clients
        );

        return new ViewModel($array);
    }

    public function viewAction()
    {
        $id = $this->params()->fromRoute('id', false);

        if(!is_numeric($id))
            throw new \RuntimeException("Invalid client given");

        $user_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByClii($id);

        $notEmpty_obj = new NotEmpty();

        if(!$notEmpty_obj->isValid($user_obj))
            throw new \RuntimeException("Invalid client given");

        $client = array(
            'clii_id' => $user_obj->getClii()->getCliiId(),
            'cliv_name' => $user_obj->getClii()->getClivName(),
        );

        $user = array(
            'clui_id' => $user_obj->getCluiId(),
            'cluv_email' => $user_obj->getCluvEmail()
        );

        $array = array(
            'client' => $client,
            'user' => $user
        );

        return new ViewModel($array);
    }

    public function createAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $email = $request->getPost('user-email', false);

            $empty_obj = new NotEmpty();
            if(!$empty_obj->isValid($email) || !$email)
                throw new \RuntimeException("Not a valid email address given");

            $email_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByCluvEmail($email);

            if($empty_obj->isValid($email_obj))
                throw new \RuntimeException("The email given is already in use. Try with another one.");

            $client_obj = new Client();
            $client_obj->setClivName($request->getPost('client-name'))
                       ->setClidCreationDate(new \DateTime("now"));
            $this->em->persist($client_obj);

            $pass = Encrypt::encrypt($request->getPost('client-password'), $request->getPost('client-user'));

            $user_obj = new ClientUser();
            $user_obj->setClii($client_obj)
                     ->setCluvUser(md5($request->getPost('client-user')))
                     ->setCluvPassword($pass)
                     ->setCluvEmail($request->getPost('client-email'));
            $this->em->persist($user_obj);

            $this->em->flush();

            return $this->redirect()->toRoute('clients');
        }
    }

    public function editAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $email = $request->getPost('user-email', false);

            $empty_obj = new NotEmpty();
            if(!$empty_obj->isValid($email) || !$email)
                throw new \RuntimeException("Not a valid email address given");

            $email_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByCluvEmail($email);

            if($empty_obj->isValid($email_obj) && $email_obj->getCluiId()!=$request->getPost('user-id', 0))
                throw new \RuntimeException("The email given is already in use. Try with another one.");

            $client_obj = $this->em->find('Application\Entity\Client', $request->getPost('client-id', 0));
            $client_obj->setClivName($request->getPost('client-name'));;
            $this->em->persist($client_obj);

            $user_obj = $this->em->find('Application\Entity\ClientUser', $request->getPost('user-id', 0));

            $user_obj->setClii($client_obj)
                     ->setCluvUser(md5($request->getPost('user-email')))
                     ->setCluvEmail($request->getPost('user-email'));

            $storedPass = $user_obj->getCluvPassword();
            $newPass = Encrypt::encrypt($request->getPost('user-password'), $request->getPost('user-email'));

            if($storedPass!==$newPass)
            {
                $user_obj->setCluvPassword($newPass);
            }

            $this->em->persist($user_obj);

            $this->em->flush();
        }

        return $this->redirect()->toRoute('view-client', array('id'=>$request->getPost('client-id', 0)));
    }

    public function deleteClient()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            foreach($request->getPost('client-id') as $client)
            {
                $client_obj = $this->em->find('Application\Entity\Client', $client);
                $client_obj->setCliiStatus(0);
                $this->em->persist($client_obj);

                $user_obj = $this->em->getRepository('Application\Entity\ClientUser')->findOneByClii($client);
                $user_obj->setCluiStatus(0);
                $this->em->persist($user_obj);

                $this->em->flush();
            }
        }

        return $this->redirect()->toRoute('clients');
    }
}