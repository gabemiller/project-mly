<?php

namespace Site;

use Divide\CMS\Page;
use View;
use Request;

class PageController extends \BaseController {

    protected $layout = '_frontend.master';

    /**
     * Display the specified resource.
     * GET /site\page/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $page = Page::find($id);
        
        View::share('title', $page->title);

        $this->layout->content = View::make('site.page.show')->with('page', $page)->with('url', Request::url());
    }

    /**
     * Display the specified resource.
     * GET /site\page/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function showCompetitions(){
        $pages = Page::where('is_competition','=',true)
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

        View::share('title', 'Pályázatok');

        $this->layout->content = View::make('site.page.competition')->with('pages', $pages)->with('url', Request::url());
    }

}
