<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Small</span>
                </div>
                <input type="text" class="form-control" aria-label="Nombre" aria-describedby="inputGroup-sizing-sm">
                </div>
            <h1>{{$result['resultado']}}</h1>
            <h1>{{$result['nombre']}}</h1>
            </div>
        </div>
    </div>
</x-app-layout>