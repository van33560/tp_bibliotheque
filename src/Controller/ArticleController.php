<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use http\Message;
use phpDocumentor\Reflection\Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


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

            return $this->render("front/articles.html.twig", [
                'articles' => $articles
            ]);

        }


        // chemin de ma route avec id
        /**
         * @route("/article/show/{id}",name="articleShow")
         */
        // ma methode articlerepository me permet de recuperer les données de ma bdd et de retourner un resultat via la propriete render
        public function articleShow($id, ArticleRepository $articleRepository)
        {
            $article = $articleRepository->find($id);

            return $this->render("front/article.html.twig", [
                'article' => $article
            ]);

        }
    }
