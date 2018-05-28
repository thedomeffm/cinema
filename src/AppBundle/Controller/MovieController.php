<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MovieController extends Controller
{

    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    public function create()
    {


        return $this->render('admin/Movie/create.html.twig', [

        ]);
    }
}
