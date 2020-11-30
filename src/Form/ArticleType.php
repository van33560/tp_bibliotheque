<?php

namespace App\Form;

use App\Entity\Article;

use App\Entity\Category;
use phpDocumentor\Reflection\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('image')
            //dataType permet de generer un format pre-defini de dates
            ->add('publicationDate', DateType::class,[
                'widget'=>'single_text'])
            ->add('creationDate',DateType::class,[
                'widget'=>'single_text'])
            ->add('isPublished')
            //dans mon gabarit de formulaire de gréer l'input categorie qui est relié a ma propriete category
            //dans l'entité article et je lui donne un type entité
            ->add('Category',EntityType::class,[
              //ici je precice quelle entite sera afficher dans l'input (title)que l'utilisateur pourra choisir
              'class'=> Category::class,
              'choice_label'=>'title'
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
