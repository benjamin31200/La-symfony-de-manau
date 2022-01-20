<?php

namespace App\Entity;

use App\Repository\SearchListRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SearchListRepository::class)
 */
class SearchList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min_price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alimentation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getMinPrice(): ?int
    {
        return $this->min_price;
    }

    public function setMinPrice(?int $min_price): self
    {
        $this->min_price = $min_price;

        return $this;
    }

    public function getMaxPrice(): ?int
    {
        return $this->max_price;
    }

    public function setMaxPrice(?int $max_price): self
    {
        $this->max_price = $max_price;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAlimentation(): ?string
    {
        return $this->alimentation;
    }

    public function setAlimentation(?string $alimentation): self
    {
        $this->alimentation = $alimentation;

        return $this;
    }

    /**
 * Converts and returns current search object to an array.
 *
 * @param $ignores | requires to be an array with string values matching the search object its private property names.
 */
public function convertToArray(array $ignores = [])
{
    $search = [
        'id' => $this->id,
        'marque' => $this->marque,
        'min_price' => $this->min_price,
        'max_price' => $this->max_price,
        'category' => $this->category,
        'alimentation' => $this->alimentation,
        'title' => $this->title,
    ];

    // Remove key/value if its in the ignores list.
    for ($i = 0; $i < count($ignores); $i++) {
        if (array_key_exists($ignores[$i], $search)) {
            unset($search[$ignores[$i]]);
        }
    }

    return $search;
}
}
