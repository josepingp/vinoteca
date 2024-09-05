<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tienda de vinos') }}
        </h2>
    </x-slot>

    @inject('cart', 'App\Services\Cart')

    <div class="py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($wines as $wine)
                        <div
                            class="flex relative items-center flex-col bg-white border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <x-wine-image :wine="$wine" />
                            <div class="p-4 flex flex-col leading-normal">
                                @if ($cart->hasProduct($wine))
                                    <div
                                        class="bg-green-500 text-white text-xs font-bold uppercase px-5 py-2 mb-2 rounded-full">
                                        <p class="font-normal mb-2">
                                            {{ __('En el carrito') }}: {{ $cart->getTotalQuantityForWine($wine) }}
                                            {{ __('unidades') }}
                                        </p>
                                        <p class="font-normal">
                                            {{ __('Total') }}: {{ $cart->getTotalCostForWine($wine, true) }}
                                        </p>
                                    </div>

                                    <div class="border-b border-gray-300 dark:border-gray-600 mb-3"></div>
                                @endif

                                <x-wine-name-and-category :wine="$wine" />

                                <div class="mb-1"></div>

                                <x-wine-info :wine="$wine" />
                            </div>

                            <div class="absolute bottom-0 right-0 p-4 flex justify-between">
                                @if (!$cart->hasProduct($wine))
                                    <x-cart-adder :wine="$wine" :action="route('shop.addToCart')" />
                                @else
                                    <div class="flex">
                                        {{-- {{ ray($wine) }} --}}
                                        <x-cart-incrementor :item="$wine" :action="route('shop.increment')" :hidden_key="'id'" />
                                        <x-cart-decrementor :item="$wine" :action="route('shop.decrement')" :hidden_key="'id'" />
                                        <x-cart-remover :item="$wine" :action="route('shop.remove')" :hidden_key="'id'" />
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
