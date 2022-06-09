<?php

namespace App\Controller\Admin;

use App\Entity\Education;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EducationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Education::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Education')
            ->setEntityLabelInPlural('Education')
            ->setPageTitle(Crud::PAGE_INDEX, 'Educations')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter %entity_label_singular%')
            ->setSearchFields(['id', 'school', 'title', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $school = TextField::new('school');
        $description = TextareaField::new('description');
        $start = DateField::new('start');
        $end = DateField::new('end');
        $active = Field::new('active');
        $id = IntegerField::new('id', 'ID');

        if (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $school, $title, $description, $start, $end, $active];
        }
        return [$title, $school, $description, $start, $end, $active];
    }
}
