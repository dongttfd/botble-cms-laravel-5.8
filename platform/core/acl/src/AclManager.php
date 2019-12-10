<?php

namespace Botble\ACL;

use Botble\ACL\Models\User;
use Botble\ACL\Repositories\Interfaces\ActivationInterface;
use Botble\ACL\Repositories\Interfaces\RoleInterface;
use Botble\ACL\Repositories\Interfaces\UserInterface;
use InvalidArgumentException;

class AclManager
{

    /**
     * The User repository.
     *
     * @var \Botble\ACL\Repositories\Interfaces\UserInterface
     */
    protected $users;

    /**
     * The Role repository.
     *
     * @var \Botble\ACL\Repositories\Interfaces\RoleInterface
     */
    protected $roles;

    /**
     * The Activations repository.
     *
     * @var \Botble\ACL\Repositories\Interfaces\ActivationInterface
     */
    protected $activations;

    /**
     * AclManager constructor.
     * @param UserInterface $users
     * @param RoleInterface $roles
     * @param ActivationInterface $activations
     */
    public function __construct(
        UserInterface $users,
        RoleInterface $roles,
        ActivationInterface $activations
    )
    {
        $this->users = $users;

        $this->roles = $roles;

        $this->activations = $activations;
    }

    /**
     * Activates the given user.
     *
     * @param  mixed $user
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function activate($user)
    {
        if (!$user instanceof User) {
            throw new InvalidArgumentException('No valid user was provided.');
        }

        event('acl.activating', $user);

        $activations = $this->getActivationRepository();

        $activation = $activations->createUser($user);

        event('acl.activated', [$user, $activation]);

        return $activations->complete($user, $activation->getCode());
    }

    /**
     * @return UserInterface
     */
    public function getUserRepository()
    {
        return $this->users;
    }

    /**
     * Returns the role repository.
     *
     * @return \Botble\ACL\Repositories\Interfaces\RoleInterface
     */
    public function getRoleRepository()
    {
        return $this->roles;
    }

    /**
     * Sets the role repository.
     *
     * @param  \Botble\ACL\Repositories\Interfaces\RoleInterface $roles
     * @return void
     */
    public function setRoleRepository(RoleInterface $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Returns the activations repository.
     *
     * @return \Botble\ACL\Repositories\Interfaces\ActivationInterface
     */
    public function getActivationRepository()
    {
        return $this->activations;
    }

    /**
     * Sets the activations repository.
     *
     * @param  \Botble\ACL\Repositories\Interfaces\ActivationInterface $activations
     * @return void
     */
    public function setActivationRepository(ActivationInterface $activations)
    {
        $this->activations = $activations;
    }
}
