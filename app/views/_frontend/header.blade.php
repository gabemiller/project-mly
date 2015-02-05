<header class="bg-parallax">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="logo">
                {{HTML::decode(HTML::linkRoute('fooldal','<h1>Bánhorváti.hu</h1>',array(),array('class'=>'logo-link')))}}
            </div>
        </div>
    </div>

    <div class="container header-bottom">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h2 class="welcome">Köszöntjük Mályinka község weboldalán!</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="top-bar main-shadow-top">
                    @yield('breadcrumb')
                </div>
            </div>
        </div>
    </div>

</header>