<?php

namespace App\Controller;

use App\Entity\Moderation;
use App\Form\ModerationType;
use App\Repository\ModerationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/moderation")
 */
class ModerationController extends AbstractController
{
    /**
     * @Route("/", name="moderation_index", methods={"GET"})
     */
    public function index(ModerationRepository $moderationRepository): Response
    {
        return $this->render('moderation/index.html.twig', [
            'moderations' => $moderationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="moderation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $moderation = new Moderation();
        $form = $this->createForm(ModerationType::class, $moderation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($moderation);
            $entityManager->flush();

            return $this->redirectToRoute('moderation_index');
        }

        return $this->render('moderation/new.html.twig', [
            'moderation' => $moderation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moderation_show", methods={"GET"})
     */
    public function show(Moderation $moderation): Response
    {
        return $this->render('moderation/show.html.twig', [
            'moderation' => $moderation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moderation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Moderation $moderation): Response
    {
        $form = $this->createForm(ModerationType::class, $moderation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moderation_index');
        }

        return $this->render('moderation/edit.html.twig', [
            'moderation' => $moderation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moderation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Moderation $moderation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moderation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moderation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('moderation_index');
    }
}
