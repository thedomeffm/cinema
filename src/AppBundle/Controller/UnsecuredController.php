<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnsecuredController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('unsecured/index.html.twig', [
            //---
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactAction()
    {
        // replace this example code with whatever you need
        return $this->render('unsecured/contact.html.twig', [
            //---
        ]);
    }
}
