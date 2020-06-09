<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use SoftDeletes;
	
    protected $table = 'expense_categories';

    protected $fillable = ['name'];

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
