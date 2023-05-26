<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/livre', name: 'app_livre')]
    //On injecte la dépendance LivreRepository pour faire des requêtes
    public function index(LivreRepository $livreRepository): Response
    {
        //On récupère tous les livres
        $livres=$livreRepository->findAll();
        //On rend la page en lui passant la liste des livres
        return $this->render('livre/index.html.twig', [
            //On modifie le par défaut pour passer un tableau php avec une colonne livres qui contient le résultat de la requête
            'livres' => $livres,//'livres' est le nom de la variable à utiliser dans le twig
        ]);
    }
}
