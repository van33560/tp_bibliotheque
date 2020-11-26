<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleType;
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
    //je crée une route un chemin de l'url et je lui donne un nom
/**
* @route("/article/insert-static",name="article_insert_static")
*/
    //inserer un article dans la BDD grace a la propriété entitymanager qui me permet de faire des requétes insert,into,delete
    public function insertStaticArticle(EntityManagerInterface $entityManager)
{
    //j'utilise les proprietes de ma class entité nouvelle objet pour créer des nouveaux champs dans ma table
    //la class = structure, new = entité, que symfony instancie à ma place
    $article = new Article();

    $article->setTitle("Titre de mon article");
    $article->setContent("contenu de mon article");
    $article->setImage("https://www.lapiscine.pro/wp-content/uploads/2017/05/LaPiscine_2017_BDX.jpg");
    $article->setCreationDate(new \DateTime());
    $article->setPublicationDate(new \DateTime());
    $article->setPublished(true);

    //j'insère mes données statiques dans ma table article de ma BDD,
    // persist et une methode qui va pré-sauvegarder les entrées de ma table article
    $entityManager->persist($article);
    $entityManager->flush();


    return $this->render('insert_static.html.twig');
}

   //je crée une route un chemin de l'url avec un id et je lui donne un nom
/**
 * @route("/article/update-static/{id}",name="article_modify_static")
 */
   //je crée une methode updatestaticarticle qui aura pour parametres $id,articlerepository(qui me permettra de recuperer
   //les données de la base de données sf effectuera la requete) et entitymanagerinterface (qui me permettra de faire des requetes ici update pour modifier)
   // ces classes seront intanciés par symfony à ma place(static = pour les données en dure das le code)
    public function UpdateStaticArticle($id,ArticleRepository $articleRepository,EntityManagerInterface $entityManager)
{
    //la fonction find me permettra d'aller récuperer l'id de mon article
    $article = $articleRepository->find($id);
    //le setter setTile va me permettre de modifier le contenu de mon titre
    $article-> setTitle(' nouveau titre');
    //la fonction persist permet de pré-sauvegarder la modification
    $entityManager->persist($article);
    // la fonction flush permet d'inserer la pré-sauvegarde
    $entityManager->flush();
    // la fonction render permet de retrouner un visuel via le fichier modify_static.html.twig
    return $this->render('modify_static.html.twig');
}
/**
 * @route("/article/delete/{id}",name="article_delete")
 */
    //je crée une methode deletearticle qui aura pour paramétres $id(me permettra de recuperer l'article),articlerepository(qui me permettra de récuperer
    //les données de la base de données, sf effectuera la requete delete) et entityManagerinterface,
    // (qui me permettra de faire des réquetes ici delete)
    // ces classes seront intanciés grace a entity manager à ma place
    public function deleteArticle($id,ArticleRepository $articleRepository,EntityManagerInterface $entityManager)
{
    //je récupére en bdd  l'id wild card qui correspond a celui renseigner dans url
    $article = $articleRepository->find($id);
    //je fait une condition qui va permettra de verifier si il y a un article et un fois l'article et l'id supprimés de ne pas afficher de message d'erreur
    if(!is_null($article)){
    //entitymanager avec le fonction remove effacera l'article dont l'id est renseigné dans url
        $entityManager->remove($article);
    //la fonction flush insere les nouvelles modifs
        $entityManager->flush();
    //j'ajoute un message de type flash qui s'affichera a la suppression de l'article
        $this->addFlash(
          "success",
          "l'article a été supprimé"
        );

    }
    // la fonction redirecttoroute permet de retrouner un visuel via le name de mon fichier 'articlelist'
    return $this->redirectToRoute('articlelist');

}
/**
 * @route("/article/insert",name="article_insert")
*/

    //je crée une methode pour créer un formulaire avec la methode insertArticle
    public function insertArticle()
    {
        //je crée un formulaire grâce à la fonction createFrom et je passe en paramétre le chemin vers le fichierArticleType
        $form = $this->createForm(ArticleType::class);
        //je crée grâce à la fonction createview une vue qui pourra  en suite être lu par twig
        $formView = $form-> createView();
       //la fonction render me permet d'envoyer a twig les infos qui seront afficher
        return $this->render('insert.html.twig',[
            'formView' => $formView
        ]);
  }
 }


