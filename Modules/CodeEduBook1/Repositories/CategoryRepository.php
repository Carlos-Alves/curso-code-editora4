<?php

namespace CodeEduBook\Repositories;

use CodEditora\Criteria\CriteriaTrashedInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CategoryRepository
 * @package namespace CodEditora\Repositories;
 */
interface CategoryRepository extends RepositoryInterface, CriteriaTrashedInterface
{
    public function listsWithMutators($column, $key = null);
}
