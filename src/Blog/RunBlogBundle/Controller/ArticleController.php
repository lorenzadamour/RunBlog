<?php

namespace Blog\RunBlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\RunBlogBundle\Entity\Article;
use Blog\RunBlogBundle\Entity\Avis;
use Blog\RunBlogBundle\Entity\Commentaire;
use Blog\RunBlogBundle\Form\ArticleType;
use Blog\RunBlogBundle\Form\CommentaireType;

/**
 * Article controller.
 *
 * @Route("/article")
 */
class ArticleController extends Controller
{
  /**
   * Lists Article Published.
   *
   * @Route("/", name="article_index")
   * @Method("GET")
   */
  public function articlesPublierAction()
  {
      $em = $this->getDoctrine()->getManager();
      $articlespublier = $em->getRepository('BlogRunBlogBundle:Article')->findby(array('public' => 'oui'),array('id' => 'desc'));
      return $this->render('article/index.html.twig', array(
          'articles' => $articlespublier,
      ));
  }

  /**
       * Lists all Article entities.
       *
       * @Route("/admin/", name="allarticle_index")
       * @Method("GET")
       */
      public function indexAction()
      {
          $em = $this->getDoctrine()->getManager();
          $articles = $em->getRepository('BlogRunBlogBundle:Article')->findby(array(),array('id' => 'desc'));
          return $this->render('article/Admin.html.twig', array(
              'articles' => $articles,
          ));
      }


     /*public function aimerAction(){
       $em = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Article');
       $article = $em->findBy(array(), array('date' => 'desc'),3,0);

       return $this->render('commentaire/cequiaime.html.twig', array(
             'article' => $article,
       ));
     }*/

    /**
     * Creates a new Article entity.
     *
     * @Route("/admin/new", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $user->getId();
        $article = new Article();
        $form = $this->createForm('Blog\RunBlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);
        $article->setDate(date("d-m-Y"))
                ->setUtilisateur($user);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render('article/new.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
        ));
    }

    /**
     * Like Article entity.
     *
     * @Route("/{id}/likearticle", name="like_article")
     * @Method({"GET", "POST"})
     */
    public function likeArticle(Article $article, Request $request)
    {
        if ($this->getUser()) {
        $article->getId();
        $user = $this->getUser();
        $user->getId();
        $em = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Avis');
        $avis = $em->findBy(array('article' => $article ,'utilisateur' => $user));
        if ($avis) {
          return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }else {
          $avis = new Avis();
          $avis->setArticle($article)
               ->setUtilisateur($user)
               ->setReaction(1);
          $em = $this->getDoctrine()->getManager();
          $em->persist($avis);
          $em->flush();
          return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }
      }
      return $this->redirectToRoute('fos_user_security_login');
    }
    /**
     * Like Article entity.
     *
     * @Route("/{article}/{commentaire}/likecommentaire", name="like_commentaire")
     * @Method({"GET", "POST"})
     */
    public function likeComment(Article $article, Commentaire $commentaire, Request $request)
    {
        if ($this->getUser()) {
        $article->getId();
        $commentaire->getId();
        $user = $this->getUser();
        $user->getId();
        $em = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Avis');
        $avis = $em->findBy(array('commentaire' => $commentaire ,'utilisateur' => $user));
        if ($avis) {
          return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }else {
          $avis = new Avis();
          $avis->setCommentaire($commentaire)
               ->setUtilisateur($user)
               ->setReaction(1);
          $em = $this->getDoctrine()->getManager();
          $em->persist($avis);
          $em->flush();
          return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }
      }
      return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * Finds and displays a Article entity.
     *
     * @Route("/{id}", name="article_show")
     * @Method({"GET", "POST"})
     */
    public function showAction(Article $article, Request $request)
    {
        $deleteForm = $this->createDeleteForm($article);

        $commentaire = new Commentaire();
        $form = $this->createForm('Blog\RunBlogBundle\Form\CommentaireType', $commentaire);
        $form->handleRequest($request);

        $article->getId();
        /*$user = $this->getUser();
        $user->getId();*/
        $comment = $commentaire->getCommentaire();
        $commentaire->setDate(date("d-m-Y"))
                    ->setArticle($article)
                    ->setCommentaire($comment);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $user->getId();
            $commentaire->setUtilisateur($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($commentaire);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));
        }

        return $this->render('article/show.html.twig', array(
            'article' => $article,
            'form' => $form->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     * @Route("/admin/{id}/edit", name="article_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Article $article)
    {
        $deleteForm = $this->createDeleteForm($article);
        $editForm = $this->createForm('Blog\RunBlogBundle\Form\ArticleType', $article);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $article->setDate(date("d-m-Y"));
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('allarticle_index', array('id' => $article->getId()));
        }

        return $this->render('article/edit.html.twig', array(
            'article' => $article,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Article entity.
     *
     * @Route("/admin/{id}", name="article_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Article $article)
    {
        $form = $this->createDeleteForm($article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('article_index');
    }

    /**
     * Creates a form to delete a Article entity.
     *
     * @param Article $article The Article entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Article $article)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $article->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
