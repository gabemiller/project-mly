<?php

/**
 * Patterns
 */

Route::pattern('title', '[0-9A-z_-]+');
Route::pattern('id', '[0-9]+');
Route::pattern('tagSlug', '[0-9A-z_-]+');
Route::pattern('category', '[0-9A-z_-]+');


/**
 * -----------------------------------------------------------------------------
 * Site
 * -----------------------------------------------------------------------------
 *
 * A cms-hez tarozó route-ok.
 *
 */

Route::get('/', ['uses' => 'Site\HomeController@index', 'as' => 'fooldal']);

Route::get('hirek', ['uses' => 'Site\ArticleController@index', 'as' => 'hirek.index']);

Route::get('hirek/{id}/{title}', ['uses' => 'Site\ArticleController@show', 'as' => 'hirek.show']);

Route::get('hirek/cimke/{id}/{tagSlug}', ['uses' => 'Site\ArticleController@tag', 'as' => 'hirek.tag']);

Route::get('esemenyek', ['uses' => 'Site\EventController@index', 'as' => 'esemenyek.index']);

Route::get('esemenyek/{id}/{title}', ['uses' => 'Site\EventController@show', 'as' => 'esemenyek.show']);

Route::get('esemenyek/cimke/{id}/{tagSlug}', ['uses' => 'Site\EventController@tag', 'as' => 'esemenyek.tag']);

Route::get('galeriak', ['uses' => 'Site\GalleryController@index', 'as' => 'galeriak.index']);

Route::get('galeriak/{id}/{title}', ['uses' => 'Site\GalleryController@show', 'as' => 'galeriak.show']);

Route::get('oldal/{id}/{title}', ['uses' => 'Site\PageController@show', 'as' => 'oldalak.show']);

Route::get('eu-palyazatok', ['uses' => 'Site\PageController@showEuCompetitions', 'as' => 'eupalyazatok.index']);

Route::get('palyazatok', ['uses' => 'Site\PageController@showCompetitions', 'as' => 'palyazatok.index']);

Route::get('dokumentumok/{category?}', ['uses' => 'Site\DocumentController@index', 'as' => 'dokumentumok.index']);

Route::get('akadalymentes/{am}', function ($am) {

    if ($am == 'letrehoz') {
       $cookie = \Cookie::forever('am', 'true');
    } else {
       $cookie = \Cookie::forget('am');
    }

    return \Redirect::back()->withCookie($cookie);
});

/**
 * -----------------------------------------------------------------------------
 * Site menu
 * -----------------------------------------------------------------------------
 *
 * A cms-hez tarozó menu-k.
 *
 */
if (!Request::is('admin') && !Request::is('admin/*')) {

    Menu::make('competitionMenu', function ($menu) {
        $menu->add('EU Pályázatok', array('route' => 'eupalyazatok.index'));
        $menu->add('Pályázatok', array('route' => 'palyazatok.index'));
    });

    Menu::make('competitionSideMenu', function ($menu) {
        $menu->add('EU Pályázatok', array('route' => 'eupalyazatok.index'));
    });

    Menu::make('mainMenu', function ($menu) {

        try {
            \Divide\CMS\MenuItem::generateMenu($menu, null);

            foreach ($menu->all() as $item) {
                if ($item->hasChildren()) {
                    $item->append('<i class="fa fa-bars"></i>');
                }
            }

        } catch (\Exception $ex) {

        }
    });
}


/**
 * -----------------------------------------------------------------------------
 * Admin
 * -----------------------------------------------------------------------------
 *
 * Az adminisztrációs felülethez tarozó route-ok.
 *
 */
Route::group(array('prefix' => 'admin', 'namespace' => 'Admin'), function () {

    Route::get('bejelentkezes', ['uses' => 'UsersController@getLogin', 'as' => 'admin.bejelentkezes', 'before' => 'userLoggedIn']);

    Route::post('bejelentkezes', ['uses' => 'UsersController@postLogin', 'as' => 'admin.bejelentkezes']);

    Route::get('kijelentkezes', ['uses' => 'UsersController@getLogout', 'as' => 'admin.kijelentkezes']);
});

Route::group(array('prefix' => 'admin', 'before' => 'userNotLoggedIn|inGroup:Admin'), function () {

    /**
     * Fájlmanagerhez tarozó route-ok.
     */
    Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');

    Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');

    Route::get('elfinder/ckeditor4', 'Barryvdh\Elfinder\ElfinderController@showCKeditor4');

});

