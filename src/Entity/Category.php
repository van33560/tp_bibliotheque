<?php


namespace App\Entity;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

    /**
     *@ORM\Entity(repositoryClass=CategoryRepository::class)
     */

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
     *
     */     private $title;


    /**
     *@ORM\Column(type="string")
     *
     */     private $color;

     /**
     * @ORM\Column(type="date", name="date_publication")
     */
            private $date;

    /**
     * @ORM\Column(type="datetime", name="created")
     */
            private $created;

    /**
     * @ORM\Column(type="boolean", name="published")
     */
            private $published;


             public function getTitle(): ?string
             {
                 return $this->title;
             }


             public function getColor(): ?string
            {
                return $this->color;
            }

            public function setColor(string $color): self
            {
                $this->color = $color;

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

            public function getCreated(): ?\DateTimeInterface
            {
                return $this->created;
            }

            public function setCreated(\DateTimeInterface $created): self
            {
                $this->created = $created;

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