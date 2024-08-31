<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method($method)

                    {{-- Name --}}

                    <div class="mb-4">
                        <label for="name" class="block mb-2 text-sm text-white font-bold">Nombre</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none"
                            value="{{ old('name', $wine->name) }}">
                        @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}

                    <div class="mb-4">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                            <option value="">Selecciona una categoría"</option>

                            @foreach (\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $wine->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Year --}}

                    <div class="mb-4">
                        <label for="year" class="block mb-2 text-sm text-white font-bold">Año</label>
                        <input type="number" name="year" id="year"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none"
                            value="{{ old('year', $wine->year) }}">
                        @error('year')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price --}}

                    <div class="mb-4">
                        <label for="price" class="block mb-2 text-sm text-white font-bold">Precio</label>
                        <input type="number" name="price" id="price" step="0.01"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none"
                            value="{{ old('price', $wine->price) }}">
                        @error('price')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- stock --}}

                    <div class="mb-4">
                        <label for="stock" class="block mb-2 text-sm text-white font-bold">Stock</label>
                        <input type="number" name="stock" id="stock"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline  text-gray-700 focus:outline-none"
                            value="{{ old('stock', $wine->stock) }}">
                        @error('stock')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- image --}}

                    <div class="mb-4">
                        <label for="image"
                            class="block mb-2 text-sm text-gray-700 dark:text-gray-300 font-bold">Imagen</label>
                        <input type="file" name="image" id="image"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline dark:text-gray-300 focus:outline-none text-gray-700 pb-4">
                        @error('image')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- description --}}

                    <div class="mb-4">
                        <label for="description"
                            class="block mb-2 text-sm text-gray-700 dark:text-gray-300 font-bold">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-3 py-2 leading-tight shadow appearance-none border rounded focus:shadow-outline focus:outline-none text-gray-700">{{ old('description', $wine->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}

                    <div class="mb-4">
                        <a href="{{ route('wines.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 ms-2 rounded">
                            {{ $submit }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
