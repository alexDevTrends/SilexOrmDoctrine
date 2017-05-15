<?php

namespace Repository;

use Doctrine\ORM\EntityRepository;

class IdealTrendsRepository extends EntityRepository
{

    public function obterPorTitulo($title)
    {
        return $this->createQueryBuilder('c')
            ->where('c.title LIKE :title')
            ->setParameter('title', '%' . $title . '%')
            ->getQuery()
            ->getResult();
    }
}