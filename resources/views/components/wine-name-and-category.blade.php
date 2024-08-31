@props(['wine'])

<h5 class="text-2xl font-bold tracking-tight text-gray-900 mb-2 dark:text-white">
    {{ $wine->name }}
    <span class="text-sm text-gray-500 dark:text-gray-400 font-normal">
        {{ __('Categoría') }}: {{ $wine->category->name }}
    </span>
</h5>
