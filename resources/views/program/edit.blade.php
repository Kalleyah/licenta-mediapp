@extends('admin_template')

@section('content')
{{ Breadcrumbs::render('program.edit', $programs) }}

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
                            <input type="text" class="form-control" placeholder="Cautare dup Cnp sau Nume pacient - alegeti din lista" id="pacient" name="pacient"  value="{{$programs->pacient->firstname}} {{$programs->pacient->lastname}} ({{$programs->pacient->cnp}})">
                            <input type="hidden" class="form-control" id="pacientid" name="pacientid" value="{{$programs->id}}">
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-left:0px !important;">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                                    <input id="datepicker" name="startdate" type="text" class="form-control" placeholder="Data" value="{{$programs->startdate}}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12" style="padding-right:0px !important;">
                                <div class="bootstrap-timepicker"><div class="bootstrap-timepicker-widget dropdown-menu"><table><tbody><tr><td><a href="#" data-action="incrementHour"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="incrementMinute"><i class="glyphicon glyphicon-chevron-up"></i></a></td><td class="separator">&nbsp;</td><td class="meridian-column"><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-up"></i></a></td></tr><tr><td><span class="bootstrap-timepicker-hour">11</span></td> <td class="separator">:</td><td><span class="bootstrap-timepicker-minute">00</span></td> <td class="separator">&nbsp;</td><td><span class="bootstrap-timepicker-meridian">AM</span></td></tr><tr><td><a href="#" data-action="decrementHour"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator"></td><td><a href="#" data-action="decrementMinute"><i class="glyphicon glyphicon-chevron-down"></i></a></td><td class="separator">&nbsp;</td><td><a href="#" data-action="toggleMeridian"><i class="glyphicon glyphicon-chevron-down"></i></a></td></tr></tbody></table></div>
                                <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <input name="starthour" type="text" class="form-control timepicker" value="{{$programs->starthour}}">
                                </div>
                                <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                            </div>
                        </div>
                       
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa  fa-heartbeat"></i></span>
                            <input name="duration" type="text" class="form-control" placeholder="Durata"  value="{{$programs->duration}}">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
              $('#pacientid').val(ui.item.id);
          }
      });

$(document).ready(function() {
//Timepicker
$('.timepicker').timepicker({
        showInputs: false,
        minuteStep: 15,
        showSeconds: false,
        showMeridian: false
    });
});


  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    $('#calendar').fullCalendar({
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week : 'week',
        day  : 'day'
      },
      //events_source: '{!!URL::route('evetscomplete')!!}',
      //Random default events
      events    : [
        {"id":5,"title":"Sabau Ilie Alin (12345678912345)","start":"2018-06-19 12:45:00","end":"2018-06-19 12:45:00","class":"event-important"},
      ],
      editable  : false,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })


</script>
@endsection