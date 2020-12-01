<?php


namespace App\Entity;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string")
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
     * la mappedBy et la relation inverse vers les articles
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="Category")
     */
    private $articles;


    //la methode construct est appelée a chaque instantiation de nouvel category,objet ici un tableau ArrayCollection
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

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

    /**
     * @return Collection|Article[]
     */
    //methode collection recupere  le contenu de l'array qui contient les articles
    public function getArticles(): Collection
    {
        return $this->articles;
    }
    // la methode add article va permettre de rajouter des articles sans les supprimer
    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setCategory($this);
        }

        return $this;
    }
    //cette methode permet de supprimer un article sans supprimer les autres
    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory(null);
            }
        }

        return $this;
    }



    }