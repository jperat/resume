<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Experience::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Experience')
            ->setEntityLabelInPlural('Experience')
            ->setPageTitle(Crud::PAGE_INDEX, 'Expériences')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter %entity_label_singular%')
            ->setSearchFields(['id', 'company', 'title', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $company = TextField::new('company');
        $description = TextareaField::new('description');
        $start = DateField::new('start');
        $end = DateField::new('end');
        $active = BooleanField::new('active');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$title, $company, $description, $start, $end, $active];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $company, $title, $description, $start, $end, $active];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$title, $company, $description, $start, $end, $active];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$title, $company, $description, $start, $end, $active];
        }
    }
}
