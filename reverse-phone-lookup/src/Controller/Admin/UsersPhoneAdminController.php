<?php

namespace App\Controller\Admin;

use App\Entity\UsersPhone;
use App\Form\UsersPhoneType;
use App\Repository\UsersPhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("admin/users_phone")
 */
class UsersPhoneAdminController extends AbstractController
{
    /**
     * @Route("/", name="users_phone_index", methods={"GET"})
     */
    public function index(UsersPhoneRepository $usersPhoneRepository): Response
    {
        return $this->render('admin/users_phone/index.html.twig', ['users_phone' => $usersPhoneRepository->findAll()]);
    }

    /**
     * @Route("/new", name="users_phone_new", methods={"GET","POST"})
     */
    public function new(Request $request, TranslatorInterface $translator): Response
    {
        $usersPhone = new UsersPhone();
        $form = $this->createForm(UsersPhoneType::class, $usersPhone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($usersPhone);
            $entityManager->flush();

            $this->addFlash('notice', $translator->trans("L'entrée a été créée avec succès"));

            return $this->redirectToRoute('users_phone_index');
        }

        return $this->render('admin/users_phone/new.html.twig', [
            'users_phone' => $usersPhone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_phone_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UsersPhone $usersPhone, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(UsersPhoneType::class, $usersPhone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('notice', $translator->trans("L'entrée a été modifiée avec succès"));

            return $this->redirectToRoute('users_phone_index', ['id' => $usersPhone->getId()]);
        }

        return $this->render('admin/users_phone/edit.html.twig', [
            'users_phone' => $usersPhone,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_phone_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UsersPhone $usersPhone, TranslatorInterface $translator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usersPhone->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usersPhone);
            $entityManager->flush();

            $this->addFlash('notice', $translator->trans("L'entrée a été supprimée avec succès"));
        }

        return $this->redirectToRoute('users_phone_index');
    }
}
