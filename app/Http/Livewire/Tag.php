<?php

namespace App\Http\Livewire;

use App\Models\Tag as ModelsTag;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

use Illuminate\Support\Str;


class Tag extends Component
{

    public $name;
    public $app_dependancy;

    protected $rules = [
        'name' => 'required|unique:tags',
        'app_dependancy' => 'required',
    ];


    public function createTag()
    {
        $this->validate();


        $slug = Str::slug($this->name);

        // dd([


        //     'name'=>$this->name,
        //     'slug'=>$slug,
        //     'app_dependancy'=>$this->app_dependancy

        // ]);


        ModelsTag::create([

            'name' => $this->name,
            'slug' => $slug,
            'app_dependancy' => $this->app_dependancy


        ]);

        $this->reset('name');
        # code...
    }


    public function deleteTag($tagId)
    {
        $tag = ModelsTag::find($tagId);


        #check if tag has got children
        if (count($tag->post)) {

           return  Session()->flash('error', 'Tag Cannot be deleted because it has posts');

        } else {

            ModelsTag::destroy($tagId);
           return Session()->flash('success', 'Tag has been deleted');
        }



        # code...
    }

    public function render()
    {
        $this->tags = ModelsTag::all();
        $this->app_dependancy = 0;

        return view('livewire.tag');
    }
}
