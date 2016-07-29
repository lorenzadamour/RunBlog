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
      $em = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Article');
      $article = $em->findBy(array(), array('id' => 'desc'),4,0);

      return $this->render('BlogRunBlogBundle:Default:index.html.twig', array(
            'article' => $article,
      ));
        /*return $this->render('BlogRunBlogBundle:Default:index.html.twig');*/
    }
}
