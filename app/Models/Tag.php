<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;

    protected $primaryKey = 'name';
    protected $keyType = 'string';

    protected $fillable = ['name'];

    public function associations() {
        return DB::table('article_tag_joins')->where('tag_name', $this->name)->count();
    }
}
