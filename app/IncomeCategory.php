<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomeCategory extends Model
{
    use SoftDeletes;
	
    protected $table = 'income_categories';

    protected $fillable = ['name'];

    public function income()
    {
        return $this->hasMany(Income::class);
    }
}
