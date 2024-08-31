@props(['wine'])

<img src="{{ $wine->image_url }}" alt="{{ $wine->name }}"
    class="object-cover w-full rounded-t-lg md:w-48 md:h-auto  md:rounded-l-lg ">
