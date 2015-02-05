<tr>
    <td class="text-center">
        {{Form::input('checkbox','delete',$competition->id,array('data-url'=> URL::route('admin.palyazat.destroy',array('id'=>$competition->id))))}}
    </td>
    <td>{{$competition->id}}</td>
    <td>{{$competition->title}}</td>
    <td class="text-center">
        {{HTML::decode(HTML::linkRoute('admin.palyazat.edit','<i class="fa fa-edit"></i> Módosítás',array('id'=>$competition->id),array('class'=>'btn btn-sm btn-default')))}}
    </td>
</tr>