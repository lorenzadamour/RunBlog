<?php

namespace Blog\RunBlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\RunBlogBundle\Entity\Avis;


/**
 * Article controller.
 *
 * @Route("/avis")
 */
class AvisController extends Controller
{


  /*public function likeAction($id)
  {
      //Recupere utilisateur connecté
      $user = $this->getUser();
      $user_id = $user->getUtilisateur();

      //Recupere commentaire
      $getCommentFromDatabase = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Commentaire');
      $commentOfDatabase = $getCommentFromDatabase->find($id);

      //Crée un avis
      $avis = new Avis();
      $avis ->setUtilisateur($user_id)
            ->setCommentaire($commentOfDatabase)
            ->setReaction(1);

      //Met l'avis en base de donnée
      $em = $this->getDoctrine()->getManager();
      $em->persist($avis);
      $em->flush();

      return $this->redirectToRoute('article');
  }*/


/*  public function dislikeAction($id)
  {
    $user = $this->getUser();
    $user_id = $user->getUtilisateur();

    $getCommentFromDatabase = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Commentaire');
    $commentOfDatabase = $getCommentFromDatabase->find($id);

    $avis = new Avis();
    $avis ->setUtilisateur($user_id)
          ->setCommentaire($commentOfDatabase)
          ->setReaction(-1);

    $em = $this->getDoctrine()->getManager();
    $em->persist($avis);
    $em->flush();

    return $this->redirectToRoute('article');
  }*/

  /**
   * Lists Avis.
   *
   * @Route("/", name="avis_index")
   * @Method("GET")
   */
  public function indexAction()
  {
      $em = $this->getDoctrine()->getManager();

      $articles = $em->getRepository('BlogRunBlogBundle:Avis')->findAll();

      return $this->render('avis/index.html.twig', array(
          'avis' => $avis,
      ));
  }




}
