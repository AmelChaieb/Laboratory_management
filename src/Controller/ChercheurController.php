<?php

namespace App\Controller;

// src/Controller/ChercheurController.php

namespace App\Controller;

//use App\Entity\Chercheur;
use App\Form\ChercheurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChercheurRepository")
 */
class ChercheurController extends AbstractController
{
    /**
     * @Route("/chercheur", name="chercheur_index", methods={"GET"})
     */
    public function index(): Response
    {
        $chercheurs = $this->getDoctrine()
            ->getRepository(Chercheur::class)
            ->findAll();

        return $this->render('chercheur/create.html.twig', [
            'chercheurs' => $chercheurs,
        ]);
    }

    /**
     * @Route("/chercheur/new", name="chercheur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $chercheur = new Chercheur();
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chercheur);
            $entityManager->flush();

            return $this->redirectToRoute('chercheur_index');
        }

        return $this->render('chercheur/new.html.twig', [
            'chercheur' => $chercheur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/chercheur/{id}", name="chercheur_show", methods={"GET"})
     */
    public function show(Chercheur $chercheur): Response
    {
        return $this->render('chercheur/show.html.twig', [
            'chercheur' => $chercheur,
        ]);
    }

    /**
     * @Route("/chercheur/{id}/edit", name="chercheur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Chercheur $chercheur): Response
    {
        $form = $this->createForm(ChercheurType::class, $chercheur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('chercheur_index');
        }

        return $this->render('chercheur/edit.html.twig', [
            'chercheur' => $chercheur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/chercheur/{id}", name="chercheur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Chercheur $chercheur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $chercheur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($chercheur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('chercheur_index');
    }
}

