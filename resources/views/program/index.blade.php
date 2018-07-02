@extends('admin_template')

@section('content')

{{ Breadcrumbs::render( ) }}

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row form-group">
                <div class="col-lg-12">
                    <a href="{{ route('program.add') }}" class="btn btn-sm btn-success">
                        <span class="glyphicon glyphicon-plus"></span> Introduce programare
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
                                <th class="text-center">Nume pacient</th>
                                <th class="text-center">Data si ora</th>
                                <th class="text-center">Durata</th>
                                <th class="text-center">Creat la</th>
                                <th class="text-center">Modificat la</th>
                                <th class="text-center">ala</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($programs->all() as $program)
                            <tr class="item{{$program->id}}">
                                <td>{{$program->id}}</td>
                                <td>{{$program->pacient_id}}</td>
                                <td>{{$program->firstname}} {{$program->lastname}}</td>
                                <td>{{$program->startdate}} {{$program->starthour}}</td>
                                <td>{{$program->duration}}</td>
                                <td>{{$program->created_at}}</td>
                                <td>{{$program->updated_at}}</td>
                                <td>
                                <a href="{{ route('program.show', ['id' => $program->id]) }}" class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-edit"></span> Vizualizare
                                </a>
                                <a href="{{ route('program.edit', ['id' => $program->id]) }}" class="btn btn-sm btn-info">
                                    <span class="glyphicon glyphicon-edit"></span> Editare
                                </a>
                                <a onclick="return confirm('Sigur vreti sa stergeti programarea?')" href="{{ route('program.destroy', ['id' => $program->id]) }}" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Sterge
                                </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $programs->links() }}
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