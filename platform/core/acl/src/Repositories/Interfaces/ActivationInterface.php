<?php

namespace Botble\ACL\Repositories\Interfaces;

use Botble\ACL\Models\User;

interface ActivationInterface
{
    /**
     * Create a new activation record and code.
     *
     * @param  \Botble\ACL\Models\User $user
     * @return \Botble\ACL\Models\Activation
     */
    public function createUser(User $user);

    /**
     * Checks if a valid activation for the given user exists.
     *
     * @param  \Botble\ACL\Models\User $user
     * @param  string $code
     * @return \Botble\ACL\Models\Activation|bool
     */
    public function exists(User $user, $code = null);

    /**
     * Completes the activation for the given user.
     *
     * @param  \Botble\ACL\Models\User $user
     * @param  string $code
     * @return bool
     */
    public function complete(User $user, $code);

    /**
     * Checks if a valid activation has been completed.
     *
     * @param  \Botble\ACL\Models\User $user
     * @return \Botble\ACL\Models\Activation|bool
     */
    public function completed(User $user);

    /**
     * Remove an existing activation (deactivate).
     *
     * @param  \Botble\ACL\Models\User $user
     * @return bool|null
     */
    public function remove(User $user);

    /**
     * Remove expired activation codes.
     *
     * @return int
     */
    public function removeExpired();
}
