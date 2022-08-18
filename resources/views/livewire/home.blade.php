
<div>
 

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

                                    Category : {{$post->category->name }}
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
                        <a href=" {{route('search', $category->id )}} ">
                        
                          <div class="px-4 py-3 p-2 rounded-lg border hover:ring hover:ring-offset-2 cursor-pointer ">
                            {{$category->name}} 
                          </div>
                        </a>

                        @endif
                      


                        @endforeach

                        

                    </div>

    

                    <div class="text-xl py-9 font-bold">
                        Categories by parent
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 ">

                        @foreach ($categories as $category)
                            

                        @if ($category->children->count())
                        <a href=" {{route('search', $category->id )}} ">
                        <div class="px-4 py-3 p-2 rounded-lg border hover:ring hover:ring-offset-2 cursor-pointer ">
                            {{$category->name}} 
                        </div>

                        </a>
                        @endif
                      


                        @endforeach

                        

                    </div>



                    <div class="text-xl py-9 font-bold">
                        Recommended Posts
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 w-full px-8 gap-7">


                        @foreach ($recommendedPosts as $post)
                        <div class="">

                            <img src=" {{$post->cover}} " alt="" class="h-48  w-full rounded-lg border">


                            <div class="w-full flex flex-col">

                                <div class="text-base">
                                    {{$post->title}}
                                </div>

                                <div class="text-xs text-gray-500">

                                    Category : {{$post->category->name }}
                                </div>
                            </div>
                        </div>
                        @endforeach

                       




                    </div>




                </div>

            </div>
        </div>
    </div>

</div>
