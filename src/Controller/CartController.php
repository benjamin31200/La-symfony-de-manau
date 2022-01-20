<?php

namespace App\Controller;

use App\Entity\Product;


use App\Service\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/cart", name="customer_cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET", "POST"})
     * @param SessionInterface $session
     * @param CartManager $cartManager
     * @return Response A response instance
     */
    public function index(
        SessionInterface $session,
        CartManager $cartManager
    ): Response {
        /** @var array $cart */
        $cart = $session->get("cart", []);

        $cartDatas = $cartManager->getDatasFromCart($cart);

        $session->set('cartTotal', $cartDatas['total']);
        return $this->render('cart/index.html.twig', [
            'dataCart' => $cartDatas['data'],
            'total' => $cartDatas['total'],
        ]);
    }

    /**
     * @Route("/add/{id}", name="add", methods={"POST"})
     * @param SessionInterface $session
     * @param Product $product
     * @param CartManager $cartManager
     * @return Response A response instance
     */
    public function add(
        Product $product,
        SessionInterface $session,
        CartManager $cartManager
    ): Response {
        /** @var array $cart */
        $cart = $session->get("cart", []);
        /** @var int $id */
        $id = $product->getId();
        if (is_array($cart)) {
            if (array_key_exists($id, $cart)) {
                $cart[$id]++;
            } else {
                $cart[$id] = 1;
            }
        }

        $cartDatas = $cartManager->getDatasFromCart($cart);

        $session->set('cartTotal', $cartDatas['total']);
        $session->set("cart", $cart);


        return $this->redirectToRoute("index");
    }

    /**
     * @Route("/addMore/{id}", name="addMore")
     * @ParamConverter("product", options={"mapping": {"id": "id"}}) 
     * @param Product $product
     * @return Response A response instance
     */
    public function addMore(Product $product, SessionInterface $session): Response
    {
        $cart = $session->get("cart", []);
        /** @var int $id */
        $id = $product->getId();

        if (is_array($cart)) {
            if (array_key_exists($id, $cart)) {
                $cart[$id]++;
            } else {
                $cart[$id] = 1;
            }
            $session->set("cart", $cart);
        }
        return $this->redirectToRoute("index", []);
    }

    /**
     * @Route("/remove/{id}", name="remove")
     * @ParamConverter("product", options={"mapping": {"id": "id"}})
     * @param Product $product
     * @return Response A response instance
     */
    public function remove(Product $product, SessionInterface $session): Response
    {
        $cart = $session->get("cart", []);
        /** @var int $id */
        $id = $product->getId();
        if (is_array($cart)) {
            if (array_key_exists($id, $cart)) {
                if ($cart[$id] > 1) {
                    $cart[$id]--;
                } else {
                    unset($cart[$id]);
                }
            }
            $session->set("cart", $cart);
        }
        return $this->redirectToRoute("index", []);
    }

    /**
     * @Route("/delete/{id}", name="article_delete")
     * @ParamConverter("product", options={"mapping": {"id": "id"}})
     * @param Product $product
     * @return Response A response instance
     */
    public function delete(Product $product, SessionInterface $session): Response
    {
        $cart = $session->get("cart", []);
        /** @var int $id */
        $id = $product->getId();
        if (is_array($cart)) {
            if (array_key_exists($id, $cart)) {
                unset($cart[$id]);
            }
            $session->set("cart", $cart);
        }
        return $this->redirectToRoute("index");
    }
}
