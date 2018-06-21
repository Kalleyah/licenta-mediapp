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
                <form class="" action = "{{ route('concedii.store') }}" method = "post">
                <div class="box-body">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <input type = "hidden" name = "consultid" value = "{{ app('request')->input('consultid') }}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient">
                            <input type="hidden" class="form-control" id="pacient_id" name="pacient_id" value = "{{ app('request')->input('pacientid') }}">
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                            <input type="text" class="form-control" placeholder="seria" id="serie" name="serie">
                        </div>
                        <div class="form-group">
                            <label>Perioada concediu:</label>

                            <div class="input-group col-md-8">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation" name="rezervation">
                            </div>
                            <!-- /.input group -->
                           
                        </div>
                        
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hotel"></i></span>
                            <input type="text" class="form-control" placeholder="Dutata comcediu in zile" id="duration" name="duration">
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-heartbeat"></i></span>
                            <input type="text" placeholder="Diagnostic" class="form-control" id="diagnostic" name="diagnostic">
                        </div>
                        
                        
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salveaza</button>
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

$(document).ready(function() {
    //Date range picker
    $('#reservation').daterangepicker(
            {
                locale: {
                    format: 'Y-MM-D'
                    }
            }
        );
    
    if(window.location.href.indexOf("pacientid") > -1) {
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