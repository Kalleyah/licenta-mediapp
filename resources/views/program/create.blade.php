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
                <form class="" action = "{{ route('program.store') }}" method = "post">
                <div class="box-body">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient">
                            <input type="hidden" class="form-control" id="pacient_id" name="pacient_id">
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-left:0px !important;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input id="datepicker" name="startdate" type="text" class="form-control" placeholder="Data">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-right:0px !important;">
                                <div class="bootstrap-timepicker"><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><span class="bootstrap-timepicker-hour">11</span></td> <td class="separator">:</td><td><span class="bootstrap-timepicker-minute">00</span></td> <td class="separator">&nbsp;</td><td><span class="bootstrap-timepicker-meridian">AM</span></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                                <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input name="starthour" type="text" class="form-control timepicker">
                                </div>
                                <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            </div>
                        </div>
                        <!--div class='input-group' id='calendar1'>
                                <input name="duration" type="text" class="form-control" placeholder="Durata in minute">
                            </div-->
                        
                        
                        <!--div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-heartbeat"></i></span>
                            <input name="duration" type="text" class="form-control" placeholder="Durata">
                        </div-->
                        <input name="duration" type="hidden" value="15" class="form-control" placeholder="Durata">
                        
                    </div>
                    <div class="callout callout-info">
                            Automat un control se planifica de a fi 15 minute!
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Salveaza</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div id="calendar"></div>
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

$(document).ready(function() 
{
//Timepicker
$('.timepicker').timepicker({
        showInputs: false,
        minuteStep: 15,
        showSeconds: false,
        showMeridian: false
    });
   
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
//https://fullcalendar.io/docs
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: { left: 'month,agendaWeek,agendaDay' }, 
        defaultView: 'agendaWeek',
        events: '/eventscomplete'
    // weekends: false
    });
});

</script>
@endsection