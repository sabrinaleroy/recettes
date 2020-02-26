<?php

namespace App\Controller;

use App\Entity\TaxonomyType;
use App\Form\TaxonomyTypeType;
use App\Repository\TaxonomyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy/type")
 */
class TaxonomyTypeController extends AbstractController
{
    /**
     * @Route("/", name="taxonomy_type_index", methods={"GET"})
     */
    public function index(TaxonomyTypeRepository $taxonomyTypeRepository): Response
    {
        return $this->render('taxonomy_type/index.html.twig', [
            'taxonomy_types' => $taxonomyTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="taxonomy_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taxonomyType = new TaxonomyType();
        $form = $this->createForm(TaxonomyTypeType::class, $taxonomyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taxonomyType);
            $entityManager->flush();

            return $this->redirectToRoute('taxonomy_type_index');
        }

        return $this->render('taxonomy_type/new.html.twig', [
            'taxonomy_type' => $taxonomyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="taxonomy_type_show", methods={"GET"})
     */
    public function show(TaxonomyType $taxonomyType): Response
    {
        return $this->render('taxonomy_type/show.html.twig', [
            'taxonomy_type' => $taxonomyType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="taxonomy_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TaxonomyType $taxonomyType): Response
    {
        $form = $this->createForm(TaxonomyTypeType::class, $taxonomyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taxonomy_type_index');
        }

        return $this->render('taxonomy_type/edit.html.twig', [
            'taxonomy_type' => $taxonomyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="taxonomy_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TaxonomyType $taxonomyType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taxonomyType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taxonomyType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('taxonomy_type_index');
    }
}
