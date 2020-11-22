<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Contact')
            ->setEntityLabelInPlural('Contact')
            ->setPageTitle(Crud::PAGE_INDEX, 'Contacts')
            ->setPageTitle(Crud::PAGE_DETAIL, 'Contact')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter %entity_label_singular%')
            ->setSearchFields(['name', 'email', 'phone']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable('new', 'edit');
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $phone = TelephoneField::new('phone');
        $email = EmailField::new('email');
        $message = TextareaField::new('message');
        $date = DateTimeField::new('date');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $phone, $email, $date];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $phone, $email, $date, $message];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $phone, $email, $message, $date];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $phone, $email, $message, $date];
        }
    }
}
