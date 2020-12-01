<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
   //la class contraints as Assert permet de mettre des contraintes sur les entités

   /**
    * @ORM\Entity(repositoryClass=ArticleRepository::class)
    */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // assert est l'alias de contrainte est permet ici avec la classe not\blank pour afficher un message d'erreur si le champn'est pas rempli
    //asset lenght permet de determiner une nombre de caractere minimum et maximum sinon le message d'affiche

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Merci de remplir le titre"
     * )
     * @Assert\Length(
     *     min= 4,
     *     max=10,
     *     minMessage="trop peu de lettres!",
     *     maxMessage="trop de lettres!!"
     * )
     *
     */
    private $title;

    /**
     * @ORM\Column(type="text", length=255)
     * @Assert\NotBlank(
     *     message="Merci de remplir le contenu"
     * )
     * @Assert\Length (
     *     min= 200,
     *     max= 500,
     *     minMessage= "veuillez ecrire au minimum 200 caractéres",
     *     maxMessage= "Vous avez depasser les caractéres maximum autorisés"
     * )
     */
    private $content;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     * @var string A "Y-m-d H:i:s" formatted value
     */


    private $publicationDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creationDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublished;

    /**
     * grace a la ligne de commande bin/console make:entity j'ai ajouté une propriete a mon entité
     * celle ci crée une relation vers ma table category inversedBy pointe vers ma category target entite ciblée
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="articles")
     */
    private $Category;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * @param mixed $publicationDate
     */
    public function setPublicationDate($publicationDate): void
    {
        $this->publicationDate = $publicationDate;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }




}