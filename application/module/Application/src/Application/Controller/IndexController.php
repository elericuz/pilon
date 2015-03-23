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

class IndexController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function dashboardAction()
    {
        $files_obj = $this->em->getRepository('Application\Entity\FileSystem')->findBy(array('fisiParentId'=>0, 'fisiType'=>1, 'fisvStatus'=>1), array('fisdUploadDate'=>'desc'));

        $array = array(
            'files' => $files_obj
        );

        return new ViewModel($array);
    }
}
