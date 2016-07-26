<?php

namespace Blog\RunBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/",name="accueil")
     */
    public function indexAction()
    {
        return $this->render('BlogRunBlogBundle:Default:index.html.twig');
    }
}
