@extends('admin_template')

@section('content')
<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row form-group">
                <div class="col-lg-12">
                    <form class="" action = "" method = "post">
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12" style="padding-left:0px !important;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input id="datepicker" name="from_date" type="text" class="form-control" placeholder="De la">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12" style="padding-left:0px !important;">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                <input id="datepicker2" name="to_date" type="text" class="form-control" placeholder="Pana la">
                        </div>
                    </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Arata raport</button>
                    </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
    <div class="box">

    <h3>{{$title}}</h3>
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Cod boala</th>
      <th scope="col">Diagnostic</th>
      <th scope="col">Numar pacienti</th>
    </tr>
  </thead>
  <tbody>
        @foreach ($consults->all() as $consult)
        <tr scope="row">
            <td>
                {{$consult->codboala}}
            </td>

            <td>
                {{$consult->diagnostics}}
            </td>
            <td>
                {{$consult->total}}
            </td>
        </tr>
        @endforeach
        </tbody>
        
        
        <tfoot>
            <tr scope="row">
                <td>
                    <form class="" action = "{{ route('raports.boli.pdf')}}" method = "post" target="_blank">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <input name="sec_from_date" type="hidden" value="{{$from}}">
                        <input name="sec_to_date" type="hidden" value={{$to}}>
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i>  Exporta in pdf</button>
                    </form>
                </td>
            </tr>
        </tfoot>
</table>
    </div>

</section>

<script>

$('#datepicker').datepicker({
      autoclose: true,
      changeYear: true,
      yearRange: '1901:2019',
      dateFormat: 'yy-mm-dd'
 });
 $('#datepicker2').datepicker({
      autoclose: true,
      changeYear: true,
      yearRange: '1901:2019',
      dateFormat: 'yy-mm-dd'
 });
 </script>

@endsection