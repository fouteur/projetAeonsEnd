<?php

namespace App\Repository;

use App\Entity\Relique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Relique>
 */
class ReliqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Relique::class);
    }

    /**
     * @return Relique[]
     */
    public function FindWithMaxCout(int $cout, array $extensions) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.cout <= :cout')
            ->setParameter('cout', $cout)
            ->andWhere('r.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->orderBy('r.cout', 'ASC')
            ->getQuery()
            ->getResult();
      
    
    }

    /**
     * @return Relique[]
     */
    public function FindWithMinCout(int $cout, array $extensions) : array
    {
        return $this->createQueryBuilder('r')
            ->where('r.cout > :cout')
            ->setParameter('cout', $cout)
            ->andWhere('r.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->orderBy('r.cout', 'ASC')
            ->getQuery()
            ->getResult();
      
    }

    /**
     * @return Relique[]
     */
    public function findBetweenCout(int $min, int $max, array $extensions) :array
    {
        return $this->createQueryBuilder('r')
            ->where('r.cout > :min')
            ->andWhere('r.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->andWhere('r.cout <= :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('r.cout', 'ASC')
            ->getQuery()
            ->getResult();
        
    }

    /**
     * @return Relique[]
     */
    public function findWithCout(int $cout, array $extensions) :array
    {
       return $this->createQueryBuilder('r')
            ->where('r.cout = :cout')
            ->andWhere('r.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->setParameter('cout', $cout)
            ->getQuery()
            ->getResult();
      
    }



    // --------------------- Random functions --------------------------

     /**
     * @return Relique[] 
     */
    public function findRandomReliques(int $limit, array $extensions): array
    {  
        $all = $this->createQueryBuilder('r')
            ->where('r.extension IN (:extensions)')
            ->setParameter('extensions', $extensions)
            ->getQuery()
            ->getResult();
        shuffle($all);
        return array_slice($all, 0, $limit);
    }

    /**
     * @return Relique|null
     */
    public function FindRandomWithMaxCout(int $cout, array $extensions) :?Relique
    {
        $max = $this->FindWithMaxCout($cout, $extensions);
        shuffle($max);
        return $max[0] ?? null;
    }

    /**
     * @return Relique|null
     */
    public function FindRandomWithMinCout(int $cout, array $extensions) :?Relique
    {  
        $min = $this->FindWithMinCout($cout, $extensions);
        shuffle($min);
        return $min[0] ?? null;
    }

    /**
     * @return Relique|null
     */    
    public function findRandomBetweenCout(int $min, int $max, array $extensions) :?Relique
    {
        $between = $this->findBetweenCout($min, $max, $extensions);
        shuffle($between);
        return $between[0] ?? null;
    }

    /**
     * @return Relique|null
     */
    public function findRandomWithCout(int $cout, array $extensions) :?Relique
    {
        $WithCout = $this->findWithCout($cout, $extensions);
        shuffle($WithCout);
        return $WithCout[0] ?? null;
    }

    //    /**
    //     * @return Relique[] Returns an array of Relique objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Relique
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
