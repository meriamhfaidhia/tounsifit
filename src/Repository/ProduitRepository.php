<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * Recherche les produits par ordre alphabétique du nom.
     *
     * @return Produit[] Liste des produits triés par nom
     */
  

    public function searchByQuery(string $query): array
{
    return $this->createQueryBuilder('p')
        ->andWhere('p.nom LIKE :query')
        ->setParameter('query', '%'.$query.'%')
        ->orderBy('p.nom', 'ASC')
        ->getQuery()
        ->getResult();
}
}
