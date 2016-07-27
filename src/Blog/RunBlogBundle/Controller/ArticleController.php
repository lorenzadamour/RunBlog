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

        $articlespublier = $em->getRepository('BlogRunBlogBundle:Article')->findby(array('public' => 'oui'));

        return $this->render('article/index.html.twig', array(
            'articles' => $articlespublier,
        ));
    }

    /**
     * Lists all Article entities.
     *
     * @Route("/admin", name="allarticle_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articles = $em->getRepository('BlogRunBlogBundle:Article')->findAll();

        return $this->render('article/Admin.html.twig', array(
            'articles' => $articles,
        ));
    }

    /**
     * Creates a new Article entity.
     *
     * @Route("/admin/new", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $article = new Article();
        $form = $this->createForm('Blog\RunBlogBundle\Form\ArticleType', $article);
        $form->handleRequest($request);
        $article->setDate(date("d-m-Y"))
                ->setNombredeJaime(0);
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
     * @Route("/{id}/like", name="like_article")
     * @Method({"GET", "POST"})
     */
    public function likeArticle(Article $article, Request $request)
    {
        $article->getId();
        $user = $this->getUser();
        $user->getId();

        $em = $this->getDoctrine()->getManager()->getRepository('BlogRunBlogBundle:Avis');
        $avis = $em->findBy(array('article' => $article ,'utilisateur' => $user));

        var_dump($avis);
        /*$avis = new Avis();
        $avis->setArticle($article)
             ->setUtilisateur($user)
             ->setReaction(1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();*/

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));

    }

    /**
     * Like Article entity.
     *
     * @Route("/{id}/dislike", name="dislike_article")
     * @Method({"GET", "POST"})
     */
    public function dislikeArticle(Article $article, Request $request)
    {
        $article->getId();
        $user = $this->getUser();
        $user->getId();


        $avis = new Avis();
        $avis->setArticle($article)
             ->setUtilisateur($user)
             ->setReaction(-1);

            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();

            return $this->redirectToRoute('article_show', array('id' => $article->getId()));

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
        $user = $this->getUser();
        $user->getId();
        $comment = $commentaire->getCommentaire();
        $commentaire->setUtilisateur($user)
                    ->setDate(date("d-m-Y"))
                    ->setArticle($article)
                    ->setCommentaire($comment);

        if ($form->isSubmitted() && $form->isValid()) {
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

            return $this->redirectToRoute('article_edit', array('id' => $article->getId()));
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
