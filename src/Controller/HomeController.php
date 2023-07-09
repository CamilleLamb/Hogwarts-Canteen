<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * Affiche la page d'accueil
     *
     * @return Response
     */
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
         // La méthode render() renvoie une réponse HTTP avec la vue Twig 'home/index.html.twig' et une variable 'controller_name' définie à 'HomeController'.
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
