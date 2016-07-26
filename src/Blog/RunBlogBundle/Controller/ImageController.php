<?php

namespace Blog\RunBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Blog\RunBlogBundle\Entity\Image;

class ImageController extends Controller
{
  /**
   * @Route("/voir", name="voir")
   * @Method({"GET", "POST" })
   */

  public function ImageAction(Request $request){
    $image = new Image();
    $form = $this->createFormBuilder($image)
              ->add('imageFile', VichImageType::class, array('label' => ' ', 'required' => false))
              ->getForm();

    $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
          $em = $this->getDoctrine()->getEntityManager();
          $em->persist($image);
          $em->flush();
          return $this->redirectToRoute('accueil');
      }
      return $this->render('BlogRunBlogBundle:image:image.html.twig', array(
            'form' => $form->createView()
          ));
  }
}
