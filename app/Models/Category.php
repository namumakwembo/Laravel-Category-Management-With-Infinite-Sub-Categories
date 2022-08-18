<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=['name','parent_id','slug','app_dependancy','can_have_children'];

    protected $casts=[

        'app_dependancy'=>'boolean',
        'can_have_children'=> 'boolean',

    ];


    public function parent()
    {

        return $this->belongsTo(Self::class, 'parent_id')->where('parent_id',null);
        # code...

    }

    public function children()
    {
        return $this->hasMany(Self::class,'parent_id')->where('parent_id','!=',null);
        # code...
    }

 public function posts()
 {
    return $this->hasMany(Post::class, 'category_id');
 }
 

 public function getparent($var)
 {

    $parent = Self::find($var->parent_id);

    if($parent->parent_id){

        $this->getparent($parent);


    }

    echo ' <span class=" text-sm"> '.$parent->name .' > </span> ';


    # code...
 }
 


    use HasFactory;
}
