<?php

namespace Botble\ACL\Listeners;

use Auth;
use Botble\ACL\Events\RoleAssignmentEvent;
use Botble\ACL\Repositories\Interfaces\UserInterface;

class RoleAssignmentListener
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
     * @param  RoleAssignmentEvent $event
     * @return void
     *
     * @throws \Exception
     */
    public function handle(RoleAssignmentEvent $event)
    {
        info('Role ' . $event->role->name . ' assigned to user ' . $event->user->getFullName());

        $permissions = $event->role->permissions;
        $permissions['superuser'] = $event->user->super_user;
        $permissions['manage_supers'] = $event->user->manage_supers;

        $this->userRepository->update([
            'id' => $event->user->id,
        ], [
            'permissions' => json_encode($permissions),
        ]);

        cache()->forget(md5('cache-dashboard-menu-' . Auth::user()->getKey()));
    }
}
