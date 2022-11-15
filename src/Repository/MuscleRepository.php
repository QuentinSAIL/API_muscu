<?php

namespace App\Repository;

use App\Entity\Muscle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestEntity>
 *
 * @method Muscle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Muscle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Muscle[]    findAll()
 * @method Muscle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MuscleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Muscle::class);
    }

    public function save(Muscle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Muscle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TestEntity[] Returns an array of TestEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TestEntity
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    /**
     *
     * retourne les étudiants paginée
     * @param $page
     * @param $limit d'étudiant par page
     * @return array
     */

    public function findWithPagination($page, $limit) {
        $qb = $this->createQueryBuilder('m')
            ->andWhere('m.status = :status')
            ->setParameter('status', 'on');
        $qb->setFirstResult(($page-1) * $limit);
        $qb->setMaxResults($limit);
        return $qb->getQuery()->getResult();
    }

}
