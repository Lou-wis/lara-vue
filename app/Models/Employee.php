<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'tbl_employees';

    protected $fillable = [
        'name',
        'email',
        'position',
        'department',
        'hire_date',
    ];
}
