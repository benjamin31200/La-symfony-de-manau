<?php

namespace App\Controller;

use App\Entity\Product;


use App\Service\ComparatorManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/comparator", name="comparator_")
 */
class ComparatorController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET", "POST"})
     * @param SessionInterface $session
     * @param ComparatorManager $comparatorManager
     * @return Response A response instance
     */
    public function index(
        SessionInterface $session,
        ComparatorManager $comparatorManager
    ): Response {
        /** @var array $comparator */
        $comparator = $session->get("comparator", []);

        $comparatorDatas = $comparatorManager->getDatasFromComparator($comparator);
        return $this->render('comparator/index.html.twig', [
            'comparatorData' => $comparatorDatas['Data'],
        ]);
    }

    /**
     * @Route("/add/{id}", name="add")
     * @ParamConverter("Product", options={"mapping": {"id": "id"}})
     * @param SessionInterface $session
     * @param Product $product
     * @param ComparatorManager $comparatorManager
     * @return Response A response instance
     */
    public function add(
        Product $product,
        SessionInterface $session
    ): Response {
        /** @var array $comparator */
        $comparator = $session->get("comparator", []);
        /** @var int $id */
        $id = $product->getId();
        
        if (is_array($comparator)) {
            if (array_key_exists($id, $comparator)) {
                $comparator[$id] = $id;
            }else{
                $comparator[$id] = $id;
            }
        }

        $session->set("comparator", $comparator);


        return $this->redirectToRoute("comparator_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @ParamConverter("Product", options={"mapping": {"id": "id"}})
     * @param Product $product
     * @return Response A response instance
     */
    public function delete(Product $product, SessionInterface $session): Response
    {
        $comparator = $session->get("comparator", []);
        /** @var int $id */
        $id = $product->getId();
        if (is_array($comparator)) {
            if (array_key_exists($id, $comparator)) {
                unset($comparator[$id]);
            }

            $session->set("comparator", $comparator);
        }
        return $this->redirectToRoute("comparator_index");
    }
}
