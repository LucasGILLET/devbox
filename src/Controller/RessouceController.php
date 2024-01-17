<?php

namespace App\Controller;

use App\Entity\Ressouce;
use App\Form\RessouceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

class RessouceController extends AbstractController
{
    #[Route('/ressouce/add', name: 'app_ressource_add')]
    public function addRessource(ManagerRegistry $doctrine, Request $request): Response
    {

        $ressource = new Ressouce();
        $form = $this->createForm(RessouceType::class, $ressource);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($ressource);
            $em->flush();
            return $this->redirectToRoute('app_main_index');
        }

        return $this->render('ressouce/add.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/ressouce/{id}', name: 'app_ressource_show')]
    public function ressourceShow(int $id, ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Ressouce::class);

        return $this->render('ressouce/index.html.twig', [
            "ressource" => $repository->find($id),
        ]);
    }

    #[Route('/ressouce/{id}/editer', name: 'app_ressource_edit')]
    public function edit(int $id, ManagerRegistry $doctrine, Request $request): Response
    {
        $repository = $doctrine->getRepository(Ressouce::class);
        $ressource = $repository->find($id);
        $form = $this->createForm(RessouceType::class, $ressource);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_main_index');
        }

        return $this->render('ressouce/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/ressouce/{id}/supprimer', name: 'app_ressource_delete')]
    public function delete(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $repository = $doctrine->getRepository(Ressouce::class);

        $ressouce = $repository->find($id);

        $em->remove($ressouce);
        $em->flush();

        return $this->redirectToRoute('app_main_index');
    }
}
