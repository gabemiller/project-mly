<?php

namespace Admin;

use Divide\CMS\Article;
use Divide\CMS\Event;
use Divide\CMS\Gallery;
use Divide\CMS\Page;
use View;
use Response;

class HomeController extends \BaseController {

    protected $layout = '_backend.master';

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Vezérlőpult');
        
        $this->layout->content = View::make('admin')->with('article',Article::count())->with('event',Event::count())->with('gallery',Gallery::count())->with('page',Page::count());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function login() {
        View::share('title', 'Bejelentkezés');
        
        $this->layout->content = View::make('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function logout() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
