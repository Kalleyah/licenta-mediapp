@extends('admin_template')

@section('content')

{{ Breadcrumbs::render() }}
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row form-group">
                <div class="col-lg-12">
                <a href="{{ route('consults.add') }}" class="btn btn-sm btn-success">
                    <span class="glyphicon glyphicon-plus"></span> Creaza consultatie
                </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Pacient</th>
                                <th class="text-center">Data consultatie</th>
                                <th class="text-center">Simptome</th>
                                <th class="text-center">Diagnostic</th>
                                <th class="text-center">Cod boala</th>
                                <th class="text-center">Tratament</th>
                                <th class="text-center">Concediu medical</th>
                                <th class="text-center">Medicul consultant</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($consults->all() as $consult)
                            <tr class="item{{$consult->id}}">
                                <td>{{$consult->id}}</td>
                                <td>{{$consult->firstname}} {{$consult->lastname}} <br/> {{$consult->cnp}}</td>
                                <td>{{$consult->consultdate}}</td>
                                <td>{{$consult->simpthoms}}</td>
                                <td>{{$consult->diagnostics}}</td>
                                <td>{{$consult->codboala}}</td>
                                <td>{{$consult->threatment}}</td>
                                <td>{{$consult->medicalbreak}}</td>
                                <td>{{$consult->name}}</td>
                                <td>
                                <a href="{{ route('consults.show', ['id' => $consult->id]) }}" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-edit"></span> Vizualizare
                                </a>
                                <a href="{{ route('consults.edit', ['id' => $consult->id, 'pacientid' => $consult->pacient_id, 'medic' => $consult->medic]) }}" class="btn btn-sm btn-sm btn-info">
                                    <span class="glyphicon glyphicon-edit"></span> Editare
                                </a>
                                <a onclick="return confirm('Sigur vreti sa stergeti consultatia?')" href="{{ route('consults.destroy', ['id' => $consult->id]) }}" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Sterge
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $consults->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script
    src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

<script>
  $(document).ready(function() {
    $('#table').DataTable( {
        "language": {
            "lengthMenu": "Arata _MENU_ inregistrari per pagina",
            "zeroRecords": "Nu exista inregistrari",
            "info": "Pagina _PAGE_ din _PAGES_",
            "infoEmpty": "Nu exista inregistrari",
            "infoFiltered": "(filtrat din _MAX_ inregistrari)",
            "loadingRecords": "Se incarca...",
            "search":         "Cautare:",
            "paginate": {
                "first":      "Prima",
                "last":       "Ultima",
                "next":       "Urmatorul",
                "previous":   "Precedentul"
            },
        }
    });
} );
 </script>

@endsection