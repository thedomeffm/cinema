<?php

namespace AppBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

        $form = $this->createFormBuilder()
            ->add('firstname', TextType::class,array(
                'label' => 'Vorname'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Nachname'
            ))
            ->add('mail', EmailType::class, array(
                'label' => 'E-Mail Adresse'
            ))
            ->add('mailText', TextareaType::class, array(
                'label' => 'Ihre Nachricht',
            ))
            ->getForm()
        ;


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->sendMailAction($data, $this->getMailer());

            $this->addFlash('success', 'Nachricht versendet!');
            $this->redirectToRoute('contact');
        }

        return $this->render('unsecured/contact.html.twig', [
            "form" => $form->createView(),
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

    /**
     * @param $data
     * @param \Swift_Mailer $mailer
     */
    public function sendMailAction($data, \Swift_Mailer $mailer)
    {
        //get the recipient
        $mail = 'matthias.feyll@reservix.de';
        //create the subject here
        $subject = 'Anfrage Kontaktformular: ' . $mail . ' | Kinomaxx';
        //Create Message
        $message = new \Swift_Message();

        //combine everything
        $message
            ->setSubject($subject)
            ->setFrom('reservix.blackboard@gmail.com')
            ->setTo($mail)
            ->setReplyTo('matthias.feyll@reservix.de')
            ->setBody(
                $this->renderView(
                    ':mails:contactForm.html.twig',
                    [
                        'mail' => $mail,
                        'data' => $data,
                    ]
                ),
                'text/html'
            );


        try {
            $mailer->send($message);
        } catch (\Swift_TransportException $e) {
            sleep(3);
            $mailer->send($message);
        }
        return;
    }

    /**
     * @return object|\Swift_Mailer
     */
    private function getMailer()
    {
        return $this->container->get('mailer');
    }
}
