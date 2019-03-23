<?php

use Api\Http\Action;
use Api\Model\User\UseCase\SignUp\Request\Handler;
use Psr\Container\ContainerInterface;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Api\Http\Validator\Validator;

return [

    ValidatorInterface::class => function () {
        AnnotationRegistry::registerLoader('class_exists');
        return Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
    },

    Validator::class => function (ContainerInterface $container) {
        return new Validator(
            $container->get(ValidatorInterface::class)
        );
    },

    Action\HomeAction::class => function () {
        return new Action\HomeAction();
    },

    Action\Auth\SignUp\RequestAction::class => function (ContainerInterface $container) {
        return new Action\Auth\SignUp\RequestAction(
            $container->get(Handler::class),
            $container->get(Validator::class)
        );
    },

    Action\Auth\SignUp\ConfirmAction::class => function (ContainerInterface $container) {
        return new Action\Auth\SignUp\ConfirmAction(
            $container->get(Api\Model\User\UseCase\SignUp\Confirm\Handler::class),
            $container->get(Validator::class)
        );
    },
];