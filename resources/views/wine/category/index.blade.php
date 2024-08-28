<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categorias de vinos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('categories.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Crear categoria') }}
                    </a>

                    @if ($categories->isNotEmpty())
                        <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
                            @foreach ($categories as $category)
                                <div
                                    class="flex items-center flex-col bg-white border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 relative">
                                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-48 md:rounded-none md:rounded-s-lg"
                                        src="{{ $category->image_url }}" alt="{{ $category->name }}" />

                                    <div class="flex flex-col p-4 leading-normal">
                                        <h5
                                            class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $category->name }}
                                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ __('Vinos (:count)', ['count' => $category->wines_count]) }}
                                            </span>
                                        </h5>
                                        <p class="mb-6 font-normal text-gray-700 dark:text-gray-400 pb-5">
                                            {{ $category->description }}
                                        </p>
                                        <div class="absolute bottom-0 right-0 p-4 flex justify-between">
                                            <a href="{{ route('categories.edit', $category) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold p-1 rounded mb-2 md:mb-0 text-center">
                                                {{ __('Editar') }}
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white font-bold p-1 w-full md:w-auto ms-2 rounded ">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">!Lo siento!</strong>
                            <span class="block sm:inline"> No hay categorías de vinos creadas.
                            </span>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
