<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('widgets') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg ">
                <div class="flex items-center px-4 py-3 text-right sm:px-6">
                    <x-jet-button wire:click="$set('visibleModalForm', true)">
                        {{ __('Add Widget') }}
                    </x-jet-button>
                </div>
                <!-- Datatables -->
                <table class="w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                ID</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                Name</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                Created at</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                Updated at</th>
                            <th
                                class="px-6 py-3 bg-gray-100 text-center text-sm leading-4 font-medium text-gray-500 upercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if ($widgets->count())
                            @foreach ($widgets as $Widget)
                                <tr>
                                    <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                        {{ $Widget->id }}</td>
                                    <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                        {{ $Widget->name }}</td>
                                    <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                        {{ $Widget->created_at }}</td>
                                    <td class="px-6 py-4 text-center text-base whitespace-no-wrap">
                                        {{ $Widget->updated_at }}</td>
                                    <td class="px-6 py-4 text-center text-base">
                                        <x-jet-button wire:click="showUpdateModal({{ $Widget->id }})">
                                            {{ __('Update') }}
                                        </x-jet-button>
                                        <x-jet-danger-button class="ml-2"
                                            wire:click="showDeleteModal({{ $Widget->id }})"
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
                <div class="p-6">
                    {{ $widgets->links() }}
                </div>
            </div>
        </div>
    </div>


    <!-- Show Modal -->
    <x-jet-dialog-modal wire:model="visibleModalForm">
        <x-slot name="title">
            {{ __('Form Add Widget') }}
        </x-slot>
        <x-slot name="content">
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Widget Name') }}" />
                <x-jet-input type=" text" class="mt-1 block w-3/4" placeholder="{{ __('Widget Name') }}"
                    wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('visibleModalForm',false)">
                {{ __('Cancel') }}
            </x-jet-secondary-button>
            @if ($modelId)
                <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                    {{ __('Update Widget') }}
                </x-jet-danger-button>
            @else
                <x-jet-danger-button class="ml-2" wire:click="createOrUpdate" wire:loading.attr="disabled">
                    {{ __('Add Widget') }}
                </x-jet-danger-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

    <!-- Show Delete Modal -->
<x-jet-dialog-modal wire:model="confirmDeleteModal">
    <x-slot name="title">
        {{ __('Delete Widget') }}
    </x-slot>
    <x-slot name="content">
        {{ __('Are you sure you want to delete this Product Widget data ? Once your data is deleted,all of its resources and data will be permanently deleted.') }}
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
