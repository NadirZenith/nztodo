<?php

namespace Nz\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
    /*
     * Get main app
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing todos.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many todos to return.")
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */

    /**
     * @Route("/", name="app_index")
     * @Template()
     */
    public function mainAppAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        return array();
    }
}
