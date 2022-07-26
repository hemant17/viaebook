<div class="py-12">
    <div class="flex py-12 items-center justify-center bg-gradient-to-bl from-violet-900 to-teal-400">
        @foreach ($products as $product)
        <div class="p-2  cursor-pointer rounded-3xl  transition duration-300 ease-in-out hover:scale-105 hover:drop-shadow-2xl">
            <div class=" transform">
                <img class="mx-auto h-64" src="{{ Storage::url($product->product_data['id']) }}.png" alt="{{ $product->product_data['title'] }}" title="{{ $product->product_data['title'] }}"  loading="lazy">
            </div>
        </div>
        @endforeach
    </div>
</div>
