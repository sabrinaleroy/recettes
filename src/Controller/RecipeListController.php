<?php

namespace App\Controller;

use App\Entity\RecipeList;
use App\Form\RecipeListType;
use App\Repository\RecipeListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe/list")
 */
class RecipeListController extends AbstractController
{
    /**
     * @Route("/", name="recipe_list_index", methods={"GET"})
     */
    public function index(RecipeListRepository $recipeListRepository): Response
    {
        return $this->render('recipe_list/index.html.twig', [
            'recipe_lists' => $recipeListRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="recipe_list_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipeList = new RecipeList();
        $form = $this->createForm(RecipeListType::class, $recipeList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipeList);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_list_index');
        }

        return $this->render('recipe_list/new.html.twig', [
            'recipe_list' => $recipeList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_list_show", methods={"GET"})
     */
    public function show(RecipeList $recipeList): Response
    {
        return $this->render('recipe_list/show.html.twig', [
            'recipe_list' => $recipeList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipe_list_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RecipeList $recipeList): Response
    {
        $form = $this->createForm(RecipeListType::class, $recipeList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_list_index');
        }

        return $this->render('recipe_list/edit.html.twig', [
            'recipe_list' => $recipeList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_list_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RecipeList $recipeList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipeList->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipeList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_list_index');
    }
}
