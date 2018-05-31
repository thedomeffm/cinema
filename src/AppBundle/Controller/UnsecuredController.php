<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CinemaShow;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Movie;
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
        $movie = array_fill(0, 2, null);
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
    public function contactAction(Request $request)
    {
        $message = $request->get("message");

        $person = new Person();
        $form = $this->createForm('AppBundle\Form\PersonType', $person);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            //Send Mail Message

            return $this->redirectToRoute('contact', array(
                "message" => $person->getFirstname(). " ". $person->getLastname(). " erfolgreich gespeichert.",
            ));
        }

        return $this->render('unsecured/contact.html.twig', [
            "form" => $form->createView(),
            "message" => $message
        ]);
    }
}
