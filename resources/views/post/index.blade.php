<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                 <div class=" dark:bg-slate-900 bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
                    <div class="flex lg:justify-end mb-5">
                        <a href="/posts/create" class="py-2 px-6 bg-indigo-500 hover:bg-indigo-800 text-white rounded-lg" >Create</a>
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        
                        <div class="mx-auto max-w-7xl px-6 lg:px-8 my-4">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-2 text-center lg:grid-cols-3">
                            <div class="mx-auto flex max-w-xs flex-col gap-y-1 border border-gray-600 dark:border-gray-300 py-4 w-full  lg:w-[400px] rounded">
                                <dt class="text-base leading-7 text-gray-600 dark:text-gray-300">Total Posts</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-300 sm:text-5xl">{{ $posts->count() }}</dd>
                            </div>
                            <div class="mx-auto flex max-w-xs flex-col gap-y-1 border border-gray-600 dark:border-gray-300 py-4 w-full  lg:w-[400px] rounded">
                                <dt class="text-base leading-7 text-gray-600 dark:text-gray-300">Total Comments</dt>
                                <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 dark:text-gray-300 sm:text-5xl">{{ $totalCommentsCount }}</dd>
                            </div>
                            
                            </dl>
                        </div>
                        
                    </div>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                     @if ($posts->count() > 0)
                         
                        <table  class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        S/N
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Body
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Comments
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($posts as $index => $post )
                                
                                <tr  class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                      {{  $index + 1 }}
                                    </th>
                                    <td class="px-6 py-4">
                                       {{ $post->title }}
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        {{ \Illuminate\Support\Str::limit($post->body , 100)}}
                                    </td>
                                    <td class="px-6 py-4">
                                         {{ $post->comments->count() }}
                                    </td>
                                    <td class="px-6 py-4 ">
                                        <div class="flex gap-1 items-center">

                                            <a href="{{ route('posts.edit',$post->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                            |
                                            <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                
                                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline border-0">Delete</button>
                                            </form>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                            
                            </tbody>
                        </table>
                     @else

                        <h2 class="text-gray-800 dark:text-white text-xl text-center"  >No data found...</h2>
                     @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
