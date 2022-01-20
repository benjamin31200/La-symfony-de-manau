<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\SearchList;
use App\Form\SearchListType;
use App\Repository\ProductRepository;
use App\Repository\SearchListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search", name="search_")
 */
class SearchListController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(ProductRepository $productRepository, SearchListRepository $searchListRepository): Response
    {
        $searchList = new SearchList;
        $searchList = $searchListRepository->findAll();
        $products = new Product;
        $products = $productRepository->findAll();
        return $this->render('search_list/index.html.twig', [
            'products' => $products,
            'searchList' => $searchList,
        ]);
    }

    /**
     * @Route("/price", name="price", methods={"GET"})
     */
    public function searchPrice(ProductRepository $productRepository, SearchListRepository $searchListRepository): Response
    {
        $price = 60;
        $searchList = new SearchList;
        $searchList = $searchListRepository->findAll();
        $products = new Product;
        $products = $productRepository->findByPrice($price);
        return $this->render('search_list/search.html.twig', [
            'products' => $products,
            'searchList' => $searchList,
        ]);
    }

    /**
     * @Route("/brand", name="brand", methods={"GET"})
     */
    public function searchBrand(ProductRepository $productRepository, SearchListRepository $searchListRepository): Response
    {
        $brand = 'Makita';
        $searchList = new SearchList;
        $searchList = $searchListRepository->findAll();
        $products = new Product;
        $products = $productRepository->findByBrand($brand);
        return $this->render('search_list/search.html.twig', [
            'products' => $products,
            'searchList' => $searchList,
        ]);
    }

    /**
     * @Route("/alim", name="alim", methods={"GET"})
     */
    public function searchAlim(ProductRepository $productRepository, SearchListRepository $searchListRepository): Response
    {
        $alim = 'Sans fil';
        $searchList = new SearchList;
        $searchList = $searchListRepository->findAll();
        $products = new Product;
        $products = $productRepository->findByAlim($alim);
        return $this->render('search_list/search.html.twig', [
            'products' => $products,
            'searchList' => $searchList,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $searchList = new SearchList();
        $form = $this->createForm(SearchListType::class, $searchList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($searchList);
            $entityManager->flush();

            return $this->redirectToRoute('search_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('search_list/new.html.twig', [
            'search_list' => $searchList,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(SearchList $searchList): Response
    {
        return $this->render('search_list/show.html.twig', [
            'search_list' => $searchList,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SearchList $searchList, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SearchListType::class, $searchList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('search_list_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('search_list/edit.html.twig', [
            'search_list' => $searchList,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, SearchList $searchList, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$searchList->getId(), $request->request->get('_token'))) {
            $entityManager->remove($searchList);
            $entityManager->flush();
        }

        return $this->redirectToRoute('search_list_index', [], Response::HTTP_SEE_OTHER);
    }
}
