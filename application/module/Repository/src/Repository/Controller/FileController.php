<?php
namespace Repository\Controller;

use Common\Controller\MainController;
use Zend\Validator\NotEmpty;
use Zend\Validator\File\NotExists;
use Application\Entity\FileSystem;
use Application\Entity\FileSystemClient;
use Application\Entity\FileSystemDownload;
use Repository\Model\FileSystemRepository;

/**
 * FileController
 *
 * @author Eric Valera Miller
 *
 * @version 1.0
 *
 */
class FileController extends MainController
{
    public function addAction()
    {
        $request = $this->getRequest();
        if($request->isPost())
        {
            $notEmpty_obj = new NotEmpty();
            $notExists_obj = new NotExists();

            $file = $_FILES['file'];

            if(!$notExists_obj->isValid($file['tmp_name']) && $notEmpty_obj->isValid(trim($file['name'])))
            {
                $destinationFile = REPO_PATH.md5($file['tmp_name']);

                if($notExists_obj->isValid($destinationFile))
                {
                    move_uploaded_file($file['tmp_name'], $destinationFile);
                }

                $Client_obj = $this->em->find('Application\Entity\Client', $this->clientId);

                $FS_obj = new FileSystem();
                $FS_obj->setFisiParentId(0)
                       ->setFisiType(1)
                       ->setFisvName(md5($file['tmp_name']))
                       ->setFisvRealName(trim($file['name']))
                       ->setFisvMimetype($file['type'])
                       ->setFistDescription($request->getPost('file_description'))
                       ->setFisdUploadDate(new \DateTime("now"))
                       ->setFisvUploadIp($_SERVER['REMOTE_ADDR']);
                $this->em->persist($FS_obj);

                $FSC_obj = new FileSystemClient();
                $FSC_obj->setFsciParentId(0)
                        ->setClii($Client_obj)
                        ->setFisi($FS_obj)
                        ->setFsciParentId($request->getPost('folder'))
                        ->setFscvRealName(trim($file['name']))
                        ->setFscvFriendlyName(trim($file['name']))
                        ->setFsctDescription($request->getPost('file_description'))
                        ->setFscdUploadDate(new \DateTime("now"));
                $this->em->persist($FSC_obj);

                $this->em->flush();

                return $this->redirect()->toRoute('my-repo', array('folder'=>$request->getPost('folder')));
            }
        }
        else
        {
            return $this->redirect()->toRoute('dashboard');
        }
    }

	public function downloadAction()
	{
	    $filename = $this->params()->fromRoute('filename', false);

	    $notEmpty_obj = new NotEmpty();
	    if(!$notEmpty_obj->isValid($filename))
	        throw new \RuntimeException("Invalid filename specified");

	    $file_obj = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisvName'=>$filename, 'fisvStatus'=>1));

	    if(!$notEmpty_obj->isValid($file_obj))
	        throw new \RuntimeException("Invalid filename given");

	    foreach($file_obj as $file)
	    {
	        $id = $file->getFisiId();
	        $name = $file->getFisvRealName();
	        $mime = $file->getFisvMimetype();
	        $realFile = $file->getFisvName();
	    }

	    $FSC_obj = $this->em->getRepository('Application\Entity\FileSystemClient')->findOneBy(array('fisi'=>$id, 'clii'=>$this->clientId));

        $fsciTotalDownload = $FSC_obj->getFsciTotalDownload()+1;

	    $FSD_obj = new FileSystemDownload();
	    $FSD_obj->setFsci($FSC_obj)
	            ->setFsddDownloadDate(new \DateTime("now"))
	            ->setFsdvDownloadIp($_SERVER['REMOTE_ADDR']);
	    $this->em->persist($FSD_obj);

	    $FSC_obj = $this->em->find('Application\Entity\FileSystemClient', $FSC_obj->getFsciId());
	    $FSC_obj->setFsciTotalDownload($fsciTotalDownload);
	    $this->em->persist($FSC_obj);

	    $this->em->flush();

	    $notExists_obj = new NotExists();

	    $requiredFile = REPO_PATH.$realFile;

	    if($notExists_obj->isValid($requiredFile))
	    {
	        throw new \RuntimeException("Invalid filename given");
	    }

	    $response = new \Zend\Http\Response\Stream();
	    $response->setStream(fopen($requiredFile, 'r'));
	    $response->setStatusCode(200);
	    ob_end_clean();

	    $headers = new \Zend\Http\Headers();
	    $headers->addHeaderLine("Content-Type: $mime; charset=UTF-8")
	            ->addHeaderLine('Content-Disposition: attachment; filename="'.$name.'"')
	            ->addHeaderLine("Content-Transfer-Encoding: binary")
	            ->addHeaderLine("Content-Length", filesize($requiredFile));
	    $response->setHeaders($headers);

	    return $response;
	}

	public function deleteAction()
	{
	    $request = $this->getRequest();
	    if($request->isPost())
	    {
	        $FSR_obj = new FileSystemRepository($this->em);

	        $children = $FSR_obj->getChildrenId($this->clientId, $request->getPost('folder'), 1);

	        $FSC_obj = new FileSystemClient();
	        $files = $request->getPost('files');
	        foreach($files as $file)
	        {
	            if(in_array($file, $children))
	            {
	                $FSC_obj = $this->em->find('Application\Entity\FileSystemClient', $file);
	                $FSC_obj->setFsciStatus(0);
	                $this->em->persist($FSC_obj);
	                $this->em->flush();
	            }
	        }

	        return $this->redirect()->toRoute('my-repo', array('folder'=>$request->getPost('folder')));
	    }
	    else
	    {
	        return $this->redirect()->toRoute('dashboard');
	    }
	}
}
