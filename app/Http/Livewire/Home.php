<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class Home extends Component
{

 
    public function render()
    {



        #get all posts from database
        $posts= Post::all();


        #get posts by tag 
        #you're free to change the tag name 'eg popular
        $this->recommendedPosts= Post::whereHas('tag',function($sq){

            $sq->where('slug','recommended-posts');


        })->get() ;
 

        #eager load categories
        $this->categories= Category::with('children')->get();

        return view('livewire.home',['posts'=>$posts]);
    }
}
