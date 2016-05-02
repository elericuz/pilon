<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Zend\Validator\NotEmpty;
use Zend\Validator\File\NotExists;
use Common\Classes\String;
use Repository\Model\FileSystemRepository;
use Repository\Classes\Breadcrumb;

class IndexController extends MainController
{
    public function indexAction()
    {
        $parent = $this->params()->fromRoute('folder', false);;

        $empty_obj = new NotEmpty();

        if(!$parent || $parent == 0)
        {
            if(!$this->clientAdmin)
            {
                $parent_obj = $this->em->getRepository('Application\Entity\FileSystemClient')->findOneBy(array('clii'=>$this->clientId, 'fsciParentId'=>0));
                if($empty_obj->isValid($parent_obj))
                    $parent = $parent_obj->getFsciId();
            } else {
                $parent = 0;
            }
        }

        $clientId = $this->clientId;
        if($this->clientAdmin)
        {
            $fsc_obj = $this->em->find('Application\Entity\FileSystemClient', $parent);
            if($empty_obj->isValid($fsc_obj))
                $clientId = $fsc_obj->getClii()->getCliiId();
        }

        $fsc_obj = new FileSystemRepository($this->em);
        $folders = $fsc_obj->getFolders($clientId, $parent);
        foreach($folders as $key => $folder)
        {
            $totalFolder = $fsc_obj->countFolders($folder['fsciId']);
            $totalFolder = array_shift($totalFolder);
            $totalFolder = array_shift($totalFolder);

            $totalFiles = $fsc_obj->countFiles($folder['fsciId']);
            $totalFiles = array_shift($totalFiles);
            $totalFiles = array_shift($totalFiles);

            $folders[$key]['total']['folder'] = $totalFolder;
            $folders[$key]['total']['files'] = $totalFiles;
        }

        $currentFolderInfo = $this->em->find('Application\Entity\FileSystemClient', $parent);
        $files = $fsc_obj->getFiles($clientId, $parent);

        $bc_obj = new Breadcrumb($this->em);
        $bc = $bc_obj->add($parent);

        $array = array(
            'folders' => $folders,
            'files' => $files,
            'folder' => $parent,
            'bc' => $bc,
            'currentFolder' => $parent,
            'currentFolderInfo' => ($empty_obj->isValid($currentFolderInfo))?$currentFolderInfo:null,
            'client' => array(
                'name' => $this->clientName,
                'id' => $this->clientId,
                'type' => $this->clientType,
                'admin' => $this->clientAdmin
            )
        );

        return new ViewModel($array);
    }

    public function viewAction()
    {
        $filename = $this->params()->fromRoute('filename', false);
        $folder = $this->params()->fromRoute('folder', false);

	    $notEmpty_obj = new NotEmpty();
	    if(!$notEmpty_obj->isValid($filename))
	        throw new \RuntimeException("Invalid filename specified");

	    if(!$notEmpty_obj->isValid($folder))
	        throw new \RuntimeException("Invalid filename specified");

	    $file_obj = new FileSystemRepository($this->em);

	    $clientId = $this->clientId;
	    if($this->clientAdmin)
	    {
	        $fsc_obj = $this->em->find('Application\Entity\FileSystemClient', $folder);
	        if($notEmpty_obj->isValid($fsc_obj))
	            $clientId = $fsc_obj->getClii()->getCliiId();
	    }

	    $result = $file_obj->findFile($clientId, $filename);

	    if(!$notEmpty_obj->isValid($result))
	        throw new \RuntimeException("Invalid filename given");
	    $result = array_shift($result);

	    $notExists_obj = new NotExists();

	    $requiredFile = REPO_PATH.$result['fisvName'];
	    if($notExists_obj->isValid($requiredFile))
	    {
	        throw new \RuntimeException("Invalid filename given");
	    }

	    $file = array(
	        'folder' => $result['fsciParentId'],
	        'name' => $result['fisvName'],
	        'real_name' => $result['fscvRealName'],
	        'mimetype' => $result['fisvMimetype'],
	        'size' => String::fileSizeToHuman(filesize($requiredFile)),
	        'upload_date' => $result['fscdUploadDate']->format('d-m-Y'),
	        'description' => $result['fsctDescription']
	    );

        $bc_obj = new Breadcrumb($this->em);
        $bc = $bc_obj->add($result['fsciId']);

	    $array = array(
	        'file' => $file,
	        'bc' => $bc,
	        'client' => array(
	            'name' => $this->clientName,
	            'id' => $this->clientId,
	            'type' => $this->clientType,
	            'admin' => $this->clientAdmin
	        )
	    );

        return new ViewModel($array);
    }
}

?>
