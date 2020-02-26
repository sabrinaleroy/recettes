<?php

namespace App\Controller;

use App\Entity\Taxonomy;
use App\Form\TaxonomyType;
use App\Repository\TaxonomyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/taxonomy")
 */
class TaxonomyController extends AbstractController
{
    /**
     * @Route("/", name="taxonomy_index", methods={"GET"})
     */
    public function index(TaxonomyRepository $taxonomyRepository): Response
    {
        return $this->render('taxonomy/index.html.twig', [
            'taxonomies' => $taxonomyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="taxonomy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taxonomy = new Taxonomy();
        $form = $this->createForm(TaxonomyType::class, $taxonomy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taxonomy);
            $entityManager->flush();

            return $this->redirectToRoute('taxonomy_index');
        }

        return $this->render('taxonomy/new.html.twig', [
            'taxonomy' => $taxonomy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="taxonomy_show", methods={"GET"})
     */
    public function show(Taxonomy $taxonomy): Response
    {
        return $this->render('taxonomy/show.html.twig', [
            'taxonomy' => $taxonomy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="taxonomy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Taxonomy $taxonomy): Response
    {
        $form = $this->createForm(TaxonomyType::class, $taxonomy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('taxonomy_index');
        }

        return $this->render('taxonomy/edit.html.twig', [
            'taxonomy' => $taxonomy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="taxonomy_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Taxonomy $taxonomy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taxonomy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taxonomy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('taxonomy_index');
    }
}