Route::group(array('prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'userNotLoggedIn|inGroup:Admin'), function () {

    /**
     * Általános beállításokhoz tartozó route-ok.
     */
    Route::get('/', ['uses' => 'HomeController@index', 'as' => 'admin.vezerlopult']);

    Route::resource('oldal', 'PageController');

    Route::resource('palyazat', 'CompetitionController');

    Route::resource('hir', 'ArticleController');

    Route::resource('esemeny', 'EventController');

    Route::resource('dokumentum', 'DocumentController');

    Route::resource('dokumentum-kategoria', 'DocumentCategoryController');

    Route::resource('galeria', 'GalleryController');

    Route::resource('menu-kezelo', 'MenuController');

    Route::get('galeria/kep/{id}/upload', ['uses' => 'GalleryController@getPicture', 'as' => 'admin.galeria.kep.upload'])->where('id', '[0-9]+');

    Route::post('galeria/kep/save', ['uses' => 'GalleryController@postPicture', 'as' => 'admin.galeria.kep.save']);

    Route::post('galeria/kep/{id}/delete', ['uses' => 'GalleryController@deletePicture', 'as' => 'admin.galeria.kep.delete'])->where('id', '[0-9]+');

    /**
     * Felhasználók kezeléséhez tartozó route-ok.
     */
    Route::group(['prefix' => 'felhasznalok'], function () {
        Route::resource('felhasznalo', 'UsersController');

        Route::post('felhasznalo/{id}/change',
            ['uses' => 'UsersController@postProfile', 'as' => 'admin.felhasznalok.felhasznalo.change']);

        Route::post('felhasznalo/{id}/password',
            ['uses' => 'UsersController@postPassword', 'as' => 'admin.felhasznalok.felhasznalo.password']);

        Route::post('felhasznalo/{id}/picture',
            ['uses' => 'UsersController@postProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.picture']);

        Route::get('felhasznalo/{id}/picture/delete',
            ['uses' => 'UsersController@deleteProfilePicture', 'as' => 'admin.felhasznalok.felhasznalo.delete.picture']);

        Route::resource('felhasznalo-csoport', 'GroupsController');
    });
});

/**
 * -----------------------------------------------------------------------------
 * Admin menu
 * -----------------------------------------------------------------------------
 *
 * Az adminfelülethez tarozó menu-k.
 *
 */
if (Request::is('admin') || Request::is('admin/*')) {

    Menu::make('adminMenu', function ($menu) {

        $menu->add('<i class="fa fa-dashboard"></i> Vezérlőpult',
            ['route' => 'admin.vezerlopult']);

        /**
         * Bejegyzés menüpont
         */
        $menu->add('Bejegyzés', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-pencil"></i> ');

        $menu->get('bejegyzés')->add('Új hozzáadása',
            ['route' => 'admin.hir.create'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('bejegyzés')->add('Összes hír',
            ['route' => 'admin.hir.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        /**
         *
         */
        $menu->add('Esemény', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-calendar"></i> ');

        $menu->get('esemény')->add('Új hozzáadása',
            ['route' => 'admin.esemeny.create'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('esemény')->add('Összes esemény',
            ['route' => 'admin.esemeny.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        /**
         * Média menüpont
         */
        $menu->add('Média', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-photo"></i> ')
            ->active('/admin/dokumentum-kategoria/*');

        $menu->get('média')->add('Képgaléria',
            ['route' => 'admin.galeria.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('média')->add('Dokumentumok',
            ['route' => 'admin.dokumentum.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ')
            ->active('admin/dokumentum-kategoria/*');

        /**
         * Oldal menüpont
         */
        $menu->add('Oldal', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-file-text-o"></i> ');

        $menu->get('oldal')->add('Új oldal',
            ['route' => 'admin.oldal.create'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('oldal')->add('Összes oldal',
            ['route' => 'admin.oldal.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        /**
         * Pályázat menüpont
         */
        $menu->add('Pályázat', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-file-powerpoint-o"></i> ');

        $menu->get('pályázat')->add('Új pályázat',
            ['route' => 'admin.palyazat.create'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('pályázat')->add('Összes pályázat',
            ['route' => 'admin.palyazat.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        /**
         * Menükezelő menüpont
         */
        $menu->add('<i class="fa fa-bars"></i> Menü kezelő',
            ['route' => 'admin.menu-kezelo.create']);


        /**
         * Felhasználók menüpont
         */

        $menu->add('Felhasználók', ['class' => 'treeview'])
            ->append('<i class="fa pull-right fa-angle-left"></i>')
            ->prepend('<i class="fa fa-users"></i> ');

        $menu->get('felhasználók')->add('Új hozzáadása',
            ['route' => 'admin.felhasznalok.felhasznalo.create'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');

        $menu->get('felhasználók')->add('Összes felhasználó',
            ['route' => 'admin.felhasznalok.felhasznalo.index'])
            ->prepend('<i class="fa fa-angle-double-right "></i> ');


    });
}
