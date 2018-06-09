<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

            /** @var UploadedFile $image */
            $image = $movie->getImage();
            if($image){
                $date = new \DateTime();
                $fileName = $date->getTimestamp().'.'.$image->guessExtension();

                $image->move(
                    'movieImages',
                    $fileName
                );

                $movie->setImage($fileName);
            }else{
                $movie->setImage('default.jpeg');
            }

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

    /**
     * @Route("/admin/movie/remove", name="movie_remove")
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
        $movie = $em->getRepository('AppBundle:Movie')->findOneBy(array(
            'id' => $id
        ));

        if($movie){
            $em->remove($movie);
            $em->flush();
        }

        $this->addFlash('success', 'Film '.$movie->getName().' gelöscht!');

        return $this->redirectToRoute('movie_index',array(

        ));
    }

    /**
     * @Route("/admin/movie/edit", name="movie_edit")
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

        $movie = $this->getDoctrine()->getRepository('AppBundle:Movie')->find($id);
        $form = $this->createForm('AppBundle\Form\MovieEditType', $movie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($movie);
            $em->flush();

            $this->addFlash('success', 'Film '. $movie->getName(). ' bearbeitet.');
            return $this->redirectToRoute('movie_index', array());
        }

        return $this->render(':admin/movie:edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
