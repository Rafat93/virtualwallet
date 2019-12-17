<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = ['id'];

    protected $fillable = [];

    public function typeToStr()
    {
        switch ($this->type) {
            case 'i':
                return 'Income';
            case 'e':
                return 'Expense';
        }

        return 'Unknown';
    }
}
