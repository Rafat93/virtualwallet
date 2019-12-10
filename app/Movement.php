<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movements';

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public function typeToStr()
    {
        switch ($this->type) {
            case 'e':
                return 'Expense';
            case 'i':
                return 'Income';
        }

        return 'Unknown';
    }

    public function type_paymentToStr()
    {
        switch ($this->type_payment) {
            case 'c':
                return 'Cash';
            case 'bt':
                return 'Bank Transfer';
            case 'mb':
                return 'MB payment';
            case null:
                return '-';

        }

        return 'Unknown';
    }
}
