<?php
namespace Repository\Controller;

use Zend\View\Model\ViewModel;
use Common\Controller\MainController;

class IndexController extends MainController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {
        return new ViewModel();
    }
}

?>