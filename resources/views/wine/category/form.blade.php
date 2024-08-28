<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)

                    <div class="mb-4">
                        <label for="name"
                            class="block mb-2 text-sm text-gray-700 dark:text-white font-bold">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none mb-2">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                        <label for="image"
                            class="block mb-2 text-sm text-gray-700 dark:text-gray-300 font-bold">Imagen</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline dark:text-gray-300 focus:outline-none text-gray-700 pb-4">
                        @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="description"
                            class="block mb-2 text-sm text-gray-700 dark:text-white font-bold">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none">
            {{ old('description', $category->description) }}
        </textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <button href="{{ route('categories.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancelar') }}
                        </button>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            {{ $submit }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
