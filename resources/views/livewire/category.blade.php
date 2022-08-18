<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Managenent') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="grid grid-cols-6 w-full gap-3">

                        <div class="col-span-2 p-3 border ">

                            <form wire:submit.prevent='createCategory'>

                                @if (Session::has('categoryCreated'))
                                    
                                <div class="alert alert-success shadow-lg text-white my-4">
                                    <div>
                                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                      <span>{{ Session::get('categoryCreated')}}</span>
                                    </div>
                                  </div>
                                @endif
                                <label for="category " class="label text-lg">Enter New Category </label>

                                <input type="text" wire:model='name' class="input input-bordered">

                                @error('name')
                                    <p class="text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror

                                <br> <br><br>

                                <div class="font-semibold text-base text-gray-500">
                                    Can Have Children ?
                                </div>

                                <div class="py-3 flex text-sm gap-3">
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                            <span class="label-text">True</span>
                                            <input type="radio" wire:model='can_have_children' name="radio-6"
                                                class="radio checked:bg-red-500" value="1" />
                                        </label>
                                    </div>
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                            <span class="label-text">False</span>
                                            <input type="radio" wire:model='can_have_children' name="radio-6"
                                                class="radio checked:bg-blue-500" value="0" checked />
                                        </label>
                                    </div>




                                </div>

                                <br>

                                <div class="font-semibold text-base text-gray-500">
                                    Is app Dependancy ?
                                </div>

                                <div class="py-3 flex text-sm gap-3">
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                            <span class="label-text">True</span>
                                            <input type="radio" wire:model='app_dependancy' name="ap"
                                                class="radio checked:bg-red-500" value="1" />
                                        </label>
                                    </div>
                                    
                                    
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                                        <span class="label-text">False</span>
                                                            <input type="radio" wire:model='app_dependancy' name="ap"
                                                class="radio checked:bg-blue-500" value="0" checked />
                                        </label>
                                    </div>




                                </div>

                           
                                <br><br>
                                <div class="font-semibold text-base text-gray-500">
                                    Choose parent Category
                                </div>


                                <div class="flex flex-row flex-wrap gap-3 m-2">
                                    <span wire:click='$set("parent_id",null)'
                                        class="  {{ $parent_id == null ? 'ring ring-offset-2' : '' }}  w-auto p-1 btn-ghost border px-3 text-sm border-gray-500/40 hover:bg-gray-600 hover:text-white cursor-pointer  rounded-lg">
                                        Null</span>

                                    @foreach ($categories->where('can_have_children','!=',null) as $category)
                                        <span wire:click='$set("parent_id",{{ $category->id }})'
                                            class="  {{ $parent_id == $category->id ? 'ring ring-offset-2' : '' }}   w-auto p-1 btn-ghost border px-3 text-sm border-gray-500/40 hover:bg-gray-600 hover:text-white cursor-pointer  rounded-lg">
                                            {{ $category->name }} </span>
                                    @endforeach






                                </div>





                                <br>

                                <button class="btn w-full mx-auto"> Create category </button>

                            </form>
                        </div>

                        <div class="col-span-4 p-3 border">



                            <div class="text-3xl">

                                Category list
                            </div>


                            <div class="px-7">

                                @if (Session::has('error'))
                                <div class="alert alert-error shadow-lg text-white my-4">
                                    <div>
                                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                      <span> {{Session::get('error')}}.</span>
                                    </div>
                                  </div>
                                @endif

                                @if (Session::has('success'))
                                    
                                <div class="alert alert-success shadow-lg text-white my-4">
                                    <div>
                                      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                      <span>{{ Session::get('success')}}</span>
                                    </div>
                                  </div>
                                @endif

                            </div>

                            @php

                            function loop($category, $align = 12){


                                foreach ($category->children as $key => $child) {
                                    # code...

                                    echo '

                                    <div style="margin-left:'.$align.'px" class=" relative my-1 hover:text-blue-500 ">'.
                                        ($child->children->count()? '<i class="bi bi-caret-down-fill -ml-5"></i>':'').  $child->name .'- id:'.$child->id
                                        .($child->app_dependancy?'<div class=" text-red-500 absolute font-semibold right-0 text-xs my-auto inset-y-2" > A.D </div>':'').'
                                        <button wire:click="deleteCategory('.$child->id.')" class="ml-auto absolute '.($child->app_dependancy?"hidden" :" ").' text-xs px-3 right-0 my-auto inset-y-0 ">

                                            X
                                        </button>
                                        
                                        
                                        '
                                        
                                        
                                        .' </div> ';

                                    $child->children->count()? loop($child,$align +25):'';


                                }




                            }
                            @endphp



                            <div class="flex flex-col gap-3 gap-y-3 m-6">

                                @foreach ($categories->where('parent_id',null)  as $category)

                                @if (count($category->children) != 0)

                                    <div class="bg-white border rounded-md p-2">

                                        <div
                                            class="font-semibold my-2 text-xl relative border cursor-pointer hover:text-blue-500">

                                            {!!$category->children->count()? '<i class="bi bi-caret-down-fill "></i>':'' !!}
                                            {{ $category->name }}

                                           <button wire:click='deleteCategory({{$category->id}})' class="text-red-500 text-xs right-3 my-auto inset-y-0 absolute">Drop</button>

                                             
                                        </div>

                                        <div class="p-2 my-3 grid grid-rows-2 grid-flow-col gap-3">

                                            @if ($category->children)
                                                @foreach ($category->children as $child)
                                                    <div class="pl-3 border p-1 rounded-md bg-gray-50">

                                                        <div class="relative font-medium">
                                                            {!!$child->children->count()? '<i class="bi bi-caret-down-fill "></i>':'' !!}
                                                            {{ $child->name }}

                                                  <button wire:click='deleteCategory({{$child->id}})' class="text-red-500 text-xs right-3 my-auto inset-y-0 absolute">X</button>

                                                        </div>

                                                        <div class="ml-7">

                                                            {{  $child->children->count()? loop($child,11):'' }}

                                                        </div>

                                                    </div>
                                                @endforeach
                                            @endif

                                        </div>
                                    </div>

                                    @else


                                    <div class="relative w-auto border rounded-md bg-white p-2 cursor-pointer font-semibold text-xl">
                                        {{$category->name}}

                                    <button wire:click='deleteCategory({{$category->id}})' class="text-red-500 text-xs right-3 my-auto inset-y-0 absolute">Drop</button>

                                    </div>

                                @endif

                                @endforeach

                            </div>
                       
                       
                       
                       
                        </div>

                    </section>



                </div>
            </div>
        </div>
    </div>

