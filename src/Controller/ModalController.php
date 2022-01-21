<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModalController extends AbstractController
{
    /**
     * @Route("/modal", name="modal")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('modal/index.html.twig', [
            'products' => $productRepository->findAll(),
            'controller_name' => 'ModalController',
        ]);
    }
}
