<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('categoryCategory', EntityType::class, [
                'label' => 'categories',
                'choice_label' => 'label',
                'class' => Category::class,
                'required' => false
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'filtre',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ]);
            // ->add('categoryCategory')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
