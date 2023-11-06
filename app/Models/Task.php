<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

}
