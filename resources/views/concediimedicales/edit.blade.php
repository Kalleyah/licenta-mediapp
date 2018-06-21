@extends('admin_template')

@section('content')
<section class="content">
<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <form class="" action = "{{ route('concedii.update' , ['id' => $concediu->id]) }}" method = "post">
                <div class="box-body">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <input type = "text" name = "consultid" value = "{{$concediu->pacient_id}}">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient">
                            <input type="hidden" class="form-control" id="pacient_id" name="pacient_id" value = "{{$concediu->pacient_id}}">
                        </div>
                        <br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" class="form-control" placeholder="seria" id="serie" name="serie" value = "{{$concediu->serie}}">
                        </div>
                        <div class="form-group">
                            <label>Date range:</label>

                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation" name="rezervation" value = "{{$concediu->startdate}} - {{$concediu->enddate}}">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" placeholder="diagnostic" class="form-control" id="diagnostic" name="diagnostic" value = "{{$concediu->diagnostic}}">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" placeholder="duration" class="form-control" id="duration" name="duration" value = "{{$concediu->duration}}">
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

$(document).ready(function() {
    //Date range picker
    $('#reservation').daterangepicker(
            {
                locale: {
                    format: 'Y-MM-D'
                    }
            }
        );
    });
</script>
</section>
@endsection