<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Application\Entity\FileSystem;
use Application\Entity\FileSystemClient;

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
            $Client_obj = $this->em->find('Application\Entity\Client', 1);

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
}
