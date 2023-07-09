<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    { // Récupère tous les utilisateurs depuis la base de données et les envoie à la vue
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde l'utilisateur dans la base de données
            $userRepository->save($user, true);

            // Redirige vers la page d'index des utilisateurs
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        // Affiche le formulaire pour ajouter un nouvel utilisateur
        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        // Affiche la fiche de l'utilisateur sélectionné
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde les modifications de l'utilisateur dans la base de données
            $userRepository->save($user, true);

            // Redirige vers la page d'index des utilisateurs
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        // Affiche le formulaire pour modifier les informations de l'utilisateur sélectionné
        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        // Vérifie si le jeton CSRF est valide
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            // Supprime l'utilisateur de la base de données
            $userRepository->remove($user, true);
        }
        // Redirige vers la page d'index des utilisateurs
        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
