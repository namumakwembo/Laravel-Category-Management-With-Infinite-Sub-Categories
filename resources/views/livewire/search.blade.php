<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">          
                <div class="p-6 bg-white border-b border-gray-200">

 
                    <div class="text-xl py-9 font-bold">
                        Category: All {{ \illuminate\Support\Str::plural($this->category->name) }} 
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 w-full px-8 gap-7">

                        @foreach ($collection as $array)
                            
                        @foreach ($array as $post)
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

                        @endforeach
                       




                    </div>

              

                </div>
            </div>
        </div>
    </div>

</div>