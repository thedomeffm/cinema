<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\CinemaShow;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UnsecuredController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $movie = array_fill(0, 7, null);
        $cm = new CinemaShow();
        $cm->setDate(new \DateTime());

        For($i = 0; $i < sizeof($movie); $i++)
        {
            $movie[$i] = new Movie();
            $movie[$i]->setName("Movie: ".$i);
            $movie[$i]->setDescription("Description: ".$i);
            $movie[$i]->setDuration(120);
            $movie[$i]->setAgeRating(18);
            $movie[$i]->setIs3d(false);
            $movie[$i]->setCinemaShows($cm);
            $movie[$i]->setCinemaShows($cm);
            $movie[$i]->setCinemaShows($cm);
            $movie[$i]->setCinemaShows($cm);
            $movie[$i]->setCinemaShows($cm);
        }


        return $this->render('unsecured/index.html.twig', [
            "movies" => $movie,
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
