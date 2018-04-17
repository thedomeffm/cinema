<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $doctrine = $this->getDoctrine();

        $repository = $doctrine->getRepository('AppBundle:User');

        $data = $repository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'alleNutzer' => $data,
        ]);
    }
}
