<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Carrito') }}
        </h2>
    </x-slot>

    @inject('cart', 'App\Services\Cart')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        @if ($cart->isEmpty())
                            <p class="
                            bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                {{ __('No hay productos en el carrito') }}</p>
                        @else
                            <table class="w-full whitespace-nowrap">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Nombre') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Precio') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Cantidad') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            {{ __('Total') }}
                                        </th>
                                        <th
                                            class="px-6 py-3 text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider text-center">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cart->getCart() as $item)
                                        <tr class="border-b dark:border-gray-700 border-gray-200">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <img src="{{ data_get($item, 'product.image_url') }}"
                                                            alt="{{ data_get($item, 'product.name') }}"
                                                            class="h-10 w-10 object-cover">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div
                                                            class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                            {{ data_get($item, 'product.name') }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                                            {{ data_get($item, 'product.category.name') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ data_get($item, 'product.formatted_price') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ data_get($item, 'quantity') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $cart->getTotalCostForWine(data_get($item, 'product'), true) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap justify-center flex">
                                                <div class="text-sm text-gray-900 dark:text-gray-100">
                                                    <x-cart-incrementor :item="$item" :action="route('cart.increment')"
                                                        :hidden_key="'product.id'" />

                                                    <x-cart-decrementor :item="$item" :action="route('cart.decrement')"
                                                        :hidden_key="'product.id'" />

                                                    <x-cart-remover :item="$item" :action="route('cart.remove')"
                                                        :hidden_key="'product.id'" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap"></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100 text-center">
                                                {{ $cart->getTotalQuantity() }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100 ">
                                                {{ $cart->getTotalCost(true) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-gray-100 text-center">
                                                <x-cart-clear :action="route('cart.clear')" />
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
