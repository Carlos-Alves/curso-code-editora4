<?php

namespace CodeEduBook\Models;

use CodEditora\Models\Livro;
use Bootstrapper\Interfaces\TableInterface;
use CodeEduBook\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
        ];

    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Nome' ];
    }

    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
        }

    }
    public function books(){
        return $this->belongsToMany(Book::class);
    }

    public function getNameTrashedAttribute(){
        return $this->trashed() ? "{$this->name} (Inativa)": $this->name;
    }

}
