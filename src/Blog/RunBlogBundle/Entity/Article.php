<?php

namespace Blog\RunBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="Blog\RunBlogBundle\Repository\ArticleRepository")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Article
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="text")
     */
    private $public;

    /**
    * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="article", cascade={"remove", "persist"}))
    */
    private $commentaire;

    /**
    * @ORM\OneToMany(targetEntity="Avis", mappedBy="article", cascade={"remove", "persist"}))
    */
    private $avis;

    /**
    * @ORM\ManyToOne(targetEntity="User", inversedBy="article")
    * @ORM\JoinColumn(name="User_id", referencedColumnName="id")
    */
    private $utilisateur;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set date
     *
     * @param string $date
     *
     * @return Article
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Article
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add commentaire
     *
     * @param \Blog\RunBlogBundle\Entity\Commentaire $commentaire
     *
     * @return Article
     */
    public function addCommentaire(\Blog\RunBlogBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Blog\RunBlogBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Blog\RunBlogBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
* If manually uploading a file (i.e. not using Symfony Form) ensure an instance
* of 'UploadedFile' is injected into this setter to trigger the  update. If this
* bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
* must be able to accept an instance of 'File' as the bundle will inject one here
* during Doctrine hydration.
*
* @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
*
* @return Product
*/
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

          if ($image) {
    // It is required that at least one field changes if you are using doctrine
    // otherwise the event listeners won't be called and the file is lost
        $this->updatedAt = new \DateTime('now');
  }
        return $this;
}
/**
* @return File
*/
    public function getImageFile()
    {

  return $this->imageFile;
    }


    /**
     * Set public
     *
     * @param string $public
     *
     * @return Article
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Add avi
     *
     * @param \Blog\RunBlogBundle\Entity\Avis $avi
     *
     * @return Article
     */
    public function addAvi(\Blog\RunBlogBundle\Entity\Avis $avi)
    {
        $this->avis[] = $avi;

        return $this;
    }

    /**
     * Remove avi
     *
     * @param \Blog\RunBlogBundle\Entity\Avis $avi
     */
    public function removeAvi(\Blog\RunBlogBundle\Entity\Avis $avi)
    {
        $this->avis->removeElement($avi);
    }

    /**
     * Get avis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set utilisateur
     *
     * @param \Blog\RunBlogBundle\Entity\User $utilisateur
     *
     * @return Article
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
}
