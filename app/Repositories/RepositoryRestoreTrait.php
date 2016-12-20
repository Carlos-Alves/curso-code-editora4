<?php

namespace CodEditora\Repositories;

trait RepositoryRestoreTrait{

    /**
     * @param $id
     */
    public function restore($id){

        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);


        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $model->restore();

    }


}