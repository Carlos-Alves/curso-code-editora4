<?php

namespace CodEditora\Criteria;

interface CriteriaTrashedInterface{
    public function onlyTrashed();
    public function withTrashed();
}