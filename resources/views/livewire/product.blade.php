<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="flex items-center px-4 py-3 text-right sm:px-6">
                    <x-jet-button wire:click="showModal">
                        {{ __('Add Product') }}
                    </x-jet-button>
                </div>
                <!-- Datatables -->

                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                    Widget</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($products->count())
                                @foreach ($products as $item)
                                    <tr>
                                        <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                            {{ $item->name }}</td>
                                        <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                            {{ $item->widget->name }}</td>
                                        <td class="px-6 py-4 text-center text-base whitespace-no-wrap ">
                                            @isset($item->product_data) 
                                                {{-- @dump($item->product_data['id']) --}}
                                                <img src="{{ Storage::url($item->product_data['id']) }}.png" class="w-7 m-auto" />
                                            @else
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif?20170503175831 " class="w-7 m-auto" />
                                            @endisset
                                        </td>
                                        <td class="px-6 py-4 text-center text-base">
                                            <x-jet-button wire:click="showUpdateModal({{ $item->id }})">
                                                {{ __('Update') }}
                                            </x-jet-button>
                                            <x-jet-danger-button class="ml-2"
                                                wire:click="showDeleteModal({{ $item->id }})"
                                                wire:loading.attr="disabled">
                                                {{ __('Delete') }}
                                            </x-jet-danger-button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="px-6 py-4 text-center text-base whitespace-no-wrap" colspan="4">No
                                        Result Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $products->links() }}
        <!-- Show Modal -->
        <x-jet-dialog-modal wire:model="visibleModalForm">
            <x-slot name="title">
                {{ __('Form Add Product') }}
            </x-slot>
            <x-slot name="content">
                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Product ID') }}" />
                    <x-jet-input type="text" class="mt-1 block w-3/4" placeholder="{{ __('Product ID') }}"
                        wire:model="data.name" />
                    <x-jet-input-error for="data.name" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-jet-label for="widget_id" value="{{ __('Widget') }}" />
                    <select wire:model.defer="data.widget_id"
                        class="js-example-basic-single mt-1 block w-3/4 form-control border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option selected>-- Choice widgets --</option>
                        @if ($widgets)
                            @foreach ($widgets as $cat)
                                @if ($cat->id == $widget_id)
                                    <option value="{{ $cat->id }}" selected>{{ $cat->name }}</option>
                                @else
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                    <x-jet-input-error for="data.widget_id" class="mt-2" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('visibleModalForm')">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                @if ($modelId)
                    <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                        {{ __('Update Product') }}
                    </x-jet-danger-button>
                @else
                    <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                        {{ __('Add Product') }}
                    </x-jet-danger-button>
                @endif
            </x-slot>
        </x-jet-dialog-modal>
        <!-- Show Delete Modal -->
        <x-jet-dialog-modal wire:model="confirmDeleteModal">
            <x-slot name="title">
                {{ __('Delete Product') }}
            </x-slot>
            <x-slot name="content">
                {{ __('Are you sure you want to delete this Product data ? Once your data is deleted, all of its resources and data will be permanently deleted.') }}
            </x-slot>
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmDeleteModal')">
                    {{ __('Cancel') }}
                </x-jet-secondary-button>
                <x-jet-danger-button class="ml-2" wire:click="delete" wire:loading.attr="disabled">
                    {{ __('Delete') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
