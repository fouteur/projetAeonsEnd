<?php

namespace App\Repository;

use App\Entity\Gemmes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Gemmes>
 */
class GemmesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gemmes::class);
    }

    /**
     * @return Gemmes[]|null
     */
    public function FindWithMaxCout(int $cout,array $extension=[string]) :array
    {
        return  $this->createQueryBuilder('g')
            ->where('g.cout <= :cout')
            ->andWhere('g.extension IN (:extension)')
            ->setParameter('extension', $extension)
            ->setParameter('cout', $cout)
            ->orderBy('g.cout', 'ASC')
            ->getQuery()
            ->getResult();
      
    }

     /**
     * @return Gemmes[]|null
     */
    public function FindWithMinCout(int $cout,array $extension=[string]) :array
    {
        return $this->createQueryBuilder('g')
            ->where('g.cout >= :cout')
            ->andWhere('g.extension IN (:extension)')
            ->setParameter('extension', $extension)
            ->setParameter('cout', $cout)
            ->orderBy('g.cout', 'ASC')
            ->getQuery()
            ->getResult();
      
    }

    
    /**
     * @return  Gemmes[]|null
     */
    public function findBetweenCout(int $min, int $max,array $extension=[string]) :array
    {
        return $this->createQueryBuilder('g')
            ->where('g.cout > :min')
            ->andWhere('g.cout <= :max')
            ->andWhere('g.extension IN (:extension)')
            ->setParameter('extension', $extension)
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Gemmes[]|null
     */
    public function findWithCout(int $cout,array $extension=[string]) :  array
    {
        return $this->createQueryBuilder('g')
            ->where('g.cout = :cout')
            ->andWhere('g.extension IN (:extension)')
            ->setParameter('extension', $extension)
            ->setParameter('cout', $cout)
            ->getQuery()
            ->getResult();
        
    }

    // --------------------- Random functions --------------------------
    /**
     * @return Games[] 
     */
    public function findRandomGemmes(int $limit, array $extension=[string]): array
    {
        $all = $this->createQueryBuilder('g')
            ->where('g.extension IN (:extension)')
            ->setParameter('extension', $extension)
            ->getQuery()
            ->getResult();
        shuffle($all);
        return array_slice($all, 0, $limit);
    }
     
    /**
     * @return Gemmes|null
     */
    public function FindRandomWithMaxCout(int $cout,array $extension=[string]) :?Gemmes
    {
        $max = $this->FindWithMaxCout($cout,$extension);
        shuffle($max);
        return $max[0] ?? null;
    }

    /**
     * @return Gemmes|null
     */
    public function FindRandomWithMinCout(int $cout,array $extension=[string]) :?Gemmes
    {  
        $min = $this->FindWithMinCout($cout,$extension);
        shuffle($min);
        return $min[0] ?? null;
    }

    /**
     * @return Gemmes|null
     */    
    public function findRandomBetweenCout(int $min, int $max,array $extension=[string]) :?Gemmes
    {
        $between = $this->findBetweenCout($min, $max,$extension);
        shuffle($between);
        return $between[0] ?? null;
    }

    /**
     * @return Gemmes|null
     */
    public function findRandomWithCout(int $cout,array $extension=[string]) :?Gemmes
    {
        $WithCout = $this->findWithCout($cout,$extension);
        shuffle($WithCout);
        return $WithCout[0] ?? null;
    }


    //    /**
    //     * @return Gemmes[] Returns an array of Gemmes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Gemmes
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
