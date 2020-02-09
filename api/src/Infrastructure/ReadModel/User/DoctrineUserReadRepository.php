<?php

declare(strict_types=1);

namespace Api\Infrastructure\ReadModel\User;

use Api\Model\User\Entity\User\User;
use Api\ReadModel\User\UserReadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineUserReadRepository implements UserReadRepository
{
    /**
     * @var EntityRepository
     */
    private $repo;
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repo = $em->getRepository(User::class);
        $this->em = $em;
    }

    public function find(string $id): ?User
    {
        return $this->repo->find($id);
    }
}