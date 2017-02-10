<?php

namespace CodeEduBook\Repositories;

use CodEditora\Criteria\CriteriaTrashedTrait;
use CodEditora\Repositories\BaseRepositoryTrait;
use CodEditora\Repositories\Collection;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Models\Category;
use CodEditora\Validators\CategoryValidator;

/**
 * Class CategoryRepositoryEloquent
 * @package namespace CodEditora\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    use BaseRepositoryTrait;
    use CriteriaTrashedTrait;

    protected $fieldSearchable = [ 'name' => 'like' ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $column
     * @param null $key
     */
    public function listsWithMutators($column, $key = null)
    {
        /** @var Collection $collection */
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }
}
