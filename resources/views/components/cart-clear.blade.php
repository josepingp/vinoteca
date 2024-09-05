@props(['action'])

<form action="{{ $action }}" method="POST" class="inline ms-2">
    @csrf

    <button type="submit"
        class="bg-red-500 hover:bg-red-700 text-white font-bold p-2 rounded mb-2 md:mb-0 text-center text-xs">
        {{ __('Vaciar carrito') }}
    </button>
</form>
