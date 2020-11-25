<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
//je creer avec ma route un chemin ,j'utilise ma methode repository et find all pour recuperer tous le contenu de mes categories
//
{

    /**
    * @Route ("/category" ,name="category")
    */
    public function categoryList(CategoryRepository $categoryRepository){


    $category= $categoryRepository->findAll();
    return $this->render('category.html.twig',[
        "category"=> $category
    ]);
    }
}