# Laravel-Sortable
Laravel Drag'n'Drop Sort 

Before you start add position column in table.
Must enable jquery in order to use Sortable plugin.
How to use:

### Blade example


```
    <tbody>
        @csrf
        @foreach($item as $i)
        <tr data-id="{{ $i->id }}" class="item">
            <td>{{ $i->position }}</td>
            <td>{{ $i->name }}</td>
            <td>
                <a class="handle" style="cursor: pointer;"> 
                    <i class="fa fa-arrow-up" aria-hidden="true"></i> 
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
```


### Jquery Sortable Plugin

```
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

        var token = $('meta[name="csrf-token"]').attr('content'); 

        $('tr.item').each(function(index, element) {

            order.push({

                id: $(this).attr('data-id'),

                position: index + 1

            });

        });


        $.ajax({

            type: "POST",

            dataType: "json",

            url: "{{ url('ur/desired/route-to-send-data') }}", 

            data: {

                order: order,

                _token: token 

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
```
###Controller 
 ```   
    public function sort(Request $request)
        {
            $item = Category::all();

            foreach ($item as $i) {
                foreach ($request->order as $order) {
                    if ($order['id'] == $i->id) {
                        $i->position = $order['position'];
                        $i->save();
                    }
                }
            }

            return response('Update Successfully.', 200);
        }
```
###update the store() method with following
```    
    $item->increment('position');
    $item->position = 1;
```
    
