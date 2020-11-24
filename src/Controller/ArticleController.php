<?php


namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class ArticleController extends AbstractController
    //la route articles me permet d'afficher le chemin dans l'url
    {
    /**
    * @Route("/articles", name="articlelist")
    */
    //ma methode acticle repository me permet de recuperer via la bdd les données et de les afficher avec return render
    public function ArticleList(ArticleRepository $articleRepository)
    {
    $articles = $articleRepository->findAll();

    return $this->render("articles.html.twig",[
    'articles' => $articles
    ]);

    }
    // chemin de ma route avec id
    /**
    * @route("/article/{id}",name="articleShow")
    */
    // ma methode articlerepository me permet de recuperer les données de ma bdd et de retourner un resultat via la propriete render
    public function articleShow($id, ArticleRepository $articleRepository)
    {
    $article = $articleRepository->find($id);

    return $this->render("article.html.twig",[
      'article' => $article
    ]);

    }

    }