<?php
namespace Admin;

use Divide\CMS\Page;
use Divide\CMS\Gallery;
use View;
use Input;
use Response;
use Exception;
use Validator;
use Redirect;
use Config;
use Str;

class CompetitionController extends \BaseController {

    protected $layout = '_backend.master';

	/**
	 * Display a listing of the resource.
	 * GET /admin\competition
	 *
	 * @return Response
	 */
	public function index()
	{
        View::share('title', 'Pályázatok');

        $this->layout->content = View::make('admin.competition.index')
            ->with('competitions', Page::where('is_competition','=',true)->get(['id','parent','menu','title']));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin\competition/create
	 *
	 * @return Response
	 */
	public function create()
	{
        View::share('title', 'Pályázat létrehozás');

        $this->layout->content = View::make('admin.competition.create')
            ->with('galleries', Gallery::getGalleries());
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin\competition
	 *
	 * @return Response
	 */
	public function store()
	{
        try {

            $rules = array(
                'title' => 'required|unique:pages',
                'content' => 'required'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $page = new Page();

            $page->title = Input::get('title');
            $page->menu =  Str::slug(Input::get('title'));
            $page->parent = Input::get('parent');
            $page->content = Input::get('content');
            $page->gallery_id = intval(Input::get('gallery')) > 0 ? Input::get('gallery') : 0;
            $page->is_competition = true;

            if ($page->save()) {
                return Redirect::back()->with('message', 'Az pályázat létrehozása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az pályázat létrehozása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az pályázat létrehozása nem sikerült!');
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /admin\competition/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin\competition/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $page = Page::find($id);
        View::share('title', 'Pályázat: ' . $page->title);
        $this->layout->content = View::make('admin.competition.edit')->with('competition', $page)
            ->with('galleries', Gallery::getGalleries());
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin\competition/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try {

            $rules = array(
                'title' => 'required|unique:pages,title,' . $id,
                'content' => 'required'
            );

            $validation = Validator::make(Input::all(), $rules);

            if ($validation->fails()) {
                return Redirect::back()->withInput()->withErrors($validation->messages());
            }

            $page = Page::find($id);

            $page->title = Input::get('title');
            $page->menu = Str::slug(Input::get('title'));
            $page->parent = Input::get('parent');
            $page->content = Input::get('content');
            $page->gallery_id = intval(Input::get('gallery')) > 0 ? Input::get('gallery') : 0;
            $page->is_competition = true;

            if ($page->save()) {
                return Redirect::back()->with('message', 'Az pályázat módosítása sikerült!');
            } else {
                return Redirect::back()->withInput()->withErrors('Az pályázat módosítása nem sikerült!');
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Redirect::back()->withInput()->withErrors($e->getMessage());
            } else {
                return Redirect::back()->withInput()->withErrors('Az pályázat módosítása nem sikerült!');
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin\competition/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        try {

            $page = Page::find($id);

            if ($page->delete()) {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú pályázat törlése sikerült!', 'status' => true]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú pályázat törlése nem sikerült!', 'status' => false]);
            }
        } catch (Exception $e) {
            if (Config::get('app.debug')) {
                return Response::json(['message' => $e->getMessage(), 'status' => false]);
            } else {
                return Response::json(['message' => 'A(z) ' . $id . ' azonosítójú pályázat törlése nem sikerült!', 'status' => false]);
            }
        }
	}

}