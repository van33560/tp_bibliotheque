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
    //categorylist est ne nom de ma methode categoryrepository va me permettre de recuperer le contenu de ma base de données
     public function categoryList(CategoryRepository $categoryRepository)
{

    //findall est une propriete de symfony et va me permettre de recuperer toutes les données
     $category = $categoryRepository->findAll();
     return $this->render('category.html.twig', [
    "category" => $category


]);

    }
     //je cree une nouvelle route pour pouvoir rentrer des données static (nouvelle donnée)une methode public insertStatic en parametre entityManagerinterface qui va me permettre de faire les requetes insert,update, delete
    /**
     * @route("/category/insert-static",name="category_insert_static")
     */
        //inserer un article dans la BDD
        public function insertStaticCategory(EntityManagerInterface $entityManager1)
        //la class entitymanager permet de creer les champs de ma table ne pas reporter interface a ma variable
    {
      //j'utilise les proprietes de ma class entité nouvelle objet via new pour creer des nouveaux champs
        //la class =structure new =entité symfony instancie
        $category = new Category();

        $category->setTitle("Titre de mon article");
        $category->setColor(" green");
        $category->setDate(new \DateTime());
        $category->setCreated(new \DateTime());
        $category->setPublished(true);

        //j'insere mes données statiques dans ma table article de ma BDD persist et une methode qui va pres sauvegarder une entree dans la table catégorie
        $entityManager1->persist($category);
        //va permettre d'inseer les champs dans la base de données
        $entityManager1->flush();

        // la fonction render permet de recuperer et d'afficher un resultat en html via category_insert_static.html.twig
        return $this->render('category_insert_static.html.twig');
    }



}