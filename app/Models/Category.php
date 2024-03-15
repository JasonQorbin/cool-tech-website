<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const UNASSIGNED = "Unassigned";
    protected $primaryKey = 'name';
    protected $keyType = 'string';
}
