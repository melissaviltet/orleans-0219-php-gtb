<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function getEventCommentNumber(string $direction = 'ASC')
    {
        return $this->createQueryBuilder('e')
            ->select("COUNT(e.id) as nbComments, e.name, e.date, e.picture")
            ->join('e.comments', 'c')
            ->groupBy('e.id')
            ->orderBy('nbComments', $direction)
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }
}
