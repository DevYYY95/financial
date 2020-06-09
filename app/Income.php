<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Income extends Model
{
    use SoftDeletes;

    protected $table = 'incomes';

    protected $fillable = ['entry_date','amount','description','income_cat_id','user_id'];

    public function category()
    {
        return $this->belongsTo(IncomeCategory::class,'income_cat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
