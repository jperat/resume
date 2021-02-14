<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Education;
use App\Entity\Experience;
use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(ContactCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Resume');
    }

    public function configureCrud(): Crud
    {
        return Crud::new()
            ->setDateFormat('dd/MM/yyyy')
            ->setDateTimeFormat('dd/MM/yyyy HH:mm:ss')
            ->setTimeFormat('HH:mm');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Experiences', 'fas fa-building', Experience::class);
        yield MenuItem::linkToCrud('Educations', 'fas fa-graduation-cap', Education::class);
        yield MenuItem::linkToCrud('Skills', 'fas fa-user', Skill::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-envelope', Contact::class);
        yield MenuItem::linktoRoute('Config', 'fas fa-cogs', 'app_admin_config_index');
        yield MenuItem::linktoRoute('Login', 'fas fa-sign-in-alt', 'app_admin_config_login');
        yield MenuItem::linktoRoute('Picture', 'fas fa-camera', 'app_admin_config_picture');
        yield MenuItem::linktoRoute('Theme', 'fas fa-paint-brush', 'app_admin_config_theme');
    }

}
