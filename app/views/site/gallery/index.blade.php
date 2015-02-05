@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('galeriak.index')) }}
@stop
@section('content')
    <div class="gallery">

        <h2>Galériák</h2>

        <div class="table-responsive">
            <table class="table table-striped table-middle">
                <thead>
                <tr>
                    <th colspan="2">
                        Cím
                    </th>
                    <th class="table-col-md">
                        Frissítve
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($galleries as $gallery)
                    <tr>
                        <td class="table-col-md">
                            {{HTML::decode(HTML::linkRoute('galeriak.show','<img class="img-responsive" src="'.$gallery->pictures->first()->thumbnail_path.'" alt="'.$gallery->name.'" title="'.$gallery->name.'" />',array('id'=>$gallery->id,'title'=>$gallery->getSlugName())))}}
                        </td>
                        <td>
                            {{HTML::decode(HTML::linkRoute('galeriak.show','<strong>'.$gallery->name.'</strong>',array('id'=>$gallery->id,'title'=>$gallery->getSlugName())))}}
                            @if(strlen($gallery->getDescription())>0)
                                <p>{{$gallery->getDescription()}}</p>
                            @endif
                        </td>
                        <td>
                            {{$gallery->getUpdateDate()}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center">
            {{$galleries->links();}}
        </div>
    </div>
@stop