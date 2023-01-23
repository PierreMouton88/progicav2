<?php

namespace App\Form;

use App\Entity\Eqp;
use App\Repository\GiteRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class EqpAutocompleteFieldExt extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Eqp::class,
            'placeholder' => 'Equipements extérieurs',
            'choice_label' => 'name',
            'multiple' => true,
            'filter_query' => function (QueryBuilder $qb, string $query) {


                $qb->andWhere('entity.name LIKE :filter')
                    ->setParameter('filter', '%' . $query . '%')
                    ->andWhere('entity.type = :type')
                    ->setParameter('type', Eqp::EXT);
            },
            // 'query_builder' => function (GiteRepository $giteRepository) {
            //     return $giteRepository->createQueryBuilder('eqps');
            // },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}