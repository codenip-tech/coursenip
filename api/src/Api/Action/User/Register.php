<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\Request\RequestService;
use App\Service\User\UserRegisterService;
use App\Value\Email;
use App\Value\NonEmptyString;
use Symfony\Component\HttpFoundation\Request;

class Register
{
    private UserRegisterService $userRegisterService;

    public function __construct(UserRegisterService $userRegisterService)
    {
        $this->userRegisterService = $userRegisterService;
    }

    public function __invoke(Request $request): User
    {
        return $this->userRegisterService->create(
            new NonEmptyString(RequestService::getField($request, 'name')),
            new Email(RequestService::getField($request, 'email')),
            RequestService::getField($request, 'password')
        );
    }
}
