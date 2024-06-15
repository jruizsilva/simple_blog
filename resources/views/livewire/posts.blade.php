<div class="p-5">
    <div class="flex justify-between gap-4">
        <div class="flex-1">
            <x-input class="w-full" placeholder="Busca un post" wire:model.live='search' />
        </div>
        <button type="button" wire:click="createPost.open = true"
            class="inline-flex items-center px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-transparent rounded-lg whitespace-nowrap gap-x-2 hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Agregar post
        </button>
    </div>
    @if ($posts->count())
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
                                @foreach ($posts as $post)
                                    <tr class="hover:bg-gray-100">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $post->id }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-800 whitespace-nowrap">
                                            {{ $post->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap text-end">
                                            <button type="button" wire:click=""
                                                class="inline-flex items-center text-sm font-semibold text-blue-600 border border-transparent rounded-lg gap-x-2 hover:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Editar</button>
                                            <button type="button" wire:click=""
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
    @else
        <div class="mt-4">No se encontraron resultados</div>
    @endif
    {{ $posts->links() }}

    <form wire:submit='save'>
        <x-dialog-modal wire:model='createPost.open'>
            <x-slot name="title">
                Crear post
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model.live='createPost.name' />
                    <x-input-error for="createPost.name" />
                </div>
                <div class="mb-4">
                    <x-label>Categoría</x-label>
                    <x-select class="w-full" wire:model.live='createPost.category_id'>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="createPost.category_id" />
                </div>
                <div class="mb-4">
                    <x-label>Status</x-label>
                    <div class="flex gap-2">
                        <x-label>
                            <x-input type="radio" value="1" wire:model="createPost.status" />Borrador
                        </x-label>
                        <x-label>
                            <x-input type="radio" value="2" wire:model="createPost.status" />Publicado
                        </x-label>
                    </div>
                    <x-input-error for="createPost.status" />
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul class="grid grid-cols-3">
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox wire:model="createPost.tags" value="{{ $tag->id }}" />
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="createPost.tags" />
                </div>
                <div class="mb-4">
                    <x-label>Extracto</x-label>
                    <x-textarea class="w-full min-h-20" wire:model="createPost.extract"></x-textarea>
                    <x-input-error for="createPost.extract" />
                </div>
                <div class="mb-4">
                    <x-label>Cuerpo del post</x-label>
                    <x-textarea class="w-full min-h-20" wire:model="createPost.body"></x-textarea>
                    <x-input-error for="createPost.body" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="submit">Crear post</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>


</div>