<?php

namespace App\Repository;

use App\Entity\UsersPhone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class UsersPhoneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersPhone::class);
    }

    /**
     * @param string $query
     *
     * @return array
     */
    public function findAllByQuery(string $query): array
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.name LIKE :query')
            ->orWhere('u.phone LIKE :query')
            ->setParameter('query', '%'.$query.'%')
            ->orderBy('u.name')
            ->getQuery();

        return $qb->getArrayResult();
    }
}