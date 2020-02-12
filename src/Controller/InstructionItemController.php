<?php

namespace App\Controller;

use App\Entity\InstructionItem;
use App\Form\InstructionItemType;
use App\Repository\InstructionItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/instruction/item")
 */
class InstructionItemController extends AbstractController
{
    /**
     * @Route("/", name="instruction_item_index", methods={"GET"})
     */
    public function index(InstructionItemRepository $instructionItemRepository): Response
    {
        return $this->render('instruction_item/index.html.twig', [
            'instruction_items' => $instructionItemRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="instruction_item_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $instructionItem = new InstructionItem();
        $form = $this->createForm(InstructionItemType::class, $instructionItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instructionItem);
            $entityManager->flush();

            return $this->redirectToRoute('instruction_item_index');
        }

        return $this->render('instruction_item/new.html.twig', [
            'instruction_item' => $instructionItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruction_item_show", methods={"GET"})
     */
    public function show(InstructionItem $instructionItem): Response
    {
        return $this->render('instruction_item/show.html.twig', [
            'instruction_item' => $instructionItem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="instruction_item_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InstructionItem $instructionItem): Response
    {
        $form = $this->createForm(InstructionItemType::class, $instructionItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('instruction_item_index');
        }

        return $this->render('instruction_item/edit.html.twig', [
            'instruction_item' => $instructionItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruction_item_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InstructionItem $instructionItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instructionItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($instructionItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instruction_item_index');
    }
}
