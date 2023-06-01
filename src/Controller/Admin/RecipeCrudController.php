<?php

namespace App\Controller\Admin;

use App\Entity\Recipe;
use App\Form\StepType;
use App\Form\CategoryType;
use App\Form\IngredientType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recipe::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // On déclare un champ (field) pour la propriété id
            // et on utilise un champ de type IdField, dont c'est le travail.
            IdField::new(propertyName: 'id')
                // Par contre, on ne le veut pas dans les formulaires,
                // car c'est une donnée gérée par Doctrine
                ->hideOnForm(),
            TextField::new(propertyName: 'name'),
            // Pour le champ description, on utilise un TextEditorField,
            // qui permet la mise en forme du texte avec du HTML (à ne pas oublier pour l'affichage ;) )
            TextEditorField::new(propertyName: 'description'),
            
            AssociationField::new(propertyName: 'category'),
            //Je veux afficher un upload qui permet de charger une image 
            ImageField::new('imageName')
            //une methode qui permet d'indiquer le dossier ou mettre nos images
                ->setBasePath('images/recipes')
                //mettre le chemin complet afin de  définir le répertoire où les images sont téléchargées.
                ->setUploadDir('public/images/recipes')
                //la maniere d'on veut encoder nos fichiers images[randomhash-chaine de carractère]
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
                
            CollectionField::new(propertyName: 'steps')
                // Pour la collection, on utilise un formulaire Symfony (créé avec bin/console make:form)
                // car EasyAdmin ne peut déterminer automatiquement les champs dont on a besoin.
                // Je vous recommande de lire la documentation de Symfony sur le sujet : https://symfony.com/doc/current/forms.html
                ->setEntryType(formTypeFqcn: StepType::class)
                // On veut pouvoir supprimer des éléments de la liste,
                ->allowDelete()
                // mais aussi en créer de nouveau.
                ->allowAdd(),
          
                AssociationField::new(propertyName: 'ingredients'),
            
         
        ];
    }
}