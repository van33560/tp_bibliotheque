<?php


namespace App\Entity;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
// je creer les entitées de ma table
class Category
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @@ORM\Column(type="string")
     * @Assert\Length(
     *     min= 4,
     *     max=50,
     *     minMessage="trop peu de lettres!",
     *     maxMessage="trop de lettres!!"
     * )
     *
     */
    private $title;


    /**
     *@ORM\Column(type="string")
     *
     */
    private $color;

     /**
     * @ORM\Column(type="date", name="date_publication")
      *
     */
     private $date;

    /**
     * @ORM\Column(type="datetime", name="created_date")
     */
    private $createdDate;

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

     public function getTitle(): ?string
     {
         return $this->title;
     }
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

     public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {$this->color = $color;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }



    }