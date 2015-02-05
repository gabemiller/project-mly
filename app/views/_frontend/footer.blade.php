<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="main-shadow footer-box">
                    <h3>Elérhetőség</h3>
                    <dl>
                        <dt>Polgármesteri hivatal</dt>
                        <dd>3645 Mályinka, Rákóczi út 5.</dd>
                        <dt>Telefon</dt>
                        <dd></dd>
                        <dt>Fax</dt>
                        <dd></dd>
                        <dt>Email</dt>
                        <dd>{{HTML::mailto('info@banhorvati.hu')}}</dd>
                    </dl>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <div class="main-shadow footer-box">
                    <h3>Legfrissebb hírek</h3>

                    @foreach($articleFooter as $article)
                        <div class="article-footer">
                            <h4>{{HTML::linkRoute('hirek.show',$article->title,array('id'=>$article->id,'title'=>$article->id))}}</h4>

                            <p class="small text-muted">
                                <strong>{{$article->getAuthorName()}}</strong>, {{$article->getCreateDate()}} </p>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 hidden-xs hidden-sm">
                <div class="main-shadow footer-box">
                    <h3>Kövessen minket!</h3>

                    <div class="fb-like-box"
                         data-href="https://www.facebook.com/pages/Mályinka/104075596294299?fref=ts"
                         data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false"
                         data-show-border="false"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <p class="footer-text">© 2014 Mályinka - Minden jog fenntartva.</p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        {{HTML::decode(HTML::link('http://divide.hu','<h5 class="footer-logo">Divide.hu</h5>',array('target'=>'_blank','class'=>'footer-logo-link')))}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>