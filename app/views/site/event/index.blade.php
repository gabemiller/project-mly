@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('esemenyek.index')) }}
@stop
@section('content')

    @foreach($events as $event)
        <div class="event list-box">
            <h2>{{HTML::link($event->getLink(),$event->title)}}</h2>

            <p class="small text-uppercase text-muted"><strong>Kezdés</strong> {{$event->start}},
                <strong>Befejezés</strong> {{$event->end}} </p>

            <div class="event-content">{{$event->content}}</div>
            <div class="tags">
                @if(sizeof($event->tagNames()) > 0)
                    @foreach(\Divide\Helper\Tag::getTagByName($event->tagNames()) as $tag)
                        <span class="label label-banhorvati-blue">{{HTML::linkRoute('esemenyek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{$events->links();}}
    </div>

@stop