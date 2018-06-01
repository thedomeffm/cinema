<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Cinema;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CinemaController extends Controller
{
    /**
     * @Route("/admin/cinema/settings", name="cinema_settings")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function cinemaSetting(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $cinema = $doctrine->getRepository('AppBundle:Cinema')->find(1);

        if ($cinema === null) {
            $cinema = new Cinema();

            $cinema->setBasePrice(0);
            $cinema->setIs3dPrice(0);
            $cinema->setOvertimePrice(0);
            $cinema->setSneakPrice(0);

            $em->persist($cinema);
            $em->flush();
        }

        $form = $this->createForm('AppBundle\Form\CinemaType', $cinema);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cinema);
            $em->flush();

            $this->addFlash('success', 'Änderungen übernommen!');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/cinema/settings.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
