<?php

namespace App\Repository;

use App\Entity\ExerciceMuscle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExerciceMuscle>
 *
 * @method ExerciceMuscle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExerciceMuscle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExerciceMuscle[]    findAll()
 * @method ExerciceMuscle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciceMuscleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExerciceMuscle::class);
    }

    public function save(ExerciceMuscle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExerciceMuscle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ExerciceMuscle[] Returns an array of ExerciceMuscle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExerciceMuscle
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
