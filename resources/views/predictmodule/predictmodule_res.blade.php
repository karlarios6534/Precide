<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Predict') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <h1>Resultado: {{$result['resultado']}}</h1>
            <br>
            <h1>Porcentaje de probabilidad de veracidad: {{$result['porcentaje']}}</h1>
        </div>
    </div>
</x-app-layout>