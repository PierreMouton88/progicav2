<?php

namespace App\Form;

use App\Entity\Eqp;
use App\Repository\EqpRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class EqpAutocompleteFieldInt extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Eqp::class,
            'placeholder' => 'Choose a Eqp',
            'choice_label' => 'name',
            'multiple' => true,
            'filter_query' => function (QueryBuilder $qb, string $query, EqpRepository $repository) {


                $qb->andWhere('entity.name LIKE :filter')
                    ->setParameter('filter', '%' . $query . '%')
                    ->andWhere('entity.type = :type')
                    ->setParameter('type', Eqp::INT);
            }
            // 'query_builder' => function(EqpRepository $eqpRepository) {
            //     return $eqpRepository->createQueryBuilder('eqp');
            // },
            //'security' => 'ROLE_SOMETHING',
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}