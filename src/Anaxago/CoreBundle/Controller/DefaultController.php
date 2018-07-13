<?php

namespace Anaxago\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
       return $this->render('@AnaxagoCore/Default/index.html.twig');
    }
}
