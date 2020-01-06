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

    public function walletToEmail(){
        if($this->transfer_wallet_id != null) {
            $user = User::findOrFail($this->transfer_wallet_id);
            return $user->email;
        }
        return null;
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

    public function categoryToStr()
    {
        switch ($this->category_id){
            case '1':
                return 'Groceries';
            case '2':
                return 'Restaurant';
            case '3':
                return 'Clothes';
            case '4':
                return 'Shoes';
            case '5':
                return 'School';
            case '6':
                return 'Services';
            case '7':
                return 'Electricity';
            case '8':
                return 'Phone';
            case '9':
                return 'Fuel';
            case '10':
                return 'Mortgage Payment';
            case '11':
                return 'Car Payment';
            case '12':
                return 'Entertainment';
            case '13':
                return 'Gadget';
            case '14':
                return 'Computer';
            case '15':
                return 'Vacation';
            case '16':
                return 'Hobby';
            case '17':
                return 'Loan Repayment';
            case '18':
                return 'Loan';
            case '19':
                return 'Other Expense';
            case '20':
                return 'Salary';
            case '21':
                return 'Bonus';
            case '22':
                return 'Royalties';
            case '23':
                return 'Interests';
            case '24':
                return 'Gifts';
            case '25':
                return 'Dividends';
            case '26':
                return 'Sales';
            case '27':
                return 'Loan Repayment';
            case '28':
                return 'Loan';
            case '29':
                return 'Other Income';
        }
        return 'Unknown';
    }
}