</div>



{{-- <div>
 

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">          
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="text-xl py-9 font-bold">
                        All posts 
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 w-full px-8 gap-7">


                        @foreach ($posts->take(8) as $post)
                        <div class="">

                            <img src=" {{$post->cover}} " alt="" class="h-48  w-full rounded-lg border">


                            <div class="w-full flex flex-col">

                                <div class="text-base">
                                    {{$post->title}}
                                </div>

                                <div class="text-xs text-gray-500">

                                    Category : {{$post->cateogry->name }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                       




                    </div>



                    <div class="text-xl py-9 font-bold">
                        Categories by least child
                    </div>


                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 ">

                        @foreach ($categories as $category)
                            

                        @if ($category->parent_id && !$category->children->count())
                        <div class="px-4 py-3 p-2 rounded-lg border hover:ring hover:ring-offset-2 cursor-pointer ">
                            {{$category->name}} 
                        </div>
                        @endif
                      


                        @endforeach

                        

                    </div>

    

                    <div class="text-xl py-9 font-bold">
                        Categories by parent
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 ">

                        @foreach ($categories as $category)
                            

                        @if ($category->children->count())
                        <div class="px-4 py-3 p-2 rounded-lg border hover:ring hover:ring-offset-2 cursor-pointer ">
                            {{$category->name}} 
                        </div>
                        @endif
                      


                        @endforeach

                        

                    </div>
                </div>

            </div>
        </div>
    </div>

</div> --}}

 
     


        {{-- $posts= Post::all();
        $this->categories= Category::with('children')->get();

        return view('livewire.home',['posts'=>$posts]); --}}
     
 
