<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CinemaShow;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowController extends Controller
{
    /**
     * @Route("/admin/show/index", name="show_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $shows = $this->getDoctrine()->getRepository('AppBundle:CinemaShow')->findAll();

        return $this->render('admin/show/index.html.twig', [
            'shows' => $shows,
        ]);
    }

    /**
     * @Route("/admin/show/create", name="show_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $show = new CinemaShow();

        $form = $this->createForm('AppBundle\Form\CinemaShowType', $show);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($show);
            $em->flush();

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/show/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
