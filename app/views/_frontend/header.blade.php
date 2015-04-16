<header class="bg-parallax">
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="logo">
                {{HTML::decode(HTML::linkRoute('fooldal','<h1>Mályinka.hu</h1>',array(),array('class'=>'logo-link')))}}
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
            <div class="col-xs-12">
                <div class="top-bar main-shadow-top">
                    <div class="col-md-6 col-lg-6">
                        @yield('breadcrumb')
                    </div>
                    <div class="col-md-6 col-lg-6">

                        @if(isset($am)&&!empty($am))
                            {{HTML::link('/akadalymentes/torol','Normál nézet',['class'=>'btn-am'])}}
                        @else
                            {{HTML::link('/akadalymentes/letrehoz','Akadálymentes nézet',['class'=>'btn-am'])}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>