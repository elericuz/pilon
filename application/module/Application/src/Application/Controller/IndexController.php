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
<<<<<<< HEAD

=======
        $fsc_obj = new FileSystemRepository($this->em);

        $files = $fsc_obj->getLastUploadedFiles(1);

        $array = array(
            'files' => $files
        );

        return new ViewModel($array);
>>>>>>> 54c1ca1... FREN-002 now it's possible create/add folders as well as files within other folders separated by clients
    }
}
