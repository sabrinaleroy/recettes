<?php

namespace App\Controller;

use App\Entity\ComNote;
use App\Form\ComNoteType;
use App\Repository\ComNoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/com/note")
 */
class ComNoteController extends AbstractController
{
    /**
     * @Route("/", name="com_note_index", methods={"GET"})
     */
    public function index(ComNoteRepository $comNoteRepository): Response
    {
        return $this->render('com_note/index.html.twig', [
            'com_notes' => $comNoteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="com_note_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comNote = new ComNote();
        $form = $this->createForm(ComNoteType::class, $comNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comNote);
            $entityManager->flush();

            return $this->redirectToRoute('com_note_index');
        }

        return $this->render('com_note/new.html.twig', [
            'com_note' => $comNote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="com_note_show", methods={"GET"})
     */
    public function show(ComNote $comNote): Response
    {
        return $this->render('com_note/show.html.twig', [
            'com_note' => $comNote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="com_note_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ComNote $comNote): Response
    {
        $form = $this->createForm(ComNoteType::class, $comNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('com_note_index');
        }

        return $this->render('com_note/edit.html.twig', [
            'com_note' => $comNote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="com_note_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ComNote $comNote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comNote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comNote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('com_note_index');
    }
}
