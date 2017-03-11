<?php

namespace CodeEduBook\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindWithTrashedCriteriaCriteria
 * @package namespace CodEditora\Criteria;
 */
class FindByBook implements CriteriaInterface
{

    /**
     * @var
     */
    private $bookId;

    /**
     * FindByBook constructor.
     */
    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }


    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('book_id', $this->bookId);
    }
}
