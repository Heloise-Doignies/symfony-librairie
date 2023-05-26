<?php

namespace App\Form;

use App\Entity\Livre;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', FileType::class, [
                'required'=>false,
                'label'=>"Image du livre",
            ])
            ->add('titre')
            ->add('description', CKEditorType::class)
            // ->add('imageName')
            ->remove('slug')
            ->remove('updatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=> new \DateTimeImmutable(),
            ]) //DateTimeType : toujours prendre le component/for/extension/core/type
            //Les options : une seule zone calendrier + la date du jour
            ->add('categorie', EntityType::class, [
                'class'=> 'App\Entity\Categorie',
            ]) //modification pour protéger le formulaire
            ->add('auteurs', EntityType::class, [
                'class'=> 'App\Entity\Auteur',
                'multiple'=> true, //Pouvoir avoir plusieurs auteurs
                'attr'=> [
                    'class'=> 'select2',
                    'id'=>'select2-auteurs'
                ],

                //Option pour spécifier de l'HTML (dans le rendu, on ajoute la classe select2)
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
