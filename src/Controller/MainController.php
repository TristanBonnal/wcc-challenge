<?php

namespace App\Controller;

use App\Repository\ArgonautRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(ArgonautRepository $repo): Response
    {
        $argonauts = $repo->findAll();
        return $this->render('main/index.html.twig', [
            'argonauts' => $argonauts
        ]);
    }
}
