<?php

namespace App\Form;

use App\Entity\Gite;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
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
            ->add('startRed', TypeDateTimeType::class, [
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Mois', 'day' => 'Jour',
                    'date_widget' => 'single_text',
                    'with_hours' => false,
                    'with_minutes' => false,
                ],
            ])
            ->add('endRed', TypeDateTimeType::class, [
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Mois', 'day' => 'Jour',
                    'date_widget' => 'single_text',
                    'with_hours' => false,
                    'with_minutes' => false,
                ],
            ])
            ->add('giteServices', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => GiteServiceType::class,
                'allow_delete'=> true,
                'by_reference' => false,

            ])
            ->add('giteEqpExts', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => GiteEqpExtType::class,

            ])
            ->add('giteEqpInts', CollectionType::class, [
                'allow_add' => true,
                'entry_type' => GiteEqpIntType::class,

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