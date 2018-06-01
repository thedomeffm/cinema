<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hall;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HallController extends Controller
{
    /**
     * @Route("/admin/hall/index", name="hall_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $halls = $this->getDoctrine()->getRepository('AppBundle:Hall')->findAll();

        return $this->render('admin/hall/index.html.twig', [
            'halls' => $halls,
        ]);
    }

    /**
     * @Route("/admin/hall/create", name="hall_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $hall = new Hall();

        $form = $this->createForm('AppBundle\Form\HallType', $hall);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($hall);
            $em->flush();

            $this->addFlash('success', 'Saal '. $hall->getName() .' gepeichert!');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/hall/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
