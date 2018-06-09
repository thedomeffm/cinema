<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReservationController extends Controller
{

    /**
     * @Route("/book", name="book")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $id = $request->query->get('id');

        if(!is_numeric($id)){
            return $this->redirectToRoute('homepage', array());
        }
        $show = $this->getDoctrine()->getRepository('AppBundle:CinemaShow')->find($id);
        $settings = $this->getDoctrine()->getRepository('AppBundle:Cinema')->find(1);

        if(!$show){
            return $this->redirectToRoute('homepage', array());
        }

        $allReservations = $show->getReservation();
        $freeNormalSeats = $show->getHall()->getNumberOfSeatsNormal();
        $freeHandicappedSeats = $show->getHall()->getNumberOfSeatsHandicapped();

        foreach($allReservations as $reservation)
        {
            $freeNormalSeats -= $reservation->getNumberOfSeatsNormal();
            $freeHandicappedSeats -= $reservation->getNumberOfSeatsHandicapped();
        }

        $reservationEntity = new Reservation();
        $formReservatoin = $this->createForm('AppBundle\Form\ReservationType', $reservationEntity);


        $settingPrice = $settings->getBasePrice();
        if($show->getMovie()->getIs3d()){
            $settingPrice += $settings->getIs3dPrice();
        }
        if($show->getMovie()->getOvertime()){
            $settingPrice += $settings->getOvertimePrice();
        }

        $normalprice = $show->getMovie()->getNormalPrice() + $settingPrice;
        $handicappedPrice = $show->getMovie()->getHandicappedPrice() + $settingPrice;

        if($formReservatoin->isSubmitted() && $formReservatoin->isValid()){
            $nextAction = $formReservatoin->get('saveAndAdd')->isClicked()
                ? 'task_new'
                : 'tastk_success';
            return $this->redirectToRoute('book_person', array());

        }

        $person = new Person();
        $formPerson = $this->createForm('AppBundle\Form\PersonType', $person);


        if($formPerson->isSubmitted() && $formPerson->isValid()){//}) && $formReservatoin->isValid()){
            $em = $this->getDoctrine()->getManager();

            $endprice = $reservationEntity->getNumberOfSeatsNormal() * $normalprice +
                 $reservationEntity->getNumberOfSeatsHandicapped() * $handicappedPrice;
            $reservationEntity->setEndprice($endprice);
            $reservationEntity->setPerson($person);

            $em->persist($reservationEntity);
            $em->persist($person);
            $em->flush();

            return $this->redirectToRoute('homepage', array($formReservatoin));
        }

        return $this->render(':unsecured/reservation:book.html.twig', array(
            'show' =>  $show,
            'formReservation' => $formReservatoin->createView(),
            'formPerson' => $formPerson-> createView(),
            'seatsNormal' => $freeNormalSeats,
            'seatsHandicapped' => $freeHandicappedSeats,
            'normalprice' => $normalprice,
            'handicappedPrice' => $handicappedPrice,
        ));
    }

    /**
     * @Route("book/person", name="book_person")
     */
    public function reservationAction(){
        $person = new Person();
        $formPerson = $this->createForm('AppBundle\Form\PersonType', $person);

        $this->render(':unsecured/reservation:book_person.html.twig', array(
            'formPerson' => $formPerson->createView(),
        ));
    }
}