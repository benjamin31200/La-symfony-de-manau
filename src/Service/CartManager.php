<?php

namespace App\Service;

use App\Entity\Product;

use App\Repository\ProductRepository;

class CartManager
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get cart total and cart products infos
     *
     * @param  array $cart
     * @return array
     */
    public function getDatasFromCart(array $cart): array
    {
        $total = 0;
        $dataCart = [];
        foreach ($cart as $productId => $quantity) {
            /** @var Product $product */
            $product = $this->productRepository->find($productId);
            $dataCart[] = [
                'product' => $product,
                'quantity' => $quantity,

                'totalproduct' => $quantity * $product->getPrice()
            ];
            $total += $product->getPrice() * $quantity;
        }
        return [
            'total' => $total,
            'data' => $dataCart,
        ];
    }
}
