<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable=[

        'user_id',
        'category_id',
        'cover',
        'title',
        'sub_title',
        'slug',
        'content',
    ];

    public function category()
    {
            return $this->belongsTo(Category::class,'category_id');
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function tag()

    {
        #pivot 
            return $this-> belongsToMany(Tag::class,PostTag::class,'post_id');
    }

    use HasFactory;
}
