    {{-- <div>

        <div class="card">
            <div class="card-header">
                <a class="btn btn-secondary" href="#" wire:click="$set('createCategory.open', true)">Agregar
                    categoria</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td width="10px">
                                    <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td width="10px">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <form wire:submit='save'>
            <x-dialog-modal wire:model="createCategory.open">
                <x-slot name="title">
                    Crear categoria
                </x-slot>
                <x-slot name="content">
                    content
                </x-slot>
                <x-slot name="footer">
                    footer
                </x-slot>
            </x-dialog-modal>
        </form>
    </div> --}}

    <x-admin-layout>

        <header class="bg-white shadow">
            <div class="p-4 sm:px-6 lg:px-8">
                Categorias
            </div>
        </header>
        <div class="card">
            <div class="card-header">
                <a class="btn btn-secondary" href="#" wire:click="$set('createCategory.open', true)">Agregar
                    categoria</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td width="10px">
                                    <a href="#" class="btn btn-primary btn-sm">Editar</a>
                                </td>
                                <td width="10px">
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <form wire:submit='save'>
            <x-dialog-modal wire:model="createCategory.open">
                <x-slot name="title">
                    Crear categoria
                </x-slot>
                <x-slot name="content">
                    content
                </x-slot>
                <x-slot name="footer">
                    footer
                </x-slot>
            </x-dialog-modal>
        </form> --}}
    </x-admin-layout>
