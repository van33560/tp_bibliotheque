<?php


namespace App\Controller;


use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
//je creer avec ma route un chemin ,j'utilise ma methode repository et find all pour recuperer tous le contenu de mes categories
//
{

/**
* @Route ("/categorys" ,name="categorylist")
*/
    //categorylist est ne nom de ma methode categoryrepository va me permettre de recuperer le contenu de ma base de données
     public function categoryList(CategoryRepository $categoryRepository)
     {

         //findall est une propriete de symfony et va me permettre de recuperer toutes les données
         $categorys = $categoryRepository->findAll();
         return $this->render('categorys.html.twig', [
             "categorys" => $categorys


         ]);
     }

    // chemin de ma route qui renvoi au contenu d'une de mes categories via son id
    /**
     * @route("/category/show/{id}",name="categoryShow")
     */
    // ma methode articlerepository me permet de recuperer les données de ma bdd et de retourner un resultat via la propriete render
    public function categoryShow($id, ArticleRepository $articleRepository)
{
    $category = $articleRepository->find($id);

    return $this->render("front/category.html.twig", [
        'category' => $category
    ]);



}



}