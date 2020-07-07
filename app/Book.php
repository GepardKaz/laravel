<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $table = 'books';

    public $timestamps = true;
    protected $fillable = [
    	'id',
        'bname', 
        'description',
        'price',
        'sale_date',
        'author',
        'publisher'
    ];
}
