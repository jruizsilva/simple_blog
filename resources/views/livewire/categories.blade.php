<div class="p-5">
    <button type="button" wire:click="createCategory.open = true"
        class="inline-flex items-center px-3 py-2 mb-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
        Agregar categoría
    </button>
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Id
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">

                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                        {{ $category->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                        <button type="button" wire:click="edit({{ $category->id }})"
                                            class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Editar</button>
                                        <button type="button" wire:click="confirmDelete({{ $category->id }})"
                                            class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $categories->links() }}

    <form wire:submit='save'>
        <x-dialog-modal wire:model='createCategory.open'>
            <x-slot name="title">
                Crear categoría
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model.live='createCategory.name' />
                    <x-input-error for="createCategory.name" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="submit">Crear categoría</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>

    <form wire:submit='update'>
        <x-dialog-modal wire:model='editCategory.open'>
            <x-slot name="title">
                Editar categoría
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model.live='editCategory.name' />
                    <x-input-error for="editCategory.name" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="submit">Actualizar categoría</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>

    <x-dialog-modal wire:model='open'>
        <x-slot name="title">
            ¿Desea eliminar la categoria?
        </x-slot>
        <x-slot name="content">
            ¿Desea eliminar la categoria?
        </x-slot>
        <x-slot name="footer">
            <x-danger-button wire:click="destroy">Si eliminar</x-danger-button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            Livewire.on('categoryUpdated', function() {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: "Actualizado correctamente",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: true,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            })
        </script>
    @endpush

    <script></script>
</div>
