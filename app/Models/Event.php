<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];
    protected $casts = [
        'tanggal_mulai' => 'datetime:d-m-Y'
    ];



    // show detail post berdasarkan slug
 public function getRouteKeyName()
 {
     return 'slug';
 }
 // _______________________


 public function sluggable(): array
 {
     return [
         'slug' => [
             'source' => 'nama',
         ]
     ];
 }
}

 