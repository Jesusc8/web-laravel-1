<x-Blog.layout.app>
    <div class="flex items-center gap-2 w-full my-8">
        {{-- <div>&hearts;</div> --}}

        <div class="w-full">
            <h2 class="text-2xl font-bold md:text-3xl">
                {{ $post->title }}
            </h2>

            <div class="flex justify-between">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold">
                        {{ $post->user->name }}
                    </span> |
                    {{ $post->category->name }} |
                    {{ $post->created_at->diffForHumans() }}
                </p>

                <div class="flex items-center gap-2">
                    <a href="#" class="text-xs font-semibold hover:underline">
                        Edit
                    </a>
                    
                    <form action="#" onsubmit="return confirm('¿Estás seguro de eliminar esta pregunta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-md bg-red-600 hover:bg-red-500 px-2 py-1 text-xs font-semibold text-white cursor-pointer">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="my-4">
        <p class="text-gray-200">
            {{ $post->description }}
        </p>

        <ul class="space-y-4">
        @foreach ($post->comments as $post)
        <li>
            <div class="flex items-start gap-2">
                {{-- <div>&hearts;</div> --}}

                <div>
                    <p class="text-sm text-gray-300">
                        {{ $post->content }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $post->user->name }} | 
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                    
                    <!-- Comments -->
                </div>
            </div>  
        </li>
        @endforeach
    </ul>     
    </div>
    
    {{-- <ul class="space-y-4">
        @foreach ($post->comments as $post)
        <li>
            <div class="flex items-start gap-2">
                <div>&hearts;</div>

                <div>
                    <p class="text-sm text-gray-300">
                        {{ $post->content }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $post->user->name }} | 
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                    
                    <!-- Comments -->
                </div>
            </div>  
        </li>
        @endforeach
    </ul> --}}
</x-Blog.layout.app>
