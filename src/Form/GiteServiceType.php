<?php

namespace App\Form;

use App\Entity\GiteService;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GiteServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('service', 
            EntityType::class, [
                'label' => false,
                'class' => Service::class
            ])
            ->add('price', null,
                [
                'label' => 'Prix du service',
                
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GiteService::class,
        ]);
    }
}
