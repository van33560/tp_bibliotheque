<?php


namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticleController extends AbstractController
{


    /**
     * @Route("admin/article/articles", name="admin_articlelist")
     */
    //ma methode acticle repository me permet de recuperer via la bdd les données et de les afficher avec return render
    public function ArticleList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();

        return $this->render("article/admin/articles.html.twig",[
            'articles' => $articles
        ]);

    }
    /**
     * @route("admin/article/insert",name="admin_article_insert")
     */

    //je crée une methode pour créer un formulaire avec la methode insertArticle
    public function insertArticle(Request $request, EntityManagerInterface $entityManager)
    {   //j' indique a sf que je crée un nouvelle objet
        $article = new Article();

        //je crée un formulaire grâce à la fonction createFrom et je passe en paramétre le chemin vers le fichierArticleType
        $form = $this->createForm(ArticleType::class, $article);
        //avec la methode handle de la class form je récupère les données en post
        $form->handleRequest($request);


        //je fait une contidion si mon formulaire et envoyer et valide alors je pré-sauvegarde
        //avec la fonction persist et j'insere avec la fonction flush
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash(
                "sucess",
                "l'article a ete ajouté"
            );
            return $this->redirectToRoute('admin_articlelist');
        }
        //je crée grâce à la fonction createview une vue qui pourra  en suite être lu par twig
        $formView = $form-> createView();
        //la fonction render me permet d'envoyer a twig les infos qui seront affichés
        return $this->render('article/admin/insert.html.twig',[
            'formView' => $formView
        ]);
    }
    /**
     * @route("admin/article/update/{id}",name="admin_article_update")
     */
    //je crée une methode updateArticle pour modifier le contenu du formulaire je lui passe en parametre id pour pouvoir
    //  modifier un article grace a son id,la prropriété repository me permettra de modifier les données de la bdd et
    // la propriéte request me permettra de recuperer les modification
    public function updateArticle($id, ArticleRepository $articleRepository,Request $request, EntityManagerInterface $entityManager)
    {
        //je récupére en bdd  l'id wild card qui correspond a celui renseigner dans url
        $article = $articleRepository -> find($id);

        if(is_null($article)){
            return $this->redirectToRoute('admin_articlelist');
        }
        //je crée un formulaire grâce à la fonction createFrom et je passe en paramétre le chemin vers le fichierArticleType
        $form = $this -> createForm(ArticleType::class,$article);

        //avec la methode handle de la class form je récupère les données en post
        $form->handleRequest($request);
        //je fait une contidion si mon formulaire et envoyer et valide alors je pré-sauvegarde
        //avec la fonction persist et j'insere avec la fonction flush
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($article);
            $entityManager->flush();

            //j'ajoute un message de type flash qui s'affichera  la suppression de l'article
            $this->addFlash(
                "sucess",
                "l'article a été modifié"
            );

        }
        //je crée grâce à la fonction createview une vue qui pourra  en suite être lu par twig
        $formView = $form-> createView();
        //la fonction render me permet d'envoyer a twig les infos qui seront affichés
        return $this->render('admin/update_article.html.twig',[
            'formView' => $formView
        ]);
    }
    /**
     * @route("admin/article/delete/{id}",name="admin_article_delete")
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
        return $this->redirectToRoute('admin_articlelist');

    }


}




