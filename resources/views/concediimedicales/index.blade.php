@extends('admin_template')

@section('content')

{{ Breadcrumbs::render() }}

<section class="content">
<div class="box">
        <div class="box-body">
            <div class="row form-group">
                <div class="col-lg-12">
                <a href="{{ route('concedii.add') }}" class="btn btn-info">
                    <span class="glyphicon glyphicon-plus"></span> Introduce concediu
                </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <table class="table" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Serie</th>
                                <th class="text-center">Nume pacient</th>
                                <th class="text-center">De la</th>
                                <th class="text-center">Pana la</th>
                                <th class="text-center">Nr. de Zile</th>
                                <th class="text-center">Eliberat la</th>
                                <th class="text-center">ala</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($concedii->all() as $concediu)
                            <tr class="item{{$concediu->id}}">
                                <td>{{$concediu->id}}</td>
                                <td>{{$concediu->serie}}</td>
                                <td>{{$concediu->firstname}}</td>
                                <td>{{$concediu->startdate}}</td>
                                <td>{{$concediu->enddate}}</td>
                                <td>{{$concediu->duration}}</td>
                                <td>{{$concediu->created_at}}</td>
                                <td>
                                <a href="{{ route('concedii.show', ['id' => $concediu->id]) }}" 
                                class="btn btn-sm btn-success">
                                    <span class="glyphicon glyphicon-edit"></span> Vizualizare
                                </a>
                                <a href="{{ route('concedii.edit', ['id' => $concediu->id]) }}" class="btn btn-sm btn-info">
                                    <span class="glyphicon glyphicon-edit"></span> Editare
                                </a>
                                <a onclick="return confirm('Sigur vreti sa stergeti concediul?')" href="{{ route('concedii.destroy', ['id' => $concediu->id]) }}" class="btn btn-sm btn-danger">
                                    <span class="glyphicon glyphicon-trash"></span> Sterge
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $concedii->links() }}
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