@extends('_backend.master')
@section('content')
<section class="content-header">
    <h1>Oldal</h1>
    {{ HTML::decode(Breadcrumbs::render('admin.oldal.create')) }}
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            
            @include('_backend.message')

            {{Form::open(array('url' => URL::route('admin.oldal.store'),'class'=>'form-horizontal','method'=>'POST'))}}
            <div class="box box-solid">
                <div class="box-body">
                    {{Form::button('Mentés',array('type'=>'submit','class'=>'btn btn-divide btn-sm btn-copy'))}}
                </div>
            </div>


            <div class="box box-solid box-divide">
                <div class="box-header">
                    <h3 class="box-title">Oldal</h3>
                </div>
                <div class="box-body">
                    <div class="form-group hidden">
                        {{Form::label('parent', 'Szülő menüpont',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::selection('parent', $pages,array('class'=>'form-control'));}} 
                        </div>
                    </div>
                    <div class="form-group hidden">
                        {{Form::label('menu', 'Menüpont',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','menu','',array('class'=>'form-control','Placeholder'=>'Menüpont'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('title', 'Cím',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::input('text','title','',array('class'=>'form-control','Placeholder'=>'Cím'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Tartalom',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-9">
                            {{Form::textarea('content','',array('class'=>'ckeditor'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('gallery', 'Hozzárendelt galéria',array('class'=>'col-lg-2 control-label'))}}
                        <div class="col-lg-2">
                            {{Form::selection('gallery', $galleries,array('class'=>'form-control'));}} 
                        </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</section>
@stop