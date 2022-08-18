<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class Category extends Component
{

    public $name;
    public $app_dependancy=0;
    public $can_have_children=0;
    public $parent_id;

    protected $rules=['name'=>'required|unique:categories'];

    public function createCategory()
    {
        # code...

        $this->validate();


        ModelsCategory::create([

            'name'=>$this->name,
            'parent_id'=> $this->parent_id,
            'slug'=> Str::slug($this->name),
            'can_have_children'=>$this->can_have_children,
            'app_dependancy'=>$this->app_dependancy,

        ]);

        $this->reset(['name','parent_id','can_have_children','app_dependancy']);


       // dd('Category created');
        //dd([$this->name,$this->can_have_children,$this->app_dependancy,$this->category_id]);

        return Session()->flash('categoryCreated','Category Successfully Created');

    }

    public function deleteCategory($categoryId)
    {
       
       // dd($categoryId);

       #get posts related to this category 
       $post = Post::firstWhere('category_id',$categoryId);

       #get the cateogry model from database
       $category = ModelsCategory::find($categoryId);

       #check if category has any childrren or has any postss
       #if true then cateogry cannot be deleted
       if ($category->children->isNotEmpty() || $post) {
      
 
        return Session()->flash('error','Category cannot be deleted because it has children or posts ');
       }
       else{

    
        ModelsCategory::destroy($categoryId);

        return Session()->flash('success','Success: Category has been deleted ');


       }
  


    }


 
    public function render()
    {
      
        $this->categories= ModelsCategory::with('children','parent')->get();

        return view('livewire.category');
    }
}
