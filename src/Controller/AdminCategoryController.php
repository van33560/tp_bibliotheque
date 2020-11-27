<?php


namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class AdminCategoryController extends AbstractController
{

    /**
     * @Route("admin/category/categorys", name="admin_categorylist")
     */
    //ma methode acticle repository me permet de recuperer via la bdd les données et de les afficher avec return render
    public function CategoryList(CategoryRepository $categoryRepository)
    {
        $categorys = $categoryRepository->findAll();

        return $this->render("article/admin/categorys.html.twig",[
            'categorys' => $categorys
        ]);

    }
    /**
     * @route("admin/category/insert",name="admin_category_insert")
     */

    //je crée une methode pour créer un formulaire avec la methode insertArticle
    public function insertCategory(Request $request, EntityManagerInterface $entityManager)
    {   //j' indique a sf que je crée un nouvelle objet
        $category = new Category();

        //je crée un formulaire grâce à la fonction createFrom et je passe en paramétre le chemin vers le fichierArticleType
        $form = $this->createForm(ArticleType::class, $category);
        //avec la methode handle de la class form je récupère les données en post
        $form->handleRequest($request);


        //je fait une contidion si mon formulaire et envoyer et valide alors je pré-sauvegarde
        //avec la fonction persist et j'insere avec la fonction flush
        if($form->isSubmitted() && $form->isValid()){

            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                "sucess",
                "l'article a ete ajouté"
            );
            return $this->redirectToRoute('admin_categorylist');
        }
        //je crée grâce à la fonction createview une vue qui pourra  en suite être lu par twig
        $formView = $form-> createView();
        //la fonction render me permet d'envoyer a twig les infos qui seront affichés
        return $this->render('article/admin/insert.html.twig',[
            'formView' => $formView
        ]);
    }
    /**
     * @route("admin/category/update/{id}",name="admin_category_update")
     */
    //je crée une methode updateArticle pour modifier le contenu du formulaire je lui passe en parametre id pour pouvoir
    //  modifier un article grace a son id,la prropriété repository me permettra de modifier les données de la bdd et
    // la propriéte request me permettra de recuperer les modification
    public function updateCategory($id, CategoryRepository $categoryRepository,Request $request, EntityManagerInterface $entityManager)
    {
        //je récupére en bdd  l'id wild card qui correspond a celui renseigner dans url
        $category = $categoryRepository -> find($id);

        if(is_null($category)){
            return $this->redirectToRoute('admin_categorylist');
        }
        //je crée un formulaire grâce à la fonction createFrom et je passe en paramétre le chemin vers le fichierArticleType
        $form = $this -> createForm(ArticleType::class,$category);

        //avec la methode handle de la class form je récupère les données en post
        $form->handleRequest($request);
        //je fait une contidion si mon formulaire et envoyer et valide alors je pré-sauvegarde
        //avec la fonction persist et j'insere avec la fonction flush
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
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
        return $this->render('admin/update_category.html.twig',[
            'formView' => $formView
        ]);
    }
    /**
     * @route("admin/category/delete/{id}",name="admin_category_delete")
     */
    //je crée une methode deletearticle qui aura pour paramétres $id(me permettra de recuperer l'article),articlerepository(qui me permettra de récuperer
    //les données de la base de données, sf effectuera la requete delete) et entityManagerinterface,
    // (qui me permettra de faire des réquetes ici delete)
    // ces classes seront intanciés grace a entity manager à ma place
    public function deleteCategory($id,CategoryRepository $categoryRepository,EntityManagerInterface $entityManager)
    {
        //je récupére en bdd  l'id wild card qui correspond a celui renseigner dans url
        $category = $categoryRepository->find($id);
        //je fait une condition qui va permettra de verifier si il y a un article et un fois l'article et l'id supprimés de ne pas afficher de message d'erreur
        if(!is_null($category)){
            //entitymanager avec le fonction remove effacera l'article dont l'id est renseigné dans url
            $entityManager->remove($category);
            //la fonction flush insere les nouvelles modifs
            $entityManager->flush();
            //j'ajoute un message de type flash qui s'affichera a la suppression de l'article
            $this->addFlash(
                "success",
                "l'article a été supprimé"
            );

        }
        // la fonction redirecttoroute permet de retrouner un visuel via le name de mon fichier 'articlelist'
        return $this->redirectToRoute('admin_categorylist');

    }
}