<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post  ') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-8/12 mx-auto " style="min-height: 300px">
                <div class="p-6 bg-white border-b border-gray-200   ">

                    <form  wire:submit.prevent='createPost' class="flex flex-col gap-4">

                      <div class="dropdown dropdown-bottom px-2 dropdown-hover ">
                        <label tabindex="0" class="text-md mb-3 w-full flex text-center gap-3 border-b m-1">
                          
                          @if ($selectedCategory)
                            <span class="my-auto text-md">
                              Category:
                            </span>

                            <span class="">
                                  @if ($selectedCategory->parent_id)
                                      {{$selectedCategory->getparent($selectedCategory)}}
                                  @endif

                            </span>


                          <span class="font-bold my-auto text-xs">
                            {{$selectedCategory->name}}
                          </span>
                          @else
                          <div class="font-bold">
                            Choose category
                          </div>
                        
                          @endif




                         
                        </label>

                        <div tabindex="0" class="dropdown-content  overflow-scroll overflow-hidden rounded-md text-left  p-2 shadow-xl border bg-white p-2 shadow bg-base-100 rounded-box w-[650px] h-96">
                            
                          @php

                          function loop($category, $align = 12){


                              foreach ($category->children as $key => $child) {
                                  # code...

                                  echo '

                                  <div  '. (  $child->children->count() !=0?"":(" wire:click='setCategory(".$child->id.")' ")   )  .'
                                   style="margin-left:'.$align.'px" class=" '.($child->children->count()? 'font-semibold cursor-not-allowed text-gray-500/80 ':'hover:text-blue-500 cursor-pointer').' relative my-1  "> '.
                                      ($child->children->count()? '<i class="bi bi-caret-down-fill -ml-5"></i>':'').
                                      $child->name
                                      
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

                     
                                           
                                      </div>

                                      <div class="p-2 my-3 grid grid-rows-2 grid-flow-col gap-3">

                                          @if ($category->children)
                                              @foreach ($category->children as $child)
                                                  <div 
                                                  
                                                  @if (count($child->children)==0)
                                                  wire:click="setCategory('{{$child->id}}')"
                                                  
                                                  @endif
                                                  
                                                  class="pl-3 border p-1 rounded-md bg-gray-50">

                                                      <div class="relative  {{$child->children->count()? 'font-semibold cursor-not-allowed':'hover:text-blue-500 cursor-pointer'}} ">
                                                          {!!$child->children->count()? '<i class="bi bi-caret-down-fill "></i>':'' !!}
                                                          {{ $child->name }}

                                        
                                                      </div>

                                                      <div class="ml-7 hover:text-blue-500">

                                                          {{  $child->children->count()? loop($child,11):'' }}

                                                      </div>

                                                  </div>
                                              @endforeach
                                          @endif

                                      </div>
                                  </div>

                                  @else


                                  <div  wire:click="setCategory('{{$category->id}}')" class="relative w-auto border  hover:text-blue-500 rounded-md bg-white p-2 cursor-pointer font-semibold text-xl">
                                     
                                    {{$category->name}}

                                  
                                  </div>

                              @endif

                              @endforeach

                          </div>
                     
                     

                        </div>
                      </div>
                      

                        <div class="form-control w-full max-w-xs border-0">
                            <label class="label">
                              <span class="label-text">Title</span>
                            </label>
                            <input wire:model='title' type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                        
                          </div>

                             
                        <div class="form-control w-full max-w-xs border-0">
                            <label class="label">
                              <span class="label-text">Sub Title</span>
                            </label>
                            <input wire:model='sub_title' type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                        
                          </div>
   
                          <div class="form-control w-full max-w-xs border-0">
                            <label class="label">
                              <span class="label-text">Cover</span>
                            </label>
                            <input wire:model.defer='cover' type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
                        
                          </div>


                          <div class="text-xl font-medium p-2 py-3">
                            Tags
                          </div>


                          <div class="flex flex-row flex-wrap gap-3 m-2">
                            <span wire:click='$set("tag_id",null)'
                                class="  {{ $tag_id == null ? 'ring ring-offset-2' : '' }}  w-auto p-1 btn-ghost border px-3 text-sm border-gray-500/40 hover:bg-gray-600 hover:text-white cursor-pointer  rounded-lg">
                                Null</span>

                            @foreach ($tags as $tag)
                                <span wire:click='$set("tag_id",{{ $tag->id }})'
                                    class="  {{ $tag_id == $tag->id ? 'ring ring-offset-2' : '' }}   w-auto p-1 btn-ghost border px-3 text-sm border-gray-500/40 hover:bg-gray-600 hover:text-white cursor-pointer  rounded-lg">
                                    {{ $tag->name }} </span>
                            @endforeach

                        </div>


                        <button class="btn w-full  "> submit </button>
                    </form>




                </div>
            </div>
        </div>
    </div>

</div>
