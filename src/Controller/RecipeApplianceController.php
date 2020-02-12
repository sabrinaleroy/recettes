<?php

namespace App\Controller;

use App\Entity\RecipeAppliance;
use App\Form\RecipeApplianceType;
use App\Repository\RecipeApplianceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe/appliance")
 */
class RecipeApplianceController extends AbstractController
{
    /**
     * @Route("/", name="recipe_appliance_index", methods={"GET"})
     */
    public function index(RecipeApplianceRepository $recipeApplianceRepository): Response
    {
        return $this->render('recipe_appliance/index.html.twig', [
            'recipe_appliances' => $recipeApplianceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="recipe_appliance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipeAppliance = new RecipeAppliance();
        $form = $this->createForm(RecipeApplianceType::class, $recipeAppliance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipeAppliance);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_appliance_index');
        }

        return $this->render('recipe_appliance/new.html.twig', [
            'recipe_appliance' => $recipeAppliance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_appliance_show", methods={"GET"})
     */
    public function show(RecipeAppliance $recipeAppliance): Response
    {
        return $this->render('recipe_appliance/show.html.twig', [
            'recipe_appliance' => $recipeAppliance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipe_appliance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RecipeAppliance $recipeAppliance): Response
    {
        $form = $this->createForm(RecipeApplianceType::class, $recipeAppliance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_appliance_index');
        }

        return $this->render('recipe_appliance/edit.html.twig', [
            'recipe_appliance' => $recipeAppliance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_appliance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RecipeAppliance $recipeAppliance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipeAppliance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipeAppliance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_appliance_index');
    }
}
