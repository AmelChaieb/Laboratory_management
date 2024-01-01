<?php

// src/Controller/ProjetController.php

namespace App\Controller;

//use App\Entity\Projet;
use App\Form\ProjetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    /**
     * @Route("/projet/list", name="projet_list")
     */
    public function list(): Response
    {
        $projets = $this->getDoctrine()->getRepository(Projet::class)->findAll();

        return $this->render('projet/list.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/projet/create", name="projet_create")
     */
    public function create(Request $request): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($projet);
            $entityManager->flush();

            return $this->redirectToRoute('projet_list');
        }

        return $this->render('projet/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/projet/edit/{id}", name="projet_edit")
     */
    public function edit(Request $request, Projet $projet): Response
    {
        $form = $this->createForm(ProjetType::class, $projet);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projet_list');
        }

        return $this->render('projet/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/projet/delete/{id}", name="projet_delete")
     */
    public function delete(Request $request, Projet $projet): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($projet);
        $entityManager->flush();

        return $this->redirectToRoute('projet_list');
    }
}

