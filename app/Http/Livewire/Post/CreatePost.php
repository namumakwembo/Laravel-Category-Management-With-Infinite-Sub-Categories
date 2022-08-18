<?php

namespace App\Http\Livewire\Post;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

use Illuminate\Support\Str;

class CreatePost extends Component
{

    public $tag_id;
    public $sub_title;
    public $title;
    public $cover;
    public $selectedCategory;



    public function createPost( )
    {

        // dd([


        //     'title'=>$this->title,
        //     'sub_title'=>$this->sub_title,
        //      'tag_id'=>$this->tag_id,
        //      'cover'=>$this->cover,


        // ]);

        if ($this->title && $this->selectedCategory) {
            # code...
            $createdPost= Post::create([

                'title'=>$this->title,
                'category_id'=>$this->selectedCategory->id,
                'user_id'=>auth()->user()->id,
                'slug'=> Str::slug($this->title),
                'sub_title'=>$this->sub_title,
                'cover'=>$this->cover,
    
    
            ]);


            if ($this->tag_id) {
                # code...

                PostTag::updateOrCreate(['post_id'=>$createdPost->id],['tag_id'=>$this->tag_id]);

            }


            dd('post created');

 
    



    
        }

     


        # code...
    }



    public function setCategory($varID)
    {

        $this->selectedCategory= Category::find($varID);
       
        # code...
    }



    public function render()
    {

        $this->categories= Category::all();
       $this->tags = Tag::all();
        return view('livewire.post.create-post');
    }
}
