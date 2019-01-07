<?php

namespace App\Controller;

use App\Form\PhoneBookSearchType;
use App\Repository\UsersPhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/", name="index_page")
     *
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(PhoneBookSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('result_page', $data);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/result/{query}", name="result_page")
     *
     * @param Request $request
     * @param $query
     * @param UsersPhoneRepository $repository
     *
     * @return Response
     */
    public function search(Request $request, $query, UsersPhoneRepository $repository)
    {
        $result = $repository->findAllByQuery($query);

        $form = $this->createForm(PhoneBookSearchType::class, ['query' => $query]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            return $this->redirectToRoute('result_page', $data);
        }

        return $this->render('search/result.html.twig', [
            'form' => $form->createView(),
            'query' => $query,
            'result' => $result
        ]);
    }
}