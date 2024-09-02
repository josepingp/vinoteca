@props(['wine'])

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Precio unidad') }}: {{ $wine->formatted_price }}
</p>

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Cosecha') }}: {{ $wine->year }}
</p>

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ __('Stock') }}: {{ $wine->stock }} {{ __('unidades') }}
</p>

<p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
    {{ $wine->description }}
</p>
