<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{



    protected $fillable=[
              'name','slug','app_dependancy'
    ];



    protected $casts=[
       
        'app_dependancy'=>'boolean',
    ];


    public function post()
    {
         #pivot 
        return $this-> belongsToMany(Post::class,PostTag::class,'tag_id');
    }



    use HasFactory;
}
