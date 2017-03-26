<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portal\Controller;

use Portal\Service\Someservice;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ObjectController extends AbstractActionController
{
   
    public function indexAction()
    {
      $napis_service = new Someservice;
      echo $napis_service->printSmt('Witaj Świecie');
      
      return new ViewModel();
    }
}
