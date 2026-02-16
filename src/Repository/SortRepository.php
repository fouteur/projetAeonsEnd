<?php

namespace App\Repository;

use App\Entity\Sort;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sort>
 */
class SortRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sort::class);
    }

   
    /**
     * @return Sort[]|null
     */
    public function FindWithMaxCout(int $cout, array $extensions) :array
    {
        return $this->createQueryBuilder('s')
            ->where('s.cout <= :cout')
            ->setParameter('cout', $cout)
            ->andWhere('s.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->orderBy('s.cout', 'ASC')
            ->getQuery()
            ->getResult();
        
    }

    /**
     * @return Sort[]|null
     */
    public function FindWithMinCout(int $cout, array $extensions) :array
    {
        return $this->createQueryBuilder('s')
            ->where('s.cout > :cout')
            ->andWhere('s.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->setParameter('cout', $cout)
            ->orderBy('s.cout', 'ASC')
            ->getQuery()
            ->getResult();
       
    }

    /**
     * @return Sort[]|null
     */
    public function findBetweenCout(int $min, int $max, array $extensions) :array
    {
        return $this->createQueryBuilder('s')
            ->where('s.cout > :min')
            ->andWhere('s.cout <= :max')
            ->andWhere('s.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('s.cout', 'ASC')
            ->getQuery()
            ->getResult();
        
    }

    /**
     * @return Sort[]|null
     */
    public function findWithCout(int $cout, array $extensions) :array
    {
        return  $this->createQueryBuilder('s')
            ->where('s.cout = :cout')
            ->andWhere('s.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->setParameter('cout', $cout)
            ->getQuery()
            ->getResult();
        

    }


    // --------------------- Random functions --------------------------


     /**
     * @return Sort[] 
     */
    public function findRandomSorts(int $limit, array $extensions): array
    {
       
        $all = $this->createQueryBuilder('s')
            ->where('s.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->getQuery()
            ->getResult();
        shuffle($all);
        return array_slice($all, 0, $limit);
    }


    /**
     * @return Sort|null
     */
    public function FindRandomWithMaxCout(int $cout, array $extensions) :?Sort
    {
        $max = $this->FindWithMaxCout($cout, $extensions);
        shuffle($max);
        return $max[0] ?? null;
    }

    /**
     * @return Sort|null
     */
    public function FindRandomWithMinCout(int $cout, array $extensions) :?Sort
    {  
        $min = $this->FindWithMinCout($cout, $extensions);
        shuffle($min);
        return $min[0] ?? null;
    }

    /**
     * @return Sort|null
     */    
    public function findRandomBetweenCout(int $min, int $max, array $extensions) :?Sort
    {
        $between = $this->findBetweenCout($min, $max, $extensions);
        shuffle($between);
        return $between[0] ?? null;
    }

    /**
     * @return Sort|null
     */
    public function findRandomWithCout(int $cout, array $extensions) :?Sort
    {
        $WithCout = $this->findWithCout($cout, $extensions);
        shuffle($WithCout);
        return $WithCout[0] ?? null;
    }

    //    /**
    //     * @return Sort[] Returns an array of Sort objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Sort
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
