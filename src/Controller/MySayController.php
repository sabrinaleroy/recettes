<?php

namespace App\Controller;

use App\Entity\MySay;
use App\Form\MySayType;
use App\Repository\MySayRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/my/say")
 */
class MySayController extends AbstractController
{
    /**
     * @Route("/", name="my_say_index", methods={"GET"})
     */
    public function index(MySayRepository $mySayRepository): Response
    {
        return $this->render('my_say/index.html.twig', [
            'my_says' => $mySayRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="my_say_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mySay = new MySay();
        $form = $this->createForm(MySayType::class, $mySay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mySay);
            $entityManager->flush();

            return $this->redirectToRoute('my_say_index');
        }

        return $this->render('my_say/new.html.twig', [
            'my_say' => $mySay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_say_show", methods={"GET"})
     */
    public function show(MySay $mySay): Response
    {
        return $this->render('my_say/show.html.twig', [
            'my_say' => $mySay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="my_say_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MySay $mySay): Response
    {
        $form = $this->createForm(MySayType::class, $mySay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('my_say_index');
        }

        return $this->render('my_say/edit.html.twig', [
            'my_say' => $mySay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="my_say_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MySay $mySay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mySay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mySay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('my_say_index');
    }
}
