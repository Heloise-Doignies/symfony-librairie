<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public const GEORGE_SAND = 'george-sand';
    public const JUDITH_DUPORTAIL = 'judith-duportail';
    public const BELL_HOOKS = 'bell-hooks';
    public const VIRGINIA_WOOLF = 'virginia-woolf';
    public function load(ObjectManager $manager): void
    {
        $auteur = new Auteur();
        $auteur->setNom('Sand');
        $auteur->setPrenom('George');
        $auteur->setSlug('sand-george');
        $auteur->setImageName('georgesand.jpg');
        $auteur->setBiographie('George Sand, nom de plume d\'Amantine Aurore Lucile Dupin de Francueil, par mariage baronne Dudevant, est une romancière, dramaturge, épistolière, critique littéraire et journaliste française, née à Paris le 1ᵉʳ juillet 1804 et morte au château de Nohant-Vic le 8 juin 1876.');
        //On associe l'instance de l'autre à une référence pour pouvoir récupérer l'auteur dans une autre fixture
        $manager->persist($auteur);
        $this->addReference(self::GEORGE_SAND, $auteur);

        $auteur = new Auteur();
        $auteur->setNom('Duportail');
        $auteur->setPrenom('Judith');
        $auteur->setSlug('duportail-judith');
        $auteur->setImageName('judithduportail.jpg');
        $auteur->setBiographie('Judith Duportail est une journaliste indépendante. Elle écrit sur l`\'amour, la liberté et comment la technologie affecte les deux précédentes.');
        $manager->persist($auteur);
        $this->addReference(self::JUDITH_DUPORTAIL, $auteur);
        
        $auteur = new Auteur();
        $auteur->setPseudo('bell hooks');
        $auteur->setSlug('bell-hooks');
        $auteur->setImageName('bell-hooks.jpg');
        $auteur->setBiographie('Gloria Jean Watkins, connue sous son nom de plume bell hooks, née le 25 septembre 1952 à Hopkinsville et morte le 15 décembre 2021 à Berea, est une intellectuelle, universitaire et militante américaine, théoricienne du black feminism.');
        $manager->persist($auteur);
        $this->addReference(self::BELL_HOOKS, $auteur);

        $auteur = new Auteur();
        $auteur->setNom('Woolf');
        $auteur->setPrenom('Virgnia');
        $auteur->setSlug('virginia-woolf');
        $auteur->setImageName('virginia-woolf.jpg');
        $auteur->setBiographie('Virginia Woolf, née Adeline Virginia Alexandra Stephen le 25 janvier 1882 à Londres et morte le 28 mars 1941 à Rodmell, est une autrice et femme de lettres britannique. Elle est l\'un des principaux écrivains modernistes du XXᵉ siècle.');
        $manager->persist($auteur);
        $this->addReference(self::VIRGINIA_WOOLF, $auteur);

        $manager->flush();
    }
}
