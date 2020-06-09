<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $table = 'expenses';

    protected $fillable = ['entry_date','amount','description','expense_cat_id','user_id'];

    public function category()
    {
        return $this->belongsTo(ExpenseCategory::class,'expense_cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
