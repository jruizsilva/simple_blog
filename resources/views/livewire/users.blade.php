<div class="p-5">
    <x-input class="w-full" placeholder="Busca un usuario por nombre o por email" wire:model.live='search' />
    @if ($users->count())
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
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-start">Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium text-gray-500 uppercase text-end">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <button type="button" wire:click="edit({{ $user }})"
                                                class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Editar</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="mt-4">No se encontraron resultados</div>
    @endif
    {{ $users->links() }}

    <form wire:submit='update'>
        <x-dialog-modal wire:model='editUser.open'>
            <x-slot name="title">
                Asignar role
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" value="{{ $editUser->name }}" readonly disabled />
                    <x-input-error for="editUser.name" />
                </div>
                <div class="mb-4">
                    <x-label>Roles</x-label>
                    <ul class="flex flex-col gap-2">
                        @foreach ($roles as $role)
                            <li>
                                <x-label class="select-none">
                                    <x-checkbox value="{{ $role->id }}" wire:model="editUser.roles" />
                                    {{ $role->name }}
                                </x-label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="editUser.roles" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="submit">Asignar role</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
