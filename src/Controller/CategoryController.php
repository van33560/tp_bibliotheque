<?php


namespace App\Controller;


use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
//je creer avec ma route un chemin ,j'utilise ma methode repository et find all pour recuperer tous le contenu de mes categories
//
{

    /**
    * @Route ("/category" ,name="category")
    */
    public function categoryList(CategoryRepository $categoryRepository)
    {


        $category = $categoryRepository->findAll();
        return $this->render('category.html.twig', [
            "category" => $category


        ]);

    }
     //je cree une methode public insertStatic en parametre entityManagerinterface qui va me permettre de faire les requetes insert,update, delete
    /**
     * @route("/category/insert-static",name="category_insert_static")
     */
        //inserer un article dans la BDD
      public function insertStaticCategory(EntityManagerInterface $entityManager1)
    {
      //j'utilise le proprietes de ma class entité
        $category = new Category();

        $category->setTitle("Titre de mon article");
        $category->setColor(" green");
        $category->setDate(new \DateTime());
        $category->setCreated(new \DateTime());
        $category->setPublished(true);

        //j'insere mes données statiques dans ma table article de ma BDD
        $entityManager1->persist($category);
        $entityManager1->flush();


        return $this->render('category_insert_static.html.twig');
    }



}