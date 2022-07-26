<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden  sm:rounded-lg ">
            <div class="  grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-4  gap-8">
                @foreach ($productData['products'] as $product)
                    <x-product :product="$product" :cart="$cart" />
                @endforeach
            </div>
        </div>
    </div>
</div>
