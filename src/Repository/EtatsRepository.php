<?php

namespace App\Repository;

use App\Entity\Etats;
use App\Entity\PropertySearch;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Etats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etats[]    findAll()
 * @method Etats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etats::class);
    }

    public function orderByNom()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.noEtat', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByNom()
    {


        $query = $this->createQueryBuilder('n')
            ->where('n.noEtat ');
        ;

        return $query->getQuery()->getArrayResult();
    }





    // /**
    //  * @return Participant[] Returns an array of Participant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Participant
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

?>