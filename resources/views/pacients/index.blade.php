@extends('admin_template')

@section('content')

{{ Breadcrumbs::render() }}

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row form-group">
                <div class="col-lg-12">
                <a href="{{ route('pacients.add') }}" class="btn btn-sm btn-success">
                    <span class="fa fa-user-plus"></span> Creaza pacient
                </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nume</th>
                            <th class="text-center">Prenume</th>
                            <th class="text-center">Data nasterii</th>
                            <th class="text-center">CNP</th>
                            <th class="text-center">Adresa</th>
                            <th class="text-center">Telefon</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($pacients->all() as $pacient)
                        <tr class="item{{$pacient->id}}">
                            <td>{{$pacient->id}}</td>
                            <td>{{$pacient->firstname}}</td>
                            <td>{{$pacient->lastname}}</td>
                            <td>{{$pacient->birthdate}}</td>
                            <td>{{$pacient->cnp}}</td>
                            <td>{{$pacient->address}}</td>
                            <td>{{$pacient->phone}}</td>
                            <td>
                            <a href="{{ route('pacients.show', ['id' => $pacient->id]) }}" 
                            class="btn btn-xs btn-success">
                        <span class="glyphicon glyphicon-edit"></span> Vizualizare
                    </a>
                    <a href="{{ route('pacients.edit', ['id' => $pacient->id]) }}" class="btn btn-xs btn-info"
                        data-info="{{$pacient->id}}">
                        <span class="glyphicon glyphicon-edit"></span> Editare
                    </a>
                    <a onclick="return confirm('Sigur vreti sa stergeti pacientul?')" href="{{ route('pacients.destroy', ['id' => $pacient->id]) }}" class="btn btn-xs btn-danger"
                        data-info="{{$pacient->id}}">
                        <span class="glyphicon glyphicon-trash"></span> Sterge
                    </a>
                    </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $pacients->links() }}
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
    $('#table').DataTable(
        {
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
    }
    );
} );
 </script>

@endsection