<?php

namespace App\Controller;

use App\Entity\ProductState;
use App\Form\ProductStateType;
use App\Repository\ProductStateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product/state")
 */
class ProductStateController extends AbstractController
{
    /**
     * @Route("/", name="product_state_index", methods={"GET"})
     */
    public function index(ProductStateRepository $productStateRepository): Response
    {
        return $this->render('product_state/index.html.twig', [
            'product_states' => $productStateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="product_state_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $productState = new ProductState();
        $form = $this->createForm(ProductStateType::class, $productState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productState);
            $entityManager->flush();

            return $this->redirectToRoute('product_state_index');
        }

        return $this->render('product_state/new.html.twig', [
            'product_state' => $productState,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_state_show", methods={"GET"})
     */
    public function show(ProductState $productState): Response
    {
        return $this->render('product_state/show.html.twig', [
            'product_state' => $productState,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_state_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductState $productState): Response
    {
        $form = $this->createForm(ProductStateType::class, $productState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_state_index');
        }

        return $this->render('product_state/edit.html.twig', [
            'product_state' => $productState,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_state_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ProductState $productState): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productState->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productState);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_state_index');
    }
}
