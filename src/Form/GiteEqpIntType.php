<?php

namespace App\Form;

use App\Entity\EqpInt;
use App\Entity\GiteEqpInt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiteEqpIntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('eqpInt', 
            EntityType::class, [
                'label' => false,
                'class' => EqpInt::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiteEqpInt::class,
        ]);
    }
}