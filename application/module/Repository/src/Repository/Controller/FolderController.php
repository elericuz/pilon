<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Application\Entity\FileSystem;
use Application\Entity\FileSystemClient;
use Zend\Validator\NotEmpty;
use Repository\Model\FileSystemRepository;

/**
 * FolderController
 *
 * @author Eric Valera Miller
 *
 * @version 1.0
 *
 */
class FolderController extends MainController
{
    public function createAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $Client_obj = $this->em->find('Application\Entity\Client', $this->clientId);

            $FS_obj = new FileSystem();
            $FS_obj->setFisiParentId(0);
            $FS_obj->setFisiType(0);
            $FS_obj->setFisvName(md5($request->getPost('folder_name')));
            $FS_obj->setFisvRealName(trim($request->getPost('folder_name')));
            $FS_obj->setFisdUploadDate(new \DateTime("now"));
            $FS_obj->setFisvUploadIp($_SERVER['REMOTE_ADDR']);
            $this->em->persist($FS_obj);

            $FSC_obj = new FileSystemClient();
            $FSC_obj->setFsciParentId(0)
                    ->setClii($Client_obj)
                    ->setFisi($FS_obj)
                    ->setFsciParentId($request->getPost('folder'))
                    ->setFscvRealName(trim($request->getPost('folder_name')))
                    ->setFscvFriendlyName(trim($request->getPost('folder_name')))
                    ->setFscdUploadDate(new \DateTime("now"));
            $this->em->persist($FSC_obj);

            $this->em->flush();
        }

        return $this->redirect()->toRoute('my-repo', array('folder'=>$request->getPost('folder')));
    }

	public function deleteAction()
	{
	    $request = $this->getRequest();
	    if($request->isPost())
	    {
	        $FSR_obj = new FileSystemRepository($this->em);

	        $notEmpty_obj = new NotEmpty();

	        $clientId = $this->clientId;
	        if($this->clientAdmin)
	        {
	            $fsc_obj = $this->em->find('Application\Entity\FileSystemClient', $request->getPost('folder'));
	            if($notEmpty_obj->isValid($fsc_obj))
	                $clientId = $fsc_obj->getClii()->getCliiId();
	        }

	        $this->deleteAllChildren(array($request->getPost('folder')), $clientId, $FSR_obj);

	        return $this->redirect()->toRoute('my-repo', array('folder'=>$request->getPost('folder')));
	    }
	    else
	    {
	        return $this->redirect()->toRoute('dashboard');
	    }
	}

	protected function deleteAllChildren($folders, $clientId, &$FSR_obj)
	{
	    foreach($folders as $child)
	    {
	        $folderChildren = $FSR_obj->getChildrenId($clientId, $child, 0);
	        if(!empty($folderChildren))
	        {
	            foreach($folderChildren as $fc)
	            {
	                $files = $FSR_obj->getChildrenId($clientId, $fc, 1);
	                foreach($files as $file)
	                {
	                    $FSC_obj = $this->em->find('Application\Entity\FileSystemClient', $file);
	                    $FSC_obj->setFsciStatus(0);
	                    $this->em->persist($FSC_obj);
	                    $this->em->flush();
	                }
	                $FSC_obj = $this->em->find('Application\Entity\FileSystemClient', $fc);
	                $FSC_obj->setFsciStatus(0);
	                $this->em->persist($FSC_obj);
	                $this->em->flush();
	            }
	            $this->deleteAllChildren($folderChildren, $clientId, $FSR_obj);
	        }
	    }

	}
}
