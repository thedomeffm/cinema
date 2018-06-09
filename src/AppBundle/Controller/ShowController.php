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

            $this->addFlash('success', 'Vorstellung gepeichert!');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/show/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/show/remove", name="show_remove")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function remove(Request $request)
    {
        $id = $request->query->get('id');

        if(!is_numeric($id)){
            throw $this->createNotFoundException('Expect an Integer-ID');
        }

        $em = $this->getDoctrine()->getManager();
        $show = $em->getRepository('AppBundle:CinemaShow')->findOneBy(array(
            'id' => $id
        ));

        if($show){
            $em->remove($show);
            $em->flush();
        }

        $this->addFlash('success', 'Vorstellung gelöscht!');

        return $this->redirectToRoute('show_index',array(

        ));
    }

    /**
     * @Route("/admin/show/edit", name="show_edit")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request)
    {
        $id = $request->query->get('id');

        if(!is_numeric($id)){
            throw $this->createNotFoundException('Expected an Integer-ID');
        }

        $show = $this->getDoctrine()->getRepository('AppBundle:CinemaShow')->find($id);
        $form = $this->createForm('AppBundle\Form\CinemaShowType', $show);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($show);
            $em->flush();

            $this->addFlash('success', 'Vorstellung '. $show->getName(). ' bearbeitet.');
            return $this->redirectToRoute('show_index', array());
        }

        return $this->render(':admin/show:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
