<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\CinemaShow;
use Doctrine\Common\Util\Debug;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UnsecuredController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $movies = $this->getDoctrine()->getRepository('AppBundle:Movie')->getWeeklyMovies();

        /** @var Movie $movie */
        foreach ($movies as $movie) {
            if ($movie['cinemaShows'][0]) {
            }
        }

        return $this->render('unsecured/index.html.twig', [
            'movies' => $movies,
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
