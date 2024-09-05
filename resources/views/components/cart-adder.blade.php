@props(['wine', 'action'])

<form action="{{ $action }}" method="POST">
    @csrf

    <input type="hidden" name="wine_id" value="{{ data_get($wine, 'id') }}">

    <button type="submit"
        class="bg-green-500 hover:bg-green-700 text-white font-bold p-1 rounded mb-2 md:mb-0 text-center text-xl">
        {{ __('Anadir al carrito') }}
    </button>
</form>
