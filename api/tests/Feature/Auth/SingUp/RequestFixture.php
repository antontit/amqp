<?php

declare(strict_types=1);

namespace Test\Feature\Auth\SingUp;

use Api\Model\User\Entity\User\ConfirmToken;
use Api\Model\User\Entity\User\Email;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Test\Builder\User\UserBuilder;

class RequestFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $user = (new UserBuilder())
            ->withDate($now = new \DateTimeImmutable())
            ->withEmail(new Email('test@example.com'))
            ->withConfirmToken(new ConfirmToken($token = 'token', $now->modify('+1 day')))
            ->build();

        $user->confirmSignup($token, $now);
        $manager->persist($user);
        $manager->flush();
    }
}
