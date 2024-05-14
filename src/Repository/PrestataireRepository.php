<?php

namespace App\Repository;

use App\Entity\Prestataire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Prestataire>
 */
class PrestataireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prestataire::class);
    }
    /**
     * Recherche les prestataires par pseudo.
     *
     * @param string $query Le pseudo à rechercher
     * @return Prestataire[] Les prestataires correspondants
     */
    public function findByPseudo(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.pseudo LIKE :query')
            ->setParameter('query', "%{$query}%")
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche les prestataires par type de service.
     *
     * @param string $query Le type de service à rechercher
     * @return Prestataire[] Les prestataires correspondants
     */
    public function findByTypeService(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.typeService LIKE :query')
            ->setParameter('query', "%{$query}%")
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche les prestataires par compétences.
     *
     * @param string $query Les compétences à rechercher
     * @return Prestataire[] Les prestataires correspondants
     */
    public function findByCompetences(string $query): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.competences LIKE :query')
            ->setParameter('query', "%{$query}%")
            ->getQuery()
            ->getResult();
    }
    
    /**
     * Recherche les prestataires par pseudo, type de service ou compétences.
     *
     * @param string $query La chaîne de recherche
     * @return Prestataire[] Les prestataires correspondants
     */
    public function searchPrestataires(string $query): array
    {
        $pseudoResults = $this->findByPseudo($query);
        $typeServiceResults = $this->findByTypeService($query);
        $competencesResults = $this->findByCompetences($query);

        // Concaténer les résultats en utilisant une méthode appropriée
        $results = array_merge($pseudoResults, $typeServiceResults, $competencesResults);

        // Supprimer les doublons des résultats
        $uniqueResults = array_unique($results);

        return $uniqueResults;
    }
}
