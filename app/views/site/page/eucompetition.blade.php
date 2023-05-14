@extend('_frontend.master')
@section('breadcrumb')
    {{ HTML::decode(Breadcrumbs::render('palyazatok.index')) }}
@stop
@section('content')
    <script>
        const currencyFormatter = new Intl.NumberFormat('hu-HU', { style: 'currency', currency: 'HUF', minimumFractionDigits: 0 });
    </script>
    <div class="pages">
        <h2>EU Pályázatok</h2>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Pályázat címe / azonosítója</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($pages as $page)
                    <tr>
                        <td>
                            <h4 style="margin-top: 0">{{HTML::linkRoute('oldalak.show',$page->title,array('id'=>$page->id,'slug'=>\Str::slug($page->title)))}}</h4>
                            <p>{{$page->number}}</p>
                        </td>
                        <td>
                            <span style="text-transform: uppercase; font-weight: bold; font-size: 12px">Saját forrás:</span>&nbsp;<script>document.write(currencyFormatter.format({{$page->own_source}}));</script><br/>
                            <span style="text-transform: uppercase; font-weight: bold; font-size: 12px">Támogatás:</span>&nbsp;<script>document.write(currencyFormatter.format({{$page->support}}));</script><br/>
                            <span style="text-transform: uppercase; font-weight: bold; font-size: 12px">Támopatás&nbsp;mértéke:</span>&nbsp;{{$page->level_of_support}}&nbsp;%<br/>
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