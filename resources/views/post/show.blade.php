<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Title: $post->title") }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="my-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-10">
                <div class="">
                    <p class="text-xl">{{$post->body}}</p>
                </div>
            </div>
            <div class="my-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100 flex flex-col gap-10">
                    <div class="">
                        <h2 class="text-lg mb-3" >Comments</h2>
                        @auth
                            <form method="POST" action="{{ route("posts.comments.store",$post->id) }}">
                                @csrf
                                    
                                    <div class="mb-3">
                                        <x-input-label  class=""></x-input-label>
                                        <textarea  
                                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm  w-full" 
                                        type="text" name="body" value="" required autofocus rows="2" ></textarea>
                                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
                                    </div>
                                
                                    <div class="mb-3">
                                        <x-primary-button type="submit" class="" spinner>Submit</x-primary-button>
                                    </div>
                            </form>
                        @endauth
                    </div>

                    <div class="">
                        
                        <ul>
                            @forelse ( $post->comments as $post)
                                    <li  class=" my-1 cursor-pointer  p-4 shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 ">
                                        
                                        <p class="text-lg">{{ \Illuminate\Support\Str::limit($post->body , 100) }}</p> <!-- Truncates the body to 100 characters -->
                                        <p class=" text-xs font-light">Written by {{ \Illuminate\Support\Str::limit($post->user->name , 10) }}</p>
                                        
                                    </li>
                                
                            @empty
                                No comments created yet....
                            @endforelse
                        </ul>
                    </div>
            </div>
        </div>
    </div>
</x-guest-layout>
