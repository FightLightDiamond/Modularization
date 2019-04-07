<?php

namespace _namespace_\Policies;

use _namespace_\Models\_class_;
use _namespace_\Repositories\PermissionRepository;
use _namespace_\Repositories\RoleRepository;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class _class_Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    private $roleRepository, $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function view(User $user, _class_ $_table_)
    {
        if ($this->permissionRepository->is('view__name_')) {
            return true;
        }
        return $user->id === $_table_->user_id;
    }

    public function create(User $user)
    {
        if ($this->permissionRepository->is('create__name_')) {
            return true;
        }
        return false;
    }

    public function update(User $user, _class_ $_table_)
    {
        if ($this->permissionRepository->is('update__name_')) {
            return true;
        }
        return $user->id === $_table_->user_id;
    }

    public function delete($user, _class_ $_table_)
    {
        if ($this->permissionRepository->is('delete__name_')) {
            return true;
        }
        return $user->id === $_table_->user_id;
    }

}
