<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tag Managenent') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">          
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="grid grid-cols-6 w-full gap-8">


                        <div class="col-span-2 p-2 border ">

                            <form   wire:submit.prevent='createTag' class="flex flex-col">


                                <label   class=" label  text-lg"> Enter new Tag</label>
                                <input type="text"  wire:model.defer='name'  class="input input-bordered"  >


                                @error('name')
                                    
                                <p class="text-red-500">
                                    {{$messsage}}
                                </p>
                                @enderror
                                 <br>
                                <div class="font-semibold text-base text-gray-500">
                                    Is app Dependancy ?
                                </div>

                                <div class="py-3 flex text-sm gap-3">
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                            <span class="label-text">True</span>
                                            <input type="radio" wire:model.defer='app_dependancy' name="ap"
                                                class="radio checked:bg-red-500" value="1" />
                                        </label>
                                    </div>
                                    <div class="form-control">
                                        <label class="label cursor-pointer">
                                            <span class="label-text">False</span>
                                            <input type="radio" wire:model.defer='app_dependancy' name="ap"
                                                class="radio checked:bg-blue-500" value="0" checked />
                                        </label>
                                    </div>




                                </div>



                                <button class="btn w-full " type="submit"> Create</button>

                            </form>


                        </div>


                        <div class="col-span-4 p-3 border ">

                            <div class="text-xl font-bold">
                                Tags List 
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



                            <section>


                                <div class="grid grid-cols-3 py-4 gap-5">

 
                                    @foreach ($tags as $tag)
                                       
                            
                                    <div class="flex flex-col border h-12 rounded-md text-center flex  relative   justify-center">
                                        <div class="">
                                            {{$tag->name}}
                                        </div>

                                        @if ($tag->app_dependancy)
                                            
                                        <button class="absolute right-1 y-auto text-red-500  text-sm font-bold">A.D</button>

                                        @else

                                        <button wire:click='deleteTag({{$tag->id}})' class="absolute right-2 my-auto hover:text-red-500  font-bold">X</button>

                                        @endif

 
                                    </div>
                                   

                                    @endforeach

                                </div>


                            </section>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>