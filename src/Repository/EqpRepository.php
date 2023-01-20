<?php

namespace App\Repository;

use App\Entity\Eqp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Eqp>
 *
 * @method Eqp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eqp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eqp[]    findAll()
 * @method Eqp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EqpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eqp::class);
    }

    public function save(Eqp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Eqp $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Eqp[] Returns an array of Eqp objects
    //     */
    public function findByText($value, $type): array
    {
        if ($type == 'ext') {
            $type = Eqp::EXT;
        } else if ($type == 'int') {
            $type = Eqp::INT;
        }

        return $this->createQueryBuilder('e')
            ->andWhere('e.name LIKE :val')
            ->setParameter('val', '%' . $value . '%')
            ->andWhere('e.type = :type ')
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();
    }

    // public function findOneBySomeField($value): ?Eqp
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

    public function findByType(string $type): array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.type = :val')
            ->setParameter('val', $type)
            ->getQuery()
            ->getResult();
    }
}
