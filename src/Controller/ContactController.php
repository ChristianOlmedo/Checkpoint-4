<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var string */
            $mailerFrom = $this->getParameter('mailer_from');
            $email = (new Email())
            ->from($mailerFrom)
            ->to('your_email@example.com')
            ->subject('Vous avez un nouveau message de la part d\'un utilisateur de Into the Wild.')
            ->html($this->renderView('contact/newContactEmail.html.twig', ['contact' => $contact]));
            $mailer->send($email);

            $this->addFlash('success', 'Merci pour votre message !');
            return $this->redirectToRoute('home');
        }
    
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}