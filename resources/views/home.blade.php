<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Push Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                    <form method="GET" action="{{ route('home') }}">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search posts" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Search</button>
                    </form>
                    
                    <div class="grid grid-cols-1 gap-4  lg:grid-cols-3 my-10">
                        @forelse ( $posts as $post)
                                <a href="{{ route("post.show",$post->id) }}" class=" cursor-pointer lg:w-80 w-full h-36 p-4 shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100 border border-gray-900 dark:border-gray-500 flex flex-col  justify-between">
                                    <h2 class=" text-xl">{{ \Illuminate\Support\Str::limit($post->title , 10) }}</h2>
                                    <p class="text-base">{{ \Illuminate\Support\Str::limit($post->body , 100) }}</p> <!-- Truncates the body to 100 characters -->
                                    <p class=" text-xs font-light">Written by {{ \Illuminate\Support\Str::limit($post->user->name , 10) }}</p>
                                    <p class="text-xs font-light" >Comments: {{ $post->comments->count() }}</p>
                                </a>
                        @empty
                            No posts created yet....
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                
                
            </div>
        </div>
    </div>
</x-guest-layout>
