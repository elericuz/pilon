<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;
use Repository\Model\FileSystemRepository;

class IndexController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function dashboardAction()
    {
        $fsc_obj = new FileSystemRepository($this->em);

        $files = $fsc_obj->getLastUploadedFiles($this->clientId);

        $downloads = $fsc_obj->getMostDownloadFiles($this->clientId);

        $array = array(
            'files' => $files,
            'downloads' => $downloads
        );

        return new ViewModel($array);
    }
}
