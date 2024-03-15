<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public const UNASSIGNED = "Unassigned";
    protected $primaryKey = 'name';
    protected $keyType = 'string';

    protected $fillable = ['name'];

    public function associations() {
        return DB::table('articles')->where('category_name', $this->name)->count();
    }
}
