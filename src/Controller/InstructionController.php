<?php

namespace App\Controller;

use App\Entity\Instruction;
use App\Form\InstructionType;
use App\Repository\InstructionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/instruction")
 */
class InstructionController extends AbstractController
{
    /**
     * @Route("/", name="instruction_index", methods={"GET"})
     */
    public function index(InstructionRepository $instructionRepository): Response
    {
        return $this->render('instruction/index.html.twig', [
            'instructions' => $instructionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="instruction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $instruction = new Instruction();
        $form = $this->createForm(InstructionType::class, $instruction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instruction);
            $entityManager->flush();

            return $this->redirectToRoute('instruction_index');
        }

        return $this->render('instruction/new.html.twig', [
            'instruction' => $instruction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruction_show", methods={"GET"})
     */
    public function show(Instruction $instruction): Response
    {
        return $this->render('instruction/show.html.twig', [
            'instruction' => $instruction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="instruction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Instruction $instruction): Response
    {
        $form = $this->createForm(InstructionType::class, $instruction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('instruction_index');
        }

        return $this->render('instruction/edit.html.twig', [
            'instruction' => $instruction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="instruction_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Instruction $instruction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instruction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($instruction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('instruction_index');
    }
}
