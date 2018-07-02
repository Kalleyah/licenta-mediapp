@extends('admin_template')

@section('content')
{{ Breadcrumbs::render() }}
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <form class="" action = "{{ route('consults.store') }}" method = "post">
                    <div class="box-body">
                        
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                       
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient">
                            <input type="hidden" class="form-control" id="pacient_id" name="pacient_id">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-md"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dupa Nume medic - alegeti din lista" id="medic_name" name="medic_name">
                            <input type="hidden" class="form-control" id="medic" name="medic">
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-medkit"></i></span>
                            <input name="simpthoms" type="text" class="form-control" placeholder="Simptome">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-heartbeat"></i></span>
                            <input name="diagnostics" type="text" class="form-control" placeholder="Diagnostic">
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input name="codboala" type="text" class="form-control" placeholder="Cod boala" >
                        </div>
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span>
                            <textarea name="threatment" class="form-control" id="threatment" rows="3" placeholder="Tratament"></textarea>
                        </div>
                        <br>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="medicalbreak">
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

<script type="text/javascript">
      $('#pacient').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
          minlength:1,
          autoFocus:true,
          select:function(e,ui)
          {
              $('#pacient').val(ui.item.value);
              $('#pacient_id').val(ui.item.id);
          }
      });

      $('#medic_name').autocomplete({
        source:'{!!URL::route('doctorslist')!!}',
          minlength:1,
          autoFocus:true,
          select:function(e,ui)
          {
              $('#medic_name').val(ui.item.value);
              $('#medic').val(ui.item.id);
          }
      });


 $(document).ready(function() {
   
    if(window.location.href.indexOf("pacientid") > -1) {
      //alert("your url contains the pacientid");
       $.ajax(
        {
            type: "GET",
            url: "{!!URL::route('autousername', ['pacientid' => app('request')->input('pacientid') ])!!}",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(data){
                //console.log(data[0].value);
                $('#pacient').val(data[0].value);
                $('#pacient').attr("disabled", "disabled"); 
            },
            error: function(data){
                $('#pacient').removeAttr("disabled"); 
            }
        });

    }

    });
</script>
@endsection