//store() snippet
<!-- $category = new Category();
$category->increment('position');
$category->name = $request->input('name');
$category->descr = $request->input('descr');
$category->position = 1;
$category->save(); -->

/**
* Drag'n'Drop Sort with database position save.
*
*
* @return response
*/
public function sort(Request $request)
{
        $category = Category::all();

        foreach ($category as $cat) {
            foreach ($request->order as $order) {
                if ($order['id'] == $cat->id) {
                    $cat->position = $order['position'];
                    $cat->save();
                }
            }
        }

        return response('Update Successfully.', 200);
}

//html
<tbody>
    @csrf
    @foreach($category as $item)
    <tr data-id="{{ $item->id }}" class="item">
        <td>{{ $item->position }}</td>
        <td>{{ $item->name }}</td>
        <td>
            <a class="handle" style="cursor: pointer;"> 
                <i class="fa fa-arrow-up" aria-hidden="true"></i> 
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
    @endforeach
</tbody>