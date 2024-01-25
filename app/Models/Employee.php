<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Finance;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['id','users_id', 'employee_id', 'amount'];


    public function finance()
    {
        return $this->hasMany(Finance::class);
    }
}
