<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Application\Entity\FileSystem;

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
            var_dump($request->getPost());

            $FS_obj = new FileSystem();
            $FS_obj->setFisiParentId(0);
            $FS_obj->setFisiType(0);
            $FS_obj->setFisvName(md5($request->getPost('folder_name')));
            $FS_obj->setFisvRealName(trim($request->getPost('folder_name')));
            $FS_obj->setFisdUploadDate(new \DateTime("now"));
            $FS_obj->setFisvUploadIp($_SERVER['REMOTE_ADDR']);
            $this->em->persist($FS_obj);
            $this->em->flush();
        }

        return $this->redirect()->toRoute('my-repo');
    }
}