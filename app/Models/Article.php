<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Default values
     *
     * @var string[] Column=> default value
     */
    protected $attributes = [
        'content' => ""
    ];

    /**
     * Mass-asignable columns
     *
     * @var string[] database columns
     */
    protected $fillable = [
        'title',
        'category',
        'content',
    ];
}
