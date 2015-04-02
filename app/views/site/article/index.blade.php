@extends('_frontend.master')
@section('breadcrumb')
    {{-- HTML::decode(Breadcrumbs::render('fooldal')) --}}
@stop
@section('content')

    @foreach($articles as $article)
        <div class="article list-box">
            <h2>{{HTML::link($article->getLink(),$article->title)}}</h2>

            <p class="small text-uppercase text-muted">
                <strong>{{$article->getAuthorName()}}</strong>, {{$article->getCreateDate()}}
            </p>

            <div class="article-content">{{$article->content}}</div>

            <div class="tags">
                @if(sizeof($article->tagNames()) > 0)
                    @foreach(\Divide\Helper\Tag::getTagByName($article->tagNames()) as $tag)
                        <span class="label label-banhorvati-blue">{{HTML::linkRoute('hirek.tag',$tag->name,array('id'=>$tag->id,'tagSlug'=>\Str::slug($tag->slug)))}}</span>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center">
        {{$articles->links();}}
    </div>

@stop