    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
 <div id="calendar"></div>
 {{Form::open(['submit-booking'])}}
 <input type="hidden" name="dates" id="dates" />
 <input type="text" name="id" value="{{$ad->id}}" />
 {{Form::close()}}

<script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/vendors/fullcalendar/js/fullcalendar.min.js') }}" type="text/javascript"></script>
<script>
 /* Calendar */


            /* initialize the calendar
                     -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date();
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
             $('#calendar').fullCalendar({
              dayClick: function(date, jsEvent, view) {

                selected_date=date.format();


                  //alert('Clicked on: ' + date.format());

                  
                  $('#dates').val($('#dates').val() + ';'+date.format());
                  //href="remoteContent.html" data-remote="false"

                  /*$('#my-modal').modal({
                      show: 'false'
                  });*/

                 // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                  //alert('Current view: ' + view.name);

                  // change the day's background color just for fun
                  //$(this).css('background-color', 'red');

              },
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month'
                },
                //Random events
                events: [{
                        title: 'Team Out',
                        start: new Date(y, m, 1),
                        backgroundColor: ('#418BCA')
                    },{
                    title: 'Long Event',
                    start: new Date(y, m, d - 8),
                    end: new Date(y, m, d - 8),
                    backgroundColor: "#F89A14",
                    borderColor: "#F89A14"
                    },

                     {
                       title: 'Holiday',
                       start: new Date(y, m,  10),
                       backgroundColor: ('#01BC8C')
                    }, {
                       title: 'Seminar',
                       start: new Date(y, m, 12),
                       backgroundColor: ('#67C5DF')
                    },{
                       title: 'Anniversary Celebrations',
                       start: new Date(y, m, 22),
                       backgroundColor: ('#EF6F6C')
                    },{
                       title: 'Event Day',
                       start: new Date(y, m, 31),
                       backgroundColor: ('#EF6F6C')
                    },{
                    title: 'Client Meeting',
                    start: new Date(y, m,  28),
                    end: new Date(y, m,28),
                    backgroundColor: "#A9B6BC",
                    borderColor: "#A9B6BC"
                    }],
                editable: false,
                droppable: false,
                 height:450
            });

            /* ADDING EVENTS */
            var currColor = "#418BCA"; //default
            //Color chooser button
            var colorChooser = $("#color-chooser-btn");
            $("#color-chooser > li > a").click(function(e) {
                e.preventDefault();
                //Save color
                currColor = $(this).css("background-color");
                //Add color effect to button
                colorChooser
                    .css({
                        "background-color": currColor,
                        "border-color": currColor
                    })
                    .html($(this).text() + ' <span class="caret"></span>');
            });
            $("#add-new-event").click(function(e) {
                e.preventDefault();
                //Get value and make sure it is not null
                var val = $("#new-event").val();
                if (val.length == 0) {
                    return;
                }

                //Create event
                var event = $("<div />");
                event.css({
                    "background-color": currColor,
                    "border-color": currColor,
                    "color": "#fff"
                }).addClass("external-event");
                event.html(val);
                $('#external-events').prepend(event);

                //Add draggable funtionality
                ini_events(event);

                //Remove event from text input
                $("#new-event").val("");
            });  
</script>
