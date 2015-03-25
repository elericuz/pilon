<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
<<<<<<< HEAD
=======
use Zend\Validator\NotEmpty;
use Zend\Validator\File\NotExists;
use Common\Classes\String;
use Repository\Model\FileSystemRepository;
>>>>>>> 54c1ca1... FREN-002 now it's possible create/add folders as well as files within other folders separated by clients

class IndexController extends MainController
{
    public function indexAction()
    {
<<<<<<< HEAD
        return new ViewModel();
=======
        $parent = $this->params()->fromRoute('folder', 0);

        $fsc_obj = new FileSystemRepository($this->em);
        $folders = $fsc_obj->getFolders(1, $parent);
        $files = $fsc_obj->getFiles(1, $parent);

        $array = array(
            'folders' => $folders,
            'files' => $files,
            'folder' => $parent
        );

        return new ViewModel($array);
>>>>>>> 54c1ca1... FREN-002 now it's possible create/add folders as well as files within other folders separated by clients
    }

    public function viewAction()
    {
<<<<<<< HEAD
        return new ViewModel();
=======
        $filename = $this->params()->fromRoute('filename', false);

	    $notEmpty_obj = new NotEmpty();
	    if(!$notEmpty_obj->isValid($filename))
	        throw new \RuntimeException("Invalid filename specified");

	    //$file_obj = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisvName'=>$filename, 'fisvStatus'=>1));

	    $file_obj = new FileSystemRepository($this->em);

	    $result = $file_obj->findFile(1, $filename);

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

	    $array = array(
	        'file' => $file
	    );

        return new ViewModel($array);
>>>>>>> 54c1ca1... FREN-002 now it's possible create/add folders as well as files within other folders separated by clients
    }
}

?>