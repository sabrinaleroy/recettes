<?php

namespace App\Controller;

use App\Entity\VoteMySay;
use App\Form\VoteMySayType;
use App\Repository\VoteMySayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vote/my/say")
 */
class VoteMySayController extends AbstractController
{
    /**
     * @Route("/", name="vote_my_say_index", methods={"GET"})
     */
    public function index(VoteMySayRepository $voteMySayRepository): Response
    {
        return $this->render('vote_my_say/index.html.twig', [
            'vote_my_says' => $voteMySayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vote_my_say_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voteMySay = new VoteMySay();
        $form = $this->createForm(VoteMySayType::class, $voteMySay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voteMySay);
            $entityManager->flush();

            return $this->redirectToRoute('vote_my_say_index');
        }

        return $this->render('vote_my_say/new.html.twig', [
            'vote_my_say' => $voteMySay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vote_my_say_show", methods={"GET"})
     */
    public function show(VoteMySay $voteMySay): Response
    {
        return $this->render('vote_my_say/show.html.twig', [
            'vote_my_say' => $voteMySay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vote_my_say_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VoteMySay $voteMySay): Response
    {
        $form = $this->createForm(VoteMySayType::class, $voteMySay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vote_my_say_index');
        }

        return $this->render('vote_my_say/edit.html.twig', [
            'vote_my_say' => $voteMySay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vote_my_say_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VoteMySay $voteMySay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voteMySay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voteMySay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vote_my_say_index');
    }
}
