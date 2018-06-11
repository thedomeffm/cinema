<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Person;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UnsecuredController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $movieRepository = $this->getDoctrine()->getRepository('AppBundle:Movie');
        $showRepository = $this->getDoctrine()->getRepository('AppBundle:CinemaShow');

        $movies = $movieRepository->getWeeklyMovies();

        $today = new \DateTime();
        $thursday = new \DateTime();
        $thursday->setTime(0,0);

        if ( $today->format('l') !== 'Thursday' ) {
            $thursday->modify('last Thursday');
        }

        $friday = clone $thursday;
        $saturday = clone $thursday;
        $sunday = clone $thursday;
        $monday = clone $thursday;
        $tuesday = clone $thursday;
        $wednesday = clone $thursday;

        $friday->modify('+1 days');
        $saturday->modify('+2 days');
        $sunday->modify('+3 days');
        $monday->modify('+4 days');
        $tuesday->modify('+5 days');
        $wednesday->modify('+6 days');

        $count = count($movies);
        for ($i = 0; $i < $count; $i++) {
            $movies[$i]['cinemaShows'] = [];

            $movies[$i]['cinemaShows']['donnerstag'] = $showRepository->getShowsByDate($movies[$i]['id'], $thursday);
            $movies[$i]['cinemaShows']['freitag'] = $showRepository->getShowsByDate($movies[$i]['id'], $friday);
            $movies[$i]['cinemaShows']['samstag'] = $showRepository->getShowsByDate($movies[$i]['id'], $saturday);
            $movies[$i]['cinemaShows']['sonntag'] = $showRepository->getShowsByDate($movies[$i]['id'], $sunday);
            $movies[$i]['cinemaShows']['montag'] = $showRepository->getShowsByDate($movies[$i]['id'], $monday);
            $movies[$i]['cinemaShows']['dienstag'] = $showRepository->getShowsByDate($movies[$i]['id'], $tuesday);
            $movies[$i]['cinemaShows']['mittwoch'] = $showRepository->getShowsByDate($movies[$i]['id'], $wednesday);
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
    public function contactAction(Request $request)
    {
        $message = $request->get("message");

        $person = new Person();
        $form = $this->createForm('AppBundle\Form\PersonType', $person);

        $form->handleRequest($request);

        return $this->render('unsecured/contact.html.twig', [
            "form" => $form->createView(),
            "message" => $message
        ]);
    }

    /**
     * @Route("/approach", name="approach")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function approachAction()
    {
        return $this->render('unsecured/approach.html.twig', array(

        ));
    }
}
