<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin/index", name="admin_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $movies = $this->getDoctrine()->getRepository('AppBundle:Movie')->getWeeklyMovies(true);

        return $this->render('admin/index.html.twig', [
            'movies' => $movies,
        ]);
    }
}
