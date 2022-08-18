<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{


    //-----------------------------------------------------------------
    //-------In this componenent we get posts based on category---------------
    //----We will also get all the posts of the cateogry children -----------------


    public $query;
    public $childrenIDs = array();//a collection to merge the chidren IDs into one array



    #helper function to get category children IDs of a category parent ID
    function getChildId($category)
    {
        #food
         #- spices
           #-- black peeper
            # - peeper 2 


        #loop through all category children 
        foreach ($category->children->where('parent_id',$category->id)  as $key => $child) {
            # code...

            #array push
            array_push($this->childrenIDs,$child->id);


            $child->children->count()? $this->getChildId($child):'';

        }
    }



    public function mount()
    {

        #get the query parameter from the url
        $query= $this->query;

        # define a collection to push the models into
        $this->collection = new Collection([]);

        #Get posts from databse and merge them to the collection
        #we will use this collection again to add more models  
        $this->collection->push(

            Post::whereHas('category',function ($sq) use ($query){
                $sq->where('id',$query);

            })->get()
        );


 
        ## get original parent Category model from databse
       $this->category= Category::find($query);



       # check if origianl parent category has got any children
       if($this->category->children->count()){

        #call the helper fucntion to get IDs
        $this->getChildId($this->category);

        #loop through all the children IDs of the parent
        foreach ($this->childrenIDs as $key => $childrendId) {

            #add more models to the collection we declared earlier 
            $this->collection->push(
                Post::whereHas('category',function($sq) use ($childrendId){

                    $sq->where('id',$childrendId);

                })->get()



            );
        }

     //   dd($this->collection);



       }



        
        # code...
    }

    public function render()
    {



        return view('livewire.search');
    }
}
