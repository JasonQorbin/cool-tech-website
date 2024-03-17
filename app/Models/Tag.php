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

    /**
     * Count the number of articles assigned to this category in the database.
     *
     * @return int The number of articles.
     */
    public function associations() {
        return DB::table('article_tag_joins')->where('tag_name', $this->name)->count();
    }
}
