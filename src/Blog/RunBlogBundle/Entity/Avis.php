<?php

namespace Blog\RunBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Avis
 *
 * @ORM\Table(name="avis")
 * @ORM\Entity(repositoryClass="Blog\RunBlogBundle\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="reaction", type="integer")
     */
    private $reaction;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="avis")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    private $utilisateur;

    /**
    * @ORM\ManyToOne(targetEntity="Commentaire", inversedBy="avis")
    * @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id")
    */
    protected $commentaire;

    /**
    * @ORM\ManyToOne(targetEntity="Article", inversedBy="avis")
    * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
    */
    protected $article;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set reaction
     *
     * @param integer $reaction
     *
     * @return Avis
     */
    public function setReaction($reaction)
    {
        $this->reaction = $reaction;

        return $this;
    }

    /**
     * Get reaction
     *
     * @return integer
     */
    public function getReaction()
    {
        return $this->reaction;
    }

    /**
     * Set utilisateur
     *
     * @param \Blog\RunBlogBundle\Entity\User $utilisateur
     *
     * @return Avis
     */
    public function setUtilisateur(\Blog\RunBlogBundle\Entity\User $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Blog\RunBlogBundle\Entity\User
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set commentaire
     *
     * @param \Blog\RunBlogBundle\Entity\Commentaire $commentaire
     *
     * @return Avis
     */
    public function setCommentaire(\Blog\RunBlogBundle\Entity\Commentaire $commentaire = null)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return \Blog\RunBlogBundle\Entity\Commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set article
     *
     * @param \Blog\RunBlogBundle\Entity\Article $article
     *
     * @return Avis
     */
    public function setArticle(\Blog\RunBlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Blog\RunBlogBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }
}
