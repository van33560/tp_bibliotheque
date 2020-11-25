<?php


namespace App\Controller;
use App\Entity\Article;
use App\Repository\ArticleRepository;
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

    return $this->render("articles.html.twig",[
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

    return $this->render("article.html.twig",[
      'article' => $article
    ]);

    }

        /**
         * @route("/article/insert-static",name="article_insert_static")
         */
        //inserer un article dans la BDD
        public function insertStaticArticle(EntityManagerInterface $entityManager)
        {
            $article = new Article();

            $article->setTitle("Titre de mon article");
            $article->setContent("contenu de mon article");
            $article->setImage("https://www.lapiscine.pro/wp-content/uploads/2017/05/LaPiscine_2017_BDX.jpg");
            $article->setCreationDate(new \DateTime());
            $article->setPublicationDate(new \DateTime());
            $article->setPublished(true);


            $entityManager->persist($article);
            $entityManager->flush();


            return $this->render('insert_static.html.twig');
        }


    }