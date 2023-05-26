<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $livre = new Livre();
        $livre->setTitre('A propos d\'amour');
        $livre->setSlug('a-propos-damour');
        $livre->setDescription('Définissant l\'amour comme un acte et non comme un sentiment, bell hooks démonte tous les obstacles que la culture patriarcale oppose à des relations d\'amour.');
        $livre->setImageName('a-propos-d-amour.jpg');
        $livre->setCategorie($this->getReference(CategorieFixtures::ESSAI_PHILOSOPHIQUE));
        $livre->addAuteur($this->getReference(AuteurFixtures::BELL_HOOKS));
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre('Histoire de ma vie');
        $livre->setSlug('histoire-de-ma-vie');
        $livre->setDescription('C\'est une série de souvenirs, de professions de foi et de méditations dans un cadre dont les détails auront quelque poésie et beaucoup de simplicité.');
        $livre->setImageName('histoiredemavie.jpeg');
        $livre->setCategorie($this->getReference(CategorieFixtures::AUTOBIOGRAPHIE));
        $livre->addAuteur($this->getReference(AuteurFixtures::GEORGE_SAND));
        $manager->persist($livre);

        $livre = new Livre();
        $livre->setTitre('Une chambre à soi');
        $livre->setSlug('une-chambre-a-soi');
        $livre->setDescription('Bravant les conventions avec une irritation voilée d`\'ironie, Virginia Woolf rappelle dans ce délicieux pamphlet comment, jusqu\'à une époque toute récente, les femmes étaient savamment placées sous la dépendance spirituelle et économiques des hommes et, nécessairement, réduites au silence.');
        $livre->setImageName('unechambreasoi.jpg');
        $livre->setCategorie($this->getReference(CategorieFixtures::ESSAI_PHILOSOPHIQUE));
        $livre->addAuteur($this->getReference(AuteurFixtures::VIRGINIA_WOOLF));
        $manager->persist($livre);

        $manager->flush();


    }
}
