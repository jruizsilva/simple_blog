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
                                            <button type="button" wire:click="edit({{ $post }})"
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
                        <option value="" disabled selected>Seleccione una categoria</option>
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
                <div class="grid grid-cols-1 gap-2 mb-4 sm:grid-cols-3">
                    <div>
                        @if ($createPost->image)
                            <img class="h-32" src="{{ $createPost->image->temporaryUrl() }}" />
                        @else
                            <img class="h-32" src="{{ Storage::url('full-moon.jpg') }}" />
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <x-label>Imagen que se mostrará en el post</x-label>
                        <div class="max-w-sm">
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" wire:model="createPost.image" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none ">
                            </label>
                        </div>
                    </div>
                    <x-input-error for="createPost.image" />
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

    <form wire:submit='update'>
        <x-dialog-modal wire:model='editPost.open'>
            <x-slot name="title">
                Editar post
            </x-slot>
            <x-slot name="content">
                <div class="mb-4">
                    <x-label>Nombre</x-label>
                    <x-input class="w-full" wire:model.live='editPost.name' />
                    <x-input-error for="editPost.name" />
                </div>
                <div class="mb-4">
                    <x-label>Categoría</x-label>
                    <x-select class="w-full" wire:model.live='editPost.category_id'>
                        <option value="" disabled selected>Seleccione una categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="editPost.category_id" />
                </div>
                <div class="mb-4">
                    <x-label>Status</x-label>
                    <div class="flex gap-2">
                        <x-label>
                            <x-input type="radio" value="1" wire:model="editPost.status" />Borrador
                        </x-label>
                        <x-label>
                            <x-input type="radio" value="2" wire:model="editPost.status" />Publicado
                        </x-label>
                    </div>
                    <x-input-error for="editPost.status" />
                </div>
                <div class="mb-4">
                    <x-label>Etiquetas</x-label>
                    <ul class="grid grid-cols-3">
                        @foreach ($tags as $tag)
                            <li>
                                <label>
                                    <x-checkbox wire:model="editPost.tags" value="{{ $tag->id }}" />
                                    {{ $tag->name }}
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="editPost.tags" />
                </div>
                <div class="grid grid-cols-1 gap-2 mb-4 sm:grid-cols-3">
                    @php
                        // $url;
                        // if ($editPost->image) {
                        //     if (str_contains($editPost->image->url, 'http')) {
                        //         $url = $editPost->image->url;
                        //     } else {
                        //         $url = Storage::url($editPost->image->url);
                        //     }
                        // } else {
                        //     $url = Storage::url('full-moon.jpg');
                        // }
                    @endphp
                    <div>
                        @if ($editPost->image)
                            <img class="h-32" src="{{ $editPost->image->temporaryUrl() }}" />
                        @elseif ($editPost->image_preview)
                            <img class="h-32" src="{{ Storage::url($editPost->image_preview->url) }}" />
                        @else
                            <img class="h-32" src="{{ Storage::url('full-moon.jpg') }}" />
                        @endif
                    </div>
                    <div class="sm:col-span-2">
                        <x-label>Imagen que se mostrará en el post</x-label>
                        <div class="max-w-sm">
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" wire:model="editPost.image" accept="image/*"
                                    class="block w-full text-sm text-gray-500 file:me-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 file:disabled:opacity-50 file:disabled:pointer-events-none ">
                            </label>
                        </div>
                    </div>
                    <x-input-error for="editPost.image" />
                </div>
                <div class="mb-4">
                    <x-label>Extracto</x-label>
                    <x-textarea class="w-full min-h-20" wire:model="editPost.extract"></x-textarea>
                    <x-input-error for="editPost.extract" />
                </div>
                <div class="mb-4">
                    <x-label>Cuerpo del post</x-label>
                    <x-textarea class="w-full min-h-20" wire:model="editPost.body"></x-textarea>
                    <x-input-error for="editPost.body" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button type="submit">Actualizar post</x-button>
            </x-slot>
        </x-dialog-modal>
    </form>

</div>
