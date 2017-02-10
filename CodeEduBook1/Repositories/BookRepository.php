<?php

namespace CodeEduBook\Repositories;

use CodEditora\Criteria\CriteriaTrashedInterface;
use CodEditora\Repositories\RepositoryRestoreInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BookRepository
 * @package namespace CodEditora\Repositories;
 */
interface BookRepository extends RepositoryInterface, RepositoryCriteriaInterface, CriteriaTrashedInterface, RepositoryRestoreInterface
{
    //
}
