<?php

namespace App\Repository;

use App\Entity\PropertySearch;
use App\Entity\Sites;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Sites|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sites|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sites[]    findAll()
 * @method Sites[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sites::class);
    }

    public function orderByNom()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.noSite', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function findByNom(PropertySearch $search) {


        if ($search->getNom()){


            $query =$this->createQueryBuilder('n')->where('n.nomSite = :nom ');
            $query->setParameter('nom',$search->getNom());
            return $query->getQuery()->getArrayResult();
        }

        return null;
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
