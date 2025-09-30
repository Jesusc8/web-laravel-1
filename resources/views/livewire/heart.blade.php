<div>
    @auth
        <div>
            <a wire:click="toggle" class="cursor-pointer">
                @if ($heartable->isHearted())
                <span class="text-red-600">&hearts;</span>
                @else
                <span class="text-gray-600">&hearts;</span>
                @endif
            </a>

        </div>
    @else
        <div>
            <span class="text-gray-600">&hearts;</span>
        </div>
     
    @endauth

    <!-- https://heroicons.dev/ (opcional): Heart -->
</div>
