<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Post') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class=" dark:bg-slate-900 bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                   <div class="flex  mb-5">
                        <a href="/posts" class="py-2 px-6 bg-red-500 hover:bg-red-800 text-white rounded-lg" >Back</a>
                    </div>
                   <form method="POST" action="{{ route("posts.store") }}">
                    @csrf
                        
                        <div class="mb-3">
                            <x-input-label  class="">Title</x-input-label>
                            <x-text-input  class="block  w-full" type="text" name="title" value="" required autofocus  />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div class="mb-3">
                            <x-input-label  class="">Body</x-input-label>
                            <textarea  
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm  w-full" 
                            type="text" name="body" value="" required autofocus rows="6" ></textarea>
                            <x-input-error :messages="$errors->get('body')" class="mt-2" />
                        </div>
                       
                        <div class="mb-3">
                             <x-primary-button type="submit" class="" spinner>Submit</x-primary-button>
                        </div>
                   </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
