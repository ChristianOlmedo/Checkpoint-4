<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    /**
     * @Route("/évènements", name="event")
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/event.html.twig', [
            'events' => $eventRepository->findAll(),
            ]
        );
    }
}