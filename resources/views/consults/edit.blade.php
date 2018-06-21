@extends('admin_template')

@section('content')

{{ Breadcrumbs::render('consults.edit', $consults) }}

<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <form action = "{{ route('consults.update', ['id' => $consults->id]) }}" method = "post">
              
                <div class="box-body">
                        
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                       
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient">
                            <input type="hidden" class="form-control" id="pacient_id" name="pacient_id">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
                            <input name="simpthoms" type="text" class="form-control" placeholder="Simptome" value="{{$consults->simpthoms}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-heartbeat"></i></span>
                            <input name="diagnostics" type="text" class="form-control" placeholder="Diagnostic" value="{{$consults->diagnostics}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input name="codboala" type="text" class="form-control" placeholder="Cod boala" value="{{$consults->codboala}}">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                            <textarea name="threatment" class="form-control" id="threatment" rows="3" placeholder="Tratament" value="{{$consults->threatment}}"></textarea>
                        </div>
                        <br>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="medicalbreak" >
                            <label class="form-check-label" for="exampleCheck1">Concediu medical</label>
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
@endsection