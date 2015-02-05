@extend('_frontend.master')
@section('breadcrumb')
{{ HTML::decode(Breadcrumbs::render('oldalak.show',$page)) }}
@stop
@section('content')
<div class="page">
    <h1>{{$page->title}}</h1>
    <div class="page-content">
        {{$page->content}}
    </div>
    
    @if(count($page->gallery)!=0 && count($page->gallery->pictures)!=0)
    <h4>Galéria</h4>
    <div class="page-gallery">
        <ul class="row list-unstyled">
            @foreach($page->gallery->pictures as $picture)
            <li class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <a href="{{$picture->picture_path}}" title="{{$picture->name}}" data-gallery>
                    <img class="img-responsive" src="{{$picture->thumbnail_path}}" alt="{{$picture->name}}" title="{{$picture->name}}" />
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
</div>
@stop