<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Common\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManagerInterface;

class MainController extends AbstractActionController
{
    protected $em;
    protected $clientId = 1;

    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $this->setEm();
        $controller = $this;

        // PreDispatch
        $events->attach('dispatch', function ($e) use ($controller) {
            $this->preDispath();
        }, 100);

        // PostDispatch
        $events->attach('dispatch', function ($e) use ($controller) {
            $this->postDispatch();
        }, -100);
    }

    private function setEm()
    {
        $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    }

    private function preDispath()
    {

    }

    private function postDispatch()
    {

    }
}
