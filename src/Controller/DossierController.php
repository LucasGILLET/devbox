<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Form\DossierType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class DossierController extends AbstractController
{
    #[Route('/dossier/{id}', name: 'app_dossier_show')]
    public function dossierShow(int $id, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Dossier::class);

        return $this->render('dossier/index.html.twig', [
            "dossier" => $repository->find($id),
        ]);
    }

    #[Route('/dossier', name: 'app_dossier_add')]
    public function addDossier(ManagerRegistry $doctrine, Request $request): Response
    {

        $dossier = new Dossier();
        $form = $this->createForm(DossierType::class, $dossier);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($dossier);
            $em->flush();
            return $this->redirectToRoute('app_main_index');
        }

        return $this->render('dossier/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/dossier/{id}/editer', name: 'app_dossier_edit')]
    public function edit(int $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Dossier::class);
        $dossier = $repository->find($id);
        $form = $this->createForm(DossierType::class, $dossier);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_main_index');
        }

        return $this->render('dossier/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/dossier/{id}/supprimer', name: 'app_dossier_delete')]
    public function delete(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Dossier::class);

        $dossier = $repository->find($id);

        $em->remove($dossier);
        $em->flush();

        return $this->redirectToRoute('app_main_index');
    }
}
