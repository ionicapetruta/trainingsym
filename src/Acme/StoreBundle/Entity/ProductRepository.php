<?php
/** Created by PhpStorm... */
namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT * FROM AcmeStoreBundle:Product '
            )
            ->getResult();
    }
}