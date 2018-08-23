<script>

    $( function() {

      var dateFormat = "yy-mm-dd";
      from = $( "#from" )
        .datepicker({

          changeMonth: true,
          changeYear: true
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
        to = $( "#to" ).datepicker({

          changeMonth: true,
          changeYear: true,
        })
        .on( "change", function() {
          from.datepicker( "option", "maxDate", getDate( this ) );
        });

        function getDate( element ) {
          var date;
          try {
            date = $.datepicker.parseDate( dateFormat, element.value );
          } catch( error ) {
            date = null;
          }

        return date;

        }

      });

</script>
