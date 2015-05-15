<?php

namespace Nz\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nz\TodoBundle\Model\TodoCollection;
use Nz\TodoBundle\Entity\Todo;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;

/**
 * Controller for Single Page App
 * 
 * @package Nz\TodoBundle\Controller
 * @author Nadir Zenith <2cb.md2@gmail.com>
 */
class AppController extends Controller
{

    /**
     * @Route("/", name="app_index")
     * @Template
     * Template("NzTodoBundle:App:hello.html.twig")
     */
    public function mainAppAction(Request $request)
    {
        return array();

        //return $this->render('NzTodoBundle:App:hello.html.twig', ['name' => 'tino']);

        /*return array(['name' => 'tino']);*/
    }
}
