<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'category_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form?->isSubmitted() && $form?->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            $this->addFlash('success', 'Votre catégorie a bien été créé');

            return $this->redirectToRoute('category_index');
        }

        return $this->render('category/new.html.twig', [
            'category' => $category,
            'form' => $form?->createView(),
        ]);
    }
    #[Route('/{id}/edit', name: 'category_edit')]
    public function edit(Request $request, Category $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
    
        if ($form?->isSubmitted() && $form?->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre catégorie a bien été modifié');
    
            return $this->redirectToRoute('category_index');
        }
    
        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form?->createView(),
        ]);
    }
    
    #[Route('/{id}/delete', name: 'category_delete')]
    public function delete(Request $request, Category $category, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
        $entityManager->remove($category);
        $entityManager->flush();
        $this->addFlash('success', 'Supprimé avec succès');
    }

    return $this->redirectToRoute('category_index');
}


}