<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    // La route va permettre à Symfony de faire le lien entre un chemin (/admin)
    // et l'action à utiliser (méthode d'un contrôleur, possédant une route).
    #[Route(path: '/admin', name: 'admin_dashboard_index')]
    // L'action reçoit une requête HTTP et renvoie une réponse HTTP.
    // Ici, on n'a que faire de la requête, on va se contenter de renvoyer une réponse.
    public function index(): Response
    {
        // On affiche seulement une page (presque vide).
        return $this->render('admin/dashboard.html.twig');
    }

    // On configure notre dashboard
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->renderContentMaximized()
            ->setTitle('Projet Recettes')
        ;
    }

    // On modifie la configuration par défaut des CRUDs liés à ce dashboard.
    public function configureCrud(): Crud
    {
        return parent::configureCrud()
            ->renderContentMaximized()
            ->showEntityActionsInlined()
            ->setDefaultSort([
                'id' => 'DESC',
            ])
        ;
    }

    // Configuration du menu
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Recettes', 'fa fa-list-check', Recipe::class);

        yield MenuItem::section('Données');

        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
       
        
        yield MenuItem::linkToCrud('Ingrédients', 'fa fa-carrot', Ingredient::class);
        
        yield MenuItem::linkToCrud('Categories', 'fa fa-list', Category::class);
       
        yield MenuItem::section('Sous-données');

        
    }
}