<script>
    $('#myTable tbody').sortable({
        items: "tr",
        cursor: 'move',
        opacity: 0.6,
        'handle': '.handle',
        update: function(event, ui) {
            sendOrder();
        }
    });

    $(window).resize(function() {
        $('#myTable tr').css('min-width', $('#myTable').width());
    });

    function sendOrder() {

        var order = [];

        var token = $('meta[name="csrf-token"]').attr('content'); //laravel only 

        $('tr.item').each(function(index, element) {

            order.push({

                id: $(this).attr('data-id'),

                position: index + 1

            });

        });


        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{ url('category/category/reposition') }}", 

            data: {

                order: order,

                _token: token //if laravel, if not remove this field

            },

            success: function(response) {

                if (response.status == "success") {

                    console.log(response);

                } else {

                    console.log(response);

                }
            }
        });
    }
</script>