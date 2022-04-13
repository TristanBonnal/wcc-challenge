<?php

namespace App\Controller;

use App\Entity\Argonaut;
use App\Form\ArgonautType;
use App\Repository\ArgonautRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ArgonautRepository $repo, EntityManagerInterface $doctrine, Request $request): Response
    {
        //Création formulaire
        $argonaut = new Argonaut();
        $form = $this->createForm(ArgonautType::class, $argonaut);
        $form->handleRequest($request);

        //Redirection après validation du form
        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->persist($argonaut);
            $doctrine->flush();

            return $this->redirectToRoute('app_main');
        }

        $argonauts = $repo->findAll();
        return $this->renderForm('main/index.html.twig', [
            'argonauts' => $argonauts,
            'form' => $form
        ]);
    }
}
