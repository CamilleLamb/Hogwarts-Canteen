<?php

namespace App\Controller;

use App\Entity\Children;
use App\Form\ChildrenType;
use App\Repository\ChildrenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/children')]
class ChildrenController extends AbstractController
{    
    #[Route('/', name: 'app_children_index', methods: ['GET'])]
    public function index(ChildrenRepository $childrenRepository): Response
    {
        // Récupère tous les enfants depuis la base de données et les envoie à la vue
        return $this->render('children/index.html.twig', [
            'childrens' => $childrenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_children_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ChildrenRepository $childrenRepository): Response
    {
        // Crée une nouvelle instance de l'entité Children
        $child = new Children();
        // Crée un formulaire pour ajouter un nouvel enfant
        $form = $this->createForm(ChildrenType::class, $child);
        // Traite la requête HTTP pour récupérer les données du formulaire
        $form->handleRequest($request);
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde l'enfant dans la base de données
            $childrenRepository->save($child, true);
            // Redirige vers la page d'index des enfants
            return $this->redirectToRoute('app_children_index', [], Response::HTTP_SEE_OTHER);
        }
        // Affiche le formulaire pour ajouter un nouvel enfant
        return $this->render('children/new.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_children_show', methods: ['GET'])]
    public function show(Children $child): Response
    {   // Affiche la fiche de l'enfant sélectionné
        return $this->render('children/show.html.twig', [
            'child' => $child,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_children_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Children $child, ChildrenRepository $childrenRepository): Response
    {   // Crée un formulaire pour modifier les informations de l'enfant sélectionné
        $form = $this->createForm(ChildrenType::class, $child);

        // Traite la requête HTTP pour récupérer les données du formulaire
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde les modifications de l'enfant dans la base de données
            $childrenRepository->save($child, true);
            // Redirige vers la page d'index des enfants
            return $this->redirectToRoute('app_children_index', [], Response::HTTP_SEE_OTHER);
            
        }
        // Affiche le formulaire pour modifier les informations de l'enfant sélectionné
        return $this->render('children/edit.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_children_delete', methods: ['POST'])]
    public function delete(Request $request, Children $child, ChildrenRepository $childrenRepository): Response
    {   // Vérifie si le jeton CSRF est valide
        if ($this->isCsrfTokenValid('delete' . $child->getId(), $request->request->get('_token'))) {
            // Supprime l'enfant de la base de données
            $childrenRepository->remove($child, true);
        }
        // Redirige vers la page d'index des enfants
        return $this->redirectToRoute('app_children_index', [], Response::HTTP_SEE_OTHER);
    }
}
