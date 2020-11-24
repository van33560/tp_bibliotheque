<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
//je creer avec ma route un chemin avec ma route,j'utilisema methode repository pour recuperer tous le contenu de mes categories
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