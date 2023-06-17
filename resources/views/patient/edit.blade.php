<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>  
    </x-slot>
    <div class = "content" style="margin-left : 4rem; margin-right : 30rem " >
    <form action="/patients/{{$patient->id}}" method="POST">
        @csrf
        @method('PUT')
    <div class = "mb-3">
        <label for="" class = "form-label">Code</label>
        <input id="code" name="code" class="form-control" tabindex="1" type="text" value="{{$patient->code}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Name</label>
        <input id="name" name="name" class="form-control" tabindex="2" type="text" value="{{$patient->name}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Birth date</label>
        <input id="birth_date" name="birth_date" class="form-control" tabindex="3" type="text" value="{{$patient->birth_date}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Adress</label>
        <input id="adress" name="adress" class="form-control" tabindex="3" type="text" value="{{$patient->adress}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Phone</label>
        <input id="phone" name="phone" class="form-control" tabindex="3" type="text" value="{{$patient->phone}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Email</label>
        <input id="email" name="email" class="form-control" tabindex="3" type="text" value="{{$patient->email}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Emergency contact</label>
        <input id="emergency_contact" name="emergency_contact" class="form-control" tabindex="3" type="text" value="{{$patient->emergency_contact}}">
    </div>
    <div class = "mb-3">
        <label for="" class = "form-label">Allergies</label>
        <input id="allergies" name="allergies" class="form-control" tabindex="3" type="text" value="{{$patient->allergies}}">
    </div>
    <a href="/patients" class = "btn btn-secondary" tabindex ="4">Cancel</a>
    <button type="submit" class = "btn btn-primary" tabindex ="5">Save</button>
</form>
</div>
</x-app-layout>