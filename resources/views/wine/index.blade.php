<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vinos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('wines.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        {{ __('Crear vino') }}
                    </a>

                    @if ($wines->isNotEmpty())


                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            @foreach ($wines as $wine)
                                <x-wine-image :wine="$wine"></x-wine-image>

                                <div class="flex flex-col p-4 leading-normal">
                                    <x-wine-name-and-category :wine="$wine"></x-wine-name-and-category>
                                </div>

                                <div class="border-b border-gray-300 dark:border-gray-600 mb-3"></div>

                                <x-wine-info :wine="$wine"></x-wine-info>

                                <div class="absolute bottom-0 right-0 p-4 flex justify-between">
                                    <a href="{{ route('wines.edit', $wine) }}"
                                        class="bg-blue-500
                                                hover:bg-blue-700 text-white font-bold p-1 rounded mb-2 md:mb-0
                                                text-center">
                                        {{ __('Editar') }}
                                    </a>

                                    <form action="{{ route('wines.destroy', $wine) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold p-1
                                                    rounded mb-2 md:mb-0 text-center">
                                            {{ __('Eliminar') }}
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-4 bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">!Lo siento!</strong>
                            <span class="block sm:inline"> No hay vinos creados.</span>
                        </p>
                </div>
                @endif ($wines->isNotEmpty())
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
