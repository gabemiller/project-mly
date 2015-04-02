<?php

namespace Site;

use Divide\CMS\Article;
use View;
use Request;
use Conner\Tagging\Tag;

class ArticleController extends \BaseController {

    protected $layout = '_frontend.master';


    /**
     * Display a listing of the resource.
     * GET /site\index
     *
     * @return Response
     */
    public function index() {
        View::share('title', 'Főoldal');

        $article = Article::where('shows', '=', true)
            ->orderBy('created_at', 'DESC')
            ->select(['id', 'title', 'author_id', 'created_at', 'content'])
            ->paginate(5);

        $this->layout->content = View::make('site.article.index')
            ->with('articles', $article);
    }

    /**
     * Display the specified resource.
     * GET /site\article/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
        $article = Article::find($id);
        
        View::share('title', $article->title);
        
        $this->layout->content = View::make('site.article.show')
            ->with('article', $article)
            ->with('url',Request::url());
    }
    
    /**
     * 
     * @param type $tagSlug
     */
    public function tag($id) {
        
        $tag = Tag::where('id','=',$id)->first(['id','name']);
        
        View::share('title', 'Hírek: '.$tag->name);
        
        $article = Article::withAnyTag($tag->name)->orderBy('created_at','desc')->paginate(10);

        $this->layout->content = View::make('site.article.tag')
            ->with('articles',$article)
            ->with('tag',$tag);
    }

}
