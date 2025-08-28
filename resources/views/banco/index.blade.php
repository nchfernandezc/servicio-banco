<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bancos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">{{ __('Listado de Bancos') }}</h1>
                            <p class="mt-2 text-sm text-gray-700">{{ __('Registros') }}</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('bancos.create') }}" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"><x-typ-plus class="w-4 h-4 mr-1 inline-block"/>Agregar nuevo</a>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Nombre</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tipo De Cuenta</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Numero De Cuenta</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Moneda</th>
                                        
                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($bancos as $banco)
                                        <tr class="even:bg-gray-50">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                            
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $banco->nombre }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ ucfirst($banco->tipo_cuenta) }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $banco->numero_cuenta }}</td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ ucfirst($banco->moneda) }}</td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <a href="{{ route('bancos.show', $banco->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">
                                                    <x-bx-show class="w-4 h-4 mr-1 inline-block"/> {{ __('Show') }}
                                                </a>
                                                <a href="{{ route('bancos.edit', $banco->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900 mr-2">
                                                    <x-feathericon-edit class="w-4 h-4 mr-1 inline-block"/> {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('bancos.destroy', $banco->id) }}" method="POST" class="form-delete" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 font-bold hover:text-red-900 mr-2">
                                                        <x-monoicon-delete class="w-4 h-4 mr-1 inline-block"/> {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4 px-4">
                                    {!! $bancos->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

