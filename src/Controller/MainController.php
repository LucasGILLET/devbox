<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Dossier;
use App\Entity\Ressouce;
use App\Form\RessouceType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;


class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Dossier::class);
        $repository2 = $doctrine->getRepository(Ressouce::class);

        return $this->render('main/index.html.twig', [
            "dossiers" => $repository->findBy([], ['id'=> 'DESC']),
            "ressources" => $repository2->findBy(['pinned' => true], ['id'=> 'DESC'])
        ]);
    }

}
