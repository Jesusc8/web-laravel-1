<x-blog.layout.app>

    @foreach ($posts as $post)
        <div class="mb-4">
            <h2 class="text-2xl font-bold">
                <a href=" {{ route('posts.show', $post) }}" class="hover:underline">
                    {{ $post->title }}
                </a>
            </h2>
            
            <div class="flex gap-2">
                <p class="text-xs text-gray-500">
                    <span class="font-semibold"> 
                        
                        {{ $post->user->name }}

                    </span> |
                    {{  $post->category->name }} |
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        
    @endforeach

</x-blog.layout.app>
