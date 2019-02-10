<?php

declare(strict_types=1);

namespace Api\Model\User\Entity\User;

interface UserRepository
{
    public function hasByEmail(Email $email): User;

    public function add(User $user): void;
}