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
        $parent = $this->params()->fromRoute('folder', 0);

        $fsc_obj = new FileSystemRepository($this->em);
        $folders = $fsc_obj->getFolders($this->clientId, $parent);
        $files = $fsc_obj->getFiles($this->clientId, $parent);

        $bc_obj = new Breadcrumb($this->em);
        $bc = $bc_obj->add($parent);

        $array = array(
            'folders' => $folders,
            'files' => $files,
            'folder' => $parent,
            'bc' => $bc,
            'currentFolder' => $parent
        );

        return new ViewModel($array);
    }

    public function viewAction()
    {
        $filename = $this->params()->fromRoute('filename', false);

	    $notEmpty_obj = new NotEmpty();
	    if(!$notEmpty_obj->isValid($filename))
	        throw new \RuntimeException("Invalid filename specified");

	    $file_obj = new FileSystemRepository($this->em);

	    $result = $file_obj->findFile($this->clientId, $filename);

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
	        'bc' => $bc
	    );

        return new ViewModel($array);
    }
}

?>
