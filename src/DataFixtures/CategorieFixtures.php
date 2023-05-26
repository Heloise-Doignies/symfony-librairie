<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{

    public const AUTOBIOGRAPHIE = 'autobiographie';
    public const ESSAI_PHILOSOPHIQUE = 'essai-philosophique';
    public function load(ObjectManager $manager): void
    {
        $categorie = new Categorie();
        $categorie->setNom('Bande dessinée');
        $categorie->setSlug('bande-dessinee');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom('Roman policier');
        $categorie->setSlug('roman-policier');
        $manager->persist($categorie);

        $categorie = new Categorie();
        $categorie->setNom('Essai philosophique');
        $categorie->setSlug('essai-philosophique');
        $manager->persist($categorie);
        //On associe l'instance de l'autre à une référence pour pouvoir récupérer l'auteur dans une autre fixture
        $this->addReference(self::ESSAI_PHILOSOPHIQUE, $categorie);

        $categorie = new Categorie();
        $categorie->setNom('Autobiographie');
        $categorie->setSlug('autobiographie');
        $manager->persist($categorie);
        //On associe l'instance de l'autre à une référence pour pouvoir récupérer l'auteur dans une autre fixture
        $this->addReference(self::AUTOBIOGRAPHIE, $categorie);

        $manager->flush();
    }
}
