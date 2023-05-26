<?php

namespace App\Form;

use App\Entity\Auteur;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', FileType::class, [
                'required'=>false,
                'label'=>"Photo de l'auteur",
            ])
            ->add('nom')
            ->add('prenom')
            ->add('pseudo')
            ->add('biographie', CKEditorType::class)
            // ->add('imageName')
            ->remove('slug')
            ->remove('updatedAt', DateTimeType::class, [
                'widget'=>'single_text',
                'data'=> new \DateTimeImmutable(),
            ]) //DateTimeType : toujours prendre le component/for/extension/core/type
            //Les options : une seule zone calendrier + la date du jour
            ->add('livres')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
