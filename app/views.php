<?php


/**
 *
 */

View::composer('_frontend.footer', function ($view) {
    $articles = \Divide\CMS\Article::orderBy('created_at', 'desc')
        ->take('3')
        ->get(['id', 'title', 'author_id', 'created_at']);

    $view->with('articleFooter', $articles);
});

/**
 *
 */

View::composer(array('_backend.master','admin.*', 'admin.users.login'), function ($view) {

    if (Sentry::check()) {
        $user = \Divide\CMS\User::find(\Sentry::getUser()->id);

        $view->with('user', $user);
    }
});