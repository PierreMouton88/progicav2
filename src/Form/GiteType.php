<?php

namespace App\Form;

use App\Entity\Gite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class GiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')

            ->add('description')
            ->add('address')
            ->add('city')
            ->add('zipcode')
            ->add('departement')
            ->add('region')
            ->add('surface')
            ->add('rooms')
            ->add('beds')
            ->add('animalAllowed')
            ->add('animalFee')
            ->add('greenPrice')
            ->add('redPrice')
            ->add('startRed', DateType::class, [
                'by_reference' => true,
            ])
            ->add('endRed',  DateType::class)
            ->add('giteServices', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => GiteServiceType::class,
                'allow_delete' => true,
                'by_reference' => false,

            ])
            // ->add('giteEqpExts', CollectionType::class, [
            //     'allow_add' => true,
            //     'entry_type' => GiteEqpExtType::class,
            //     'allow_delete'=> true,
            //     'by_reference' => false,


            // ])
            // ->add('giteEqpInts', CollectionType::class, [
            //     'allow_add' => true,
            //     'entry_type' => GiteEqpIntType::class,
            //     'allow_delete'=> true,
            //     'by_reference' => false,

            // ])
            ->add('eqpInt', EqpAutocompleteFieldInt::class, [
                'mapped' => false
            ])
            ->add('eqpExt', EqpAutocompleteFieldExt::class, [
                'mapped' => false
            ])
            ->add('imageFile', VichFileType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gite::class,
        ]);
    }
}