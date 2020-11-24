<?php


namespace App\Entity;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

   /**
    *@ORM\Entity(repositoryClass=ArticleRepository::class);
    */
// avec ORM je creer le contenu de ma table en donnant des valeurs, proprieté private securise les données  //
class Article
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     *
     */
    private $title;


    /**
     *@ORM\Column(type="string",length=300)
     *
     */
    private $content;

    /**
     *@ORM\Column(type="string")
     *
     */
    private $image;

    /**
     * @ORM\Column(type="date", name="date_publication")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean", name="published")
     */
    private $published;

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
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published): void
    {
        $this->published = $published;
    }





}