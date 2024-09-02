@props(['item', 'action', 'hidden_key'])

<form action="{{ $action }}" method="POST" class="inline ms-2">
    @csrf

    <input type="hidden" name="wine_id" value="{{ data_get($item, 'hidden_key') }}">

    <button type="submit"
        class="bg-green-500 hover:bg-green-700 text-white font-bold p-1 rounded mb-2 md:mb-0 text-center text-xs">
        +
    </button>
</form>
