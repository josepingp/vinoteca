@props(['wine'])

<img src="{{ $wine->imageUrl() }}" alt="{{ $wine->name }}"
    class="object-cover w-full rounded-t-lg md:w48 md:h-auto md:rounded-l-lg">