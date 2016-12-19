<?php

namespace CodEditora\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodEditora\Repositories\BookRepository;
use CodEditora\Models\Book;
use CodEditora\Validators\BookValidator;

/**
 * Class BookRepositoryEloquent
 * @package namespace CodEditora\Repositories;
 */
class BookRepositoryEloquent extends BaseRepository implements BookRepository
{
    protected $fieldSearchable = [
        'title' => 'like',
        'author.name' => 'like',
        'categories.name' => 'like'
    ];

    public function create(array $attributes)
    {
        $model = parent::create($attributes);
        $model->categories()->sync($attributes['categories']);
        return $model;
    }



    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);
        $model->categories()->sync($attributes['categories']);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Book::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
