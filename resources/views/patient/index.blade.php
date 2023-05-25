

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
        <a href = "patients/create" class="btn btn-info"><img src="{{URL::asset('img/plus.png')}}" alt="create"width = "10rem"></a>
       
    </x-slot>

    <div class = "content" style="margin-left : 3rem; margin-right : 3rem  "  >
    <table id="patients" class = "table table-striped mt-4" style="width: 100%; font-size: 14px;" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Adress</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Emergency contact</th>
                <th scope="col">Allergies</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($patients as $patient)
            <?php
            $timestampNacimiento = strtotime($patient->birth_date);
            $timestampActual = time(); // Fecha actual en timestamp
            $edad = date('Y', $timestampActual) - date('Y', $timestampNacimiento);
        ?>
            <tr>
                <td>{{$patient->id}}</td>
                <td>{{$patient->code}}</td>
                <td>{{$patient->name}}</td>
                <td>{{$edad}}</td>
                <td>{{$patient->gender}}</td>
                <td>{{$patient->adress}}</td>
                <td>{{$patient->phone}}</td>
                <td>{{$patient->email}}</td>
                <td>{{$patient->emergency_contact}}</td>
                <td>{{$patient->allergies}}</td>
                <td>
                <form action="{{ route('patients.destroy',$patient->id)}}" method = "POST">
                    @csrf
                    @method('DELETE')
                <a href="/patients/{{$patient->id}}/edit"class = "btn btn-info">Edit</a>
                <button class = "btn btn-danger">Delete</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- ScriptJS to use datatables properties -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<!-- ScriptJS to use datatables buttons properties -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<!--ScriptJS to use iconns from fontawesome-->
<script src="https://kit.fontawesome.com/0395bf88e1.js" crossorigin="anonymous"></script>
<!--ScriptJS to make datatable-->
<script>
$(document).ready(function () {
    $('#patients').DataTable({
        "lengthMenu" : [[5,10,50,-1],[5,10,50,"All"]],
        "responsive" : "true",
        "dom" : 'Bfrtilp',
        "buttons" : [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel "></i>',
                titleAttr: 'Export to excel'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Export to pdf'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print" ></i>',
                titleAttr: 'Print'
            }
            
        ]
    });
});
</script>

</x-app-layout>
