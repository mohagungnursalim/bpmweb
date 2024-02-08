<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Tag;
class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['author','category', 'tag'];


    //  query scopes search berdasarkan title,body
    public function scopeFilter($query, array $filters)
    {
        // php 7 sugar tenari
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

       
    }
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    
    // relasi category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
     public function author()
     {
         return $this->belongsTo(User::class, 'user_id');
     }



    //  ________________________________
    public function getCategories($ids)
    {
        return Category::whereIn('id',json_decode($ids, true))->get();
    }

    public function getCategory($id)
    {
        return Category::find($id)->get();
    }


    // __________________________________
    public function getTags($ids)
    {
        return Tag::whereIn('id',json_decode($ids, true))->get();
    }

    public function getTag($id)
    {
        return Tag::find($id)->get();
    }
   



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
                'source' => 'title',
            ]
        ];
    }
}
