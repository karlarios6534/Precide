

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial') }}
        </h2>
       
    </x-slot>

    <div class = "content" style="margin-left : 3rem; margin-right : 3rem">
    @foreach ($records as $record)
        <h1>{{$record}}</h1>
    @endforeach
</div>
</x-app-layout>