<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MovieController extends Controller
{
    /**
     * @Route("/admin/movie/index", name="movie_index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $movies = $this->getDoctrine()->getRepository('AppBundle:Movie')->findAll();

        return $this->render('admin/movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/admin/movie/create", name="movie_create")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $movie = new Movie();

        $form = $this->createForm('AppBundle\Form\MovieType', $movie);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'Film '. $movie->getName() .' gepeichert!');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('admin/movie/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
