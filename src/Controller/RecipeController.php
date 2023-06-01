<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/recipe')]
class RecipeController extends AbstractController
{
    #[Route('/', name: 'recipe_index')]
    #[IsGranted('ROLE_USER')]
    public function index(RecipeRepository $recipeRepository, PaginatorInterface $paginator,Request $request): Response
    {
        $recipes = $paginator->paginate(
            $recipeRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            5 /*limit per page*/
        );
    
        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/new', name: 'recipe_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form?->isSubmitted() && $form?->isValid()) {
            $entityManager->persist($recipe);
            $entityManager->flush();
            $this->addFlash('success', 'Votre ingrédient a bien été créé');

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form?->createView(),
        ]);
    }
    #[Route('/{id}/edit', name: 'recipe_edit')]
    public function edit(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
    
        if ($form?->isSubmitted() && $form?->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre ingrédient a bien été modifié');
    
            return $this->redirectToRoute('recipe_index');
        }
    
        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form?->createView(),
        ]);
    }
    
    #[Route('/{id}/delete', name: 'recipe_delete')]
    public function delete(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
        $entityManager->remove($recipe);
        $entityManager->flush();
        $this->addFlash('success', 'Supprimé avec succès');
    }

    return $this->redirectToRoute('recipe_index');
}

    #[Route('/{id}', name: 'recipe_show')]
    public function show(Recipe $recipe): Response
    {
        //methode render est la methode de abstract controller  qui nous permet de generer une vu
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

}