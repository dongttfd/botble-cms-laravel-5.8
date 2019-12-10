<?php

namespace Botble\ACL\Services;

use AclManager;
use Auth;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use Exception;

class ActivateUserService
{
    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * RegisterService constructor.
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     *
     * @param $code
     * @param $username
     * @return bool|Exception
     */
    public function execute($code, $username)
    {
        try {
            $user = $this->userRepository->getFirstBy(['username' => $username]);

            if (!$user) {
                return new Exception(__('User is not exists!'));
            }

            if (AclManager::getActivationRepository()->complete($user, $code)) {
                Auth::login($user, true);
                return true;
            }

            return new Exception(__('Activation code is invalid or expired!'));
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
