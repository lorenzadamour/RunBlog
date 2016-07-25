<?php

namespace Blog\RunBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\OneToOne(targetEntity="Administrateur", mappedBy="user")
    */
    protected $administrateur;

    /**
    * @ORM\OneToOne(targetEntity="Utilisateur", mappedBy="user")
    */
    protected $utilisateur;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set administrateur
     *
     * @param \Blog\RunBlogBundle\Entity\Administrateur $administrateur
     *
     * @return User
     */
    public function setAdministrateur(\Blog\RunBlogBundle\Entity\Administrateur $administrateur = null)
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    /**
     * Get administrateur
     *
     * @return \Blog\RunBlogBundle\Entity\Administrateur
     */
    public function getAdministrateur()
    {
        return $this->administrateur;
    }

    /**
     * Set utilisateur
     *
     * @param \Blog\RunBlogBundle\Entity\Utilisateur $utilisateur
     *
     * @return User
     */
    public function setUtilisateur(\Blog\RunBlogBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \Blog\RunBlogBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
}
