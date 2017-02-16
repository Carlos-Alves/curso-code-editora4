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

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        if (isset($attributes['permissions'])){
            $model->permissions()->sync($attributes['permissions']);
        }
        return $model;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
