<?php

namespace Botble\ACL\Listeners;

use Auth;
use Botble\ACL\Events\RoleUpdateEvent;
use Botble\ACL\Repositories\Interfaces\UserInterface;

class RoleUpdateListener
{
    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * RoleAssignmentListener constructor.
     *
     * @param UserInterface $userRepository
     */
    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @param  RoleUpdateEvent $event
     * @return void
     *
     * @throws \Exception
     */
    public function handle(RoleUpdateEvent $event)
    {
        info('Role ' . $event->role->name . ' updated; rebuilding permission sets');

        $permissions = $event->role->permissions;
        foreach ($event->role->users()->get() as $user) {
            $permissions['superuser'] = $user->super_user;
            $permissions['manage_supers'] = $user->manage_supers;

            $this->userRepository->update([
                'id' => $user->id,
            ], [
                'permissions' => json_encode($permissions),
            ]);
        }

        cache()->forget(md5('cache-dashboard-menu-' . Auth::user()->getKey()));
    }
}
