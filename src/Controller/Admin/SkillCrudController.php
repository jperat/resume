<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Skill')
            ->setEntityLabelInPlural('Skill')
            ->setPageTitle(Crud::PAGE_INDEX, 'Skills')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter %entity_label_singular%')
            ->setSearchFields(['id', 'title', 'rate', 'position']);
    }

    public function configureFields(string $pageName): iterable
    {
        $title = TextField::new('title');
        $rate = IntegerField::new('rate');
        $active = Field::new('active');
        $id = IntegerField::new('id', 'ID');
        $position = IntegerField::new('position');

        if (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $title, $rate, $position, $active];
        }
        return [$title, $rate, $active];
    }
}
