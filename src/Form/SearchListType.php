<?php

namespace App\Form;

use App\Entity\SearchList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',
            TextType::class,
            [
                'label' => 'Nom de la recherche',
                'required' => false
            ])
            ->add('marque',
            TextType::class,
            [
                'label' => 'Marque',
                'required' => false
            ])
            ->add('min_price',
            NumberType::class,
            [
                'label' => 'Prix Mininum',
                'required' => false
            ])
            ->add('max_price',
            NumberType::class,
            [
                'label' => 'Prix Maximum',
                'required' => false
            ])
            ->add('category',
            TextType::class,
            [
                'label' => 'Catégorie',
                'required' => false
            ])
            ->add('alimentation',
            TextType::class,
            [
                'label' => 'Type d\'Alimentation',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchList::class,
        ]);
    }
}
