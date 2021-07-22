<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/menu")
 */
class AdminMenuController extends AbstractController
{
    /**
     * @Route("/", name="admin_menu_index", methods={"GET"})
     */
    public function index(MenuRepository $menuRepository): Response
    {
        return $this->render('admin_menu/index.html.twig', [
            'menus' => $menuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_menu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->redirectToRoute('admin_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_menu_show", methods={"GET"})
     */
    public function show(Menu $menu): Response
    {
        return $this->render('admin_menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_menu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Menu $menu): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_menu_delete", methods={"POST"})
     */
    public function delete(Request $request, Menu $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
