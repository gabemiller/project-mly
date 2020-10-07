@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('palyazatok.index')) }}
@stop
@section('content')
    <div class="pages">
        <h2>Pályázatok</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Cím</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>
                            {{HTML::linkRoute('oldalak.show',$page->title,array('id'=>$page->id,'slug'=>\Str::slug($page->title)))}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center">
            {{$pages->links()}}
        </div>
    </div>
@stop