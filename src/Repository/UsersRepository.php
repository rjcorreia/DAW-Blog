<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }


    public function checkIfEmailExists($email): bool
    {
        $query = $this->getEntityManager()->createQuery('SELECT u.email FROM App:Users u WHERE u.email = ?1');
        $query->setParameter(1, $email);
        $result = $query->getResult();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdFromEmail($email): int
    {
        $query = $this->getEntityManager()->createQuery('SELECT u.id FROM App:Users u WHERE u.email = ?1');
        $query->setParameter(1, $email);
        $result = $query->getResult();
        if ($result) {
            return $result[0]['id'];
        } else {
            return -1;
        }
    }

}
