<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Zend\Validator\NotEmpty;
use Zend\Validator\File\NotExists;
use Common\Classes\String;

class IndexController extends MainController
{
    public function indexAction()
    {
        $folders = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisiType'=>0, 'fisvStatus'=>1));
        $files = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisiType'=>1, 'fisvStatus'=>1));

        $array = array(
            'folders' => $folders,
            'files' => $files
        );

        return new ViewModel($array);
    }

    public function viewAction()
    {
        $filename = $this->params()->fromRoute('filename', false);

	    $notEmpty_obj = new NotEmpty();
	    if(!$notEmpty_obj->isValid($filename))
	        throw new \RuntimeException("Invalid filename specified");

	    $file_obj = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisvName'=>$filename, 'fisvStatus'=>1));

	    if(!$notEmpty_obj->isValid($file_obj))
	        throw new \RuntimeException("Invalid filename given");

	    $notExists_obj = new NotExists();

	    foreach($file_obj as $files)
	    {
	        $requiredFile = REPO_PATH.$files->getFisvName();

	        if($notExists_obj->isValid($requiredFile))
	        {
	            throw new \RuntimeException("Invalid filename given");
	        }

	        $file = array(
	            'name' => $files->getFisvName(),
	            'real_name' => $files->getFisvRealName(),
	            'mimetype' => $files->getFisvMimetype(),
	            'size' => String::fileSizeToHuman(filesize($requiredFile)),
	            'upload_date' => $files->getFisdUploadDate()->format('d-m-Y'),
	            'description' => $files->getFistDescription()
	        );
	    }

	    $array = array(
	        'file' => $file
	    );

        return new ViewModel($array);
    }
}

?>