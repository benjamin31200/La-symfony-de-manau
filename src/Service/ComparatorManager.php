<?php

namespace App\Service;

use App\Entity\Product;

use App\Repository\ProductRepository;

class ComparatorManager
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Get comparator products infos
     *
     * @param  array $comparator
     * @return array
     */
    public function getDatasFromComparator(array $comparator): array
    {
        $comparatorDatas = [];
        foreach ($comparator as $productId) {
            /** @var Product $product */
            $product = $this->productRepository->find($productId);
            $comparatorDatas[] = [
                'product' => $product,
            ];
        }
        return [
            'comparatorData' => $comparatorDatas,
        ];
    }
}
