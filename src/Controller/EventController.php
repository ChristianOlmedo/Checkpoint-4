<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\InscriptionType;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Request;
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
        // $inscription = new Event();
        // $form = $this->createForm(InscriptionType::class, $inscription);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($inscription);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('event/event.html.twig', [], Response::HTTP_SEE_OTHER);
        // }

        // return $this->renderForm('event/event.html.twig', [
        //     'form' => $form,
        //     'events' => $eventRepository->findAll(),
        // ]);
        
        return $this->render('event/event.html.twig', [
            'events' => $eventRepository->findAll(),
            ]
        );
    }

    // /**
    //  * @Route("/{id}", name="event_inscription", methods={"POST"})
    //  */
    // public function inscription(Request $request, Event $event): Response
    // {
    //     if ($this->isCsrfTokenValid('add'.$event->getUsers(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($event);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('event/event.html.twig', [], Response::HTTP_SEE_OTHER);
    // }
}