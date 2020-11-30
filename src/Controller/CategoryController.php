<?php


namespace App\Controller;


use App\Entity\Category;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
//je creer avec ma route un chemin ,j'utilise ma methode repository et find all pour recuperer tous le contenu de mes categories
//
{
    /**
     * @Route("/categorys", name="categorylist")
     */
    //ma methode acticle repository me permet de recuperer via la bdd les données et de les afficher avec return render
    public function CategoryList(CategoryRepository $categoryRepository)
    {
        $categorys = $categoryRepository->findAll();

        return $this->render("front/categorys.html.twig", [
            'categorys' => $categorys
        ]);

    }


    // chemin de ma route qui renvoi au contenu d'une de mes categories via son id
    /**
     * @route("/category/show/{id}",name="categoryShow")
     */
    // ma methode articlerepository me permet de recuperer les données de ma bdd et de retourner un resultat via la propriete render
    public function categoryShow($id, CategoryRepository $categoryRepository)
{
    $category = $categoryRepository->find($id);

    return $this->render("front/category.html.twig", [
        'category' => $category
    ]);



}



}