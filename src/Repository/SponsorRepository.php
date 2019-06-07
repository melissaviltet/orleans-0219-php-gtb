<?php

namespace App\Repository;

use App\Entity\Sponsor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sponsor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sponsor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sponsor[]    findAll()
 * @method Sponsor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SponsorRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sponsor::class);
    }
}

