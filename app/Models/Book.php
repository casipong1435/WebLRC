<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'accession_number',
        'date_acquired',
        'author',
        'title',
        'edition',
        'volume',
        'extent',
        'funding_source',
        'purchase_price',
        'publisher',
        'publication_year',
        'location',
        'remarks',
        'status',
        'program',
        'course_code',
        'course_title',
        'isbn'
    ];
}
