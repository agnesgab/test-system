<?php

namespace App\Services\User\Store;

use App\Repositories\User\UserRepository;

class UserStoreService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(UserStoreRequest $request)
    {
        $name = $request->getName();
        $uuid = uniqid();

        $this->userRepository->store($name, $uuid);

        return new UserStoreResponse($name, $uuid);
    }
}
