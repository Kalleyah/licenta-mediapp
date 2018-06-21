@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('pacients.edit', $pacient) }}

<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <form action = "{{ route('pacients.update', ['id' => $pacient->id]) }}" method = "post">
              
                    <div class="box-body">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input name="firstname" type="text" class="form-control" placeholder="Nume" value="{{$pacient->firstname}}">
                        </div><br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input name="lastname" type="text" class="form-control" placeholder="Prenume" value="{{$pacient->lastname}}">
                        </div>
                        
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-calendar"></i></span>
                            <input id="datepicker" name="birthdate" type="text" class="form-control" placeholder="Data nasterii" value="{{$pacient->birthdate}}">
                            
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input name="cnp" type="text" class="form-control" placeholder="CNP" value="{{$pacient->cnp}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input name="address" type="text" class="form-control" placeholder="Adresa completa" value="{{$pacient->address}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input name="phone" type="text" class="form-control" placeholder="Telefon" value="{{$pacient->phone}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-bullseye"></i></span>
                            <input name="alergii" type="text" class="form-control" placeholder="Alergii, despartite prin virgula" value="{{$pacient->alergii}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <textarea rows="5" name="note" type="text" class="form-control" placeholder="note" value="{{$pacient->note}}"></textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<script>
//Date picker
$('#datepicker').datepicker({
      autoclose: true,
      changeYear: true,
      yearRange: '1901:2019',
      dateFormat: 'yy-mm-dd'
 });

 

</script>
@endsection