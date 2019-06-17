<?php

namespace App\Repository;

use App\Entity\Galery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Galery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Galery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Galery[]    findAll()
 * @method Galery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GaleryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Galery::class);
    }
}
