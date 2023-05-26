<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/auteur')]
class AdminAuteurController extends AbstractController
{
    #[Route('/', name: 'app_admin_auteur_index', methods: ['GET'])]
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('admin_auteur/index.html.twig', [
            'auteurs' => $auteurRepository->findBy([], ['nom' => 'ASC']),
            //On les met dans l'ordre alphabétique
        ]);
    }

    #[Route('/new', name: 'app_admin_auteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AuteurRepository $auteurRepository, SluggerInterface $slugger): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auteur->setSlug(strtolower($slugger->slug($auteur->getNom().$auteur->getPrenom().$auteur->getPseudo())));
            // Ajout de cette ligne pour générer le slug automatiquement
            $auteur->setNom(ucfirst($auteur->getNom()));
            $auteur->setPrenom(ucfirst($auteur->getPrenom()));
            //Ajout de cette ligne pour générer une majuscule automatiquement au début du nom

            $auteurRepository->save($auteur, true);

            //Mise en place d'un message flash
            $this->addFlash('success', 'L\'auteur '.$auteur->getPrenom().' '.$auteur->getNom().' '.$auteur->getPseudo().' a bien été ajouté.');
            return $this->redirectToRoute('app_admin_auteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_auteur/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_auteur_show', methods: ['GET'])]
    public function show(Auteur $auteur): Response
    {
        return $this->render('admin_auteur/show.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_auteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Auteur $auteur, AuteurRepository $auteurRepository): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auteurRepository->save($auteur, true);

            return $this->redirectToRoute('app_admin_auteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_auteur_delete', methods: ['POST'])]
    public function delete(Request $request, Auteur $auteur, AuteurRepository $auteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteur->getId(), $request->request->get('_token'))) {
            $auteurRepository->remove($auteur, true);
        }

        return $this->redirectToRoute('app_admin_auteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
