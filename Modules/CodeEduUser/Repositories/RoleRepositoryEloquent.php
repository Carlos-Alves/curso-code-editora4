<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Repositories\RoleRepository;
use CodeEduUser\Models\Role;

/**
 * Class RoleRepositoryEloquent
 * @package namespace CodEduUser\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updatePermissions(array $permissions, $id)
    {
        $model = $this->find($id);
        $model->permissions()->detach();
        if (count($permissions)){
            $model->permissions()->sync($permissions);
        }
        return $model;
    }
}
