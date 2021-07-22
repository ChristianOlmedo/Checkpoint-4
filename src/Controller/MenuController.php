<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="menu")
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('menu/menu.html.twig', [
            'menus' => $menuRepository->findAll(),
            ]
        );
    }
}