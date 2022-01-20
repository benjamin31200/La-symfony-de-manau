<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(
        ProductRepository $productRepository,
        SessionInterface $session,
        CartManager $cartManager
    ): Response {
        /** @var array $cart */
        $cart = $session->get("cart", []);

        $cartDatas = $cartManager->getDatasFromCart($cart);

        $session->set('cartTotal', $cartDatas['total']);
        return $this->render('home/home.html.twig', [
            'dataCart' => $cartDatas['data'],
            'products' => $productRepository->findAll(),
            'total' => $cartDatas['total'],
        ]);
    }
}
