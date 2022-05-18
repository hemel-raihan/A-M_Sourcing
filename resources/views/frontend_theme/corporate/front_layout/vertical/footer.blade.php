@php
    $footer = \App\Models\Appearance_Settings\Footersetting::find(1);
@endphp
@isset($footer)


        @if ($footer->container == 'container-sm')
        <div class="container-sm">
            <div class="main-div">
        <footer id="footer" style="background: {{$footer->background_color}};">
            <div class="container" style="margin-left: {{$footer->left_margin}}; margin-right: {{$footer->right_margin}};">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap">

                    <div class="row col-mb-50">
                        <div class="col-lg-8">

                            <div class="row col-mb-50">
                                <div class="col-md-4">

                                    <div class="widget clearfix">

                                        {{-- @php
                                        $setting  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
                                        @endphp --}}
                                        @isset($setting)
                                        <img width="200" src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Image" class="footer-logo">
                                        @endisset



                                        <p style="color: {{$footer->text_color}}">{{$setting->company_slogan}}</p>

                                        {{-- <div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%;">
                                            <address>
                                                <strong>Headquarters:</strong><br>
                                                795 Folsom Ave, Suite 600<br>
                                                San Francisco, CA 94107<br>
                                            </address>
                                            <abbr title="Phone Number"><strong>Phone:</strong></abbr> (1) 8547 632521<br>
                                            <abbr title="Fax"><strong>Fax:</strong></abbr> (1) 11 4752 1433<br>
                                            <abbr title="Email Address"><strong>Email:</strong></abbr> info@canvas.com
                                        </div> --}}

                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <div class="widget widget_links clearfix">

                                        {{-- <h4>Blogroll</h4> --}}

                                        <ul>
                                            @isset($footer_menuitems)
                                            @foreach ($footer_menuitems as $footer_menuitem)
                                            @if ($footer_menuitem->url == null)
                                            <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_menuitem->slug)}}">{{$footer_menuitem->title}}</a></li>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </ul>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="widget widget_links clearfix">

                                        {{-- <h4>Blogroll</h4> --}}

                                        <ul>
                                            @isset($footer_menuitems)
                                            @foreach ($footer_menuitems as $footer_menuitem)
                                            @if ($footer_menuitem->slug == null)
                                            <li><a style="color: {{$footer->text_color}}" href="{{$footer_menuitem->url}}">{{$footer_menuitem->title}}</a></li>
                                            @endif
                                            @endforeach
                                            @endisset
                                        </ul>

                                    </div>

                                    {{-- <div class="widget clearfix">
                                        <h4>Recent Posts</h4>

                                        <div class="posts-sm row col-mb-30" id="post-list-footer">
                                            <div class="entry col-12">
                                                <div class="grid-inner row">
                                                    <div class="col">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row">
                                                    <div class="col">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Elit Assumenda vel amet dolorum quasi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="entry col-12">
                                                <div class="grid-inner row">
                                                    <div class="col">
                                                        <div class="entry-title">
                                                            <h4><a href="#">Debitis nihil placeat, illum est nisi</a></h4>
                                                        </div>
                                                        <div class="entry-meta">
                                                            <ul>
                                                                <li>10th July 2021</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">

                            <div class="row col-mb-50">
                                {{-- <div class="col-md-4 col-lg-12">
                                    <div class="widget clearfix" style="margin-bottom: -20px;">

                                        <div class="row">
                                            <div class="col-lg-6 bottommargin-sm">
                                                <div class="counter counter-small"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true"></span></div>
                                                <h5 class="mb-0">Total Downloads</h5>
                                            </div>

                                            <div class="col-lg-6 bottommargin-sm">
                                                <div class="counter counter-small"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true"></span></div>
                                                <h5 class="mb-0">Clients</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-5 col-lg-12">
                                    <div class="widget subscribe-widget clearfix">
                                        <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                                        <div class="widget-subscribe-form-result"></div>
                                        <form id="widget-subscribe-form" action="include/subscribe.php" method="post" class="mb-0">
                                            <div class="input-group mx-auto">
                                                <div class="input-group-text"><i class="icon-email2"></i></div>
                                                <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                                                <button class="btn btn-success" type="submit">Subscribe</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> --}}

                                <div class="col-md-3 col-lg-12">
                                    <div class="widget clearfix" style="margin-bottom: -20px;">

                                        <div class="row">
                                            <div class="col-6 col-md-12 col-lg-6 clearfix bottommargin-sm">
                                                <a href="{{$setting->facebook_link}}" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
                                                    <i class="icon-facebook"></i>
                                                    <i class="icon-facebook"></i>
                                                </a>
                                                <a style="color: {{$footer->text_color}}" href="{{$setting->facebook_link}}"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div><!-- .footer-widgets-wrap end -->

            </div>

            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">
                <div class="container">

                    <div class="row col-mb-30">

                        <div style="color: {{$footer->text_color}}" class="col-md-6 text-center text-md-start">
                            Copyrights &copy; 2022 All Rights Reserved by 1plusoverseas. Powered by: <a href="https://datahostbd.com/">datahostbd.com</a>
                        </div>

                        {{-- <div class="col-md-6 text-center text-md-end">
                            <div class="d-flex justify-content-center justify-content-md-end">
                                <a href="#" class="social-icon si-small si-borderless si-facebook">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-twitter">
                                    <i class="icon-twitter"></i>
                                    <i class="icon-twitter"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-gplus">
                                    <i class="icon-gplus"></i>
                                    <i class="icon-gplus"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-pinterest">
                                    <i class="icon-pinterest"></i>
                                    <i class="icon-pinterest"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-vimeo">
                                    <i class="icon-vimeo"></i>
                                    <i class="icon-vimeo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-github">
                                    <i class="icon-github"></i>
                                    <i class="icon-github"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-yahoo">
                                    <i class="icon-yahoo"></i>
                                    <i class="icon-yahoo"></i>
                                </a>

                                <a href="#" class="social-icon si-small si-borderless si-linkedin">
                                    <i class="icon-linkedin"></i>
                                    <i class="icon-linkedin"></i>
                                </a>
                            </div>

                            <div class="clear"></div>

                            <i class="icon-envelope2"></i> info@canvas.com <span class="middot">&middot;</span> <i class="icon-headphones"></i> +1-11-6541-6369 <span class="middot">&middot;</span> <i class="icon-skype2"></i> CanvasOnSkype
                        </div> --}}

                    </div>

                </div>
            </div><!-- #copyrights end -->
        </footer>
    </div>
</div>

@else

<footer id="footer" style="background: {{$footer->background_color}};">
    <div class="container">

        <!-- Footer Widgets
        ============================================= -->
        <div class="footer-widgets-wrap">

            <div class="row col-mb-50">
                <div class="col-lg-12">

                    <div class="row col-mb-50">
                        <div class="col-md-4">

                            <div class="widget clearfix">

                                {{-- @php
                                $setting  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
                                @endphp --}}
                                @isset($setting)
                                <img width="200" src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Image" class="footer-logo">
                                @endisset



                                <p style="color: {{$footer->text_color}}">{{$setting->company_slogan}}</p>

                                {{-- <div style="background: url('images/world-map.png') no-repeat center center; background-size: 100%; color: {{$footer->text_color}};">
                                    <address>
                                        <strong>Headquarters:</strong><br>
                                        {{$setting->contact}}<br>
                                    </address>
                                    <abbr title="Phone Number"><strong>Phone:</strong></abbr>{{$setting->phone}}<br>
                                    <abbr title="Email Address"><strong>Email:</strong></abbr> {{$setting->email}}
                                </div> --}}

                            </div>

                        </div>

                @isset($footer_menuitems)
                @foreach ($footer_menuitems as $footer_menuitem)

                <div class="col-lg-2 col-md-8 pb-2 pb-sm-0">
                    <div class="widget">
                        <h4 style="color: {{$footer->text_color}}" class="widget-title pb-1">{{$footer_menuitem->title}}</h4>
                        @if(!$footer_menuitem->childs->isEmpty())
                        <ul>
                            @foreach ($footer_menuitem->childs as $footer_item)
                            @if ($footer_item->slug == null)
                            <li><a style="color: {{$footer->text_color}}" href="{{$footer_item->url}}">{{$footer_item->title}}</a></li>
                            @else
                            <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_item->slug)}}">{{$footer_item->title}}</a></li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                @endforeach
                @endisset

                <div class="col-md-4">
                    <div class="widget  clearfix">
                        <h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Inside Scoops:</h5>
                        <div class="widget-subscribe-form-result"></div>
                        <form method="POST" action="{{route('subscriber.store')}}" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                             @endif
                            <div class="input-group mx-auto">
                                <div class="input-group-text"><i class="icon-email2"></i></div>
                                <input type="email" id="widget-subscribe-form-email" name="email" class="form-control required email" placeholder="Enter your Email">
                                <button class="btn btn-success" type="submit">Subscribe</button>
                            </div>

                        </form>
                    </div>
                </div>

                        {{-- <div class="col-md-4">
                            <div class="widget widget_links clearfix">


                                <ul>
                                    @isset($footer_menuitems)
                                    @foreach ($footer_menuitems as $footer_menuitem)
                                    @if ($footer_menuitem->url == null)
                                    <li><a style="color: {{$footer->text_color}}" href="{{route('page',$footer_menuitem->slug)}}">{{$footer_menuitem->title}}</a></li>
                                    @endif
                                    @endforeach
                                    @endisset
                                </ul>

                            </div>

                        </div> --}}

                        {{-- <div class="col-md-4">

                            <div class="widget widget_links clearfix">


                                <ul>
                                    @isset($footer_menuitems)
                                    @foreach ($footer_menuitems as $footer_menuitem)
                                    @if ($footer_menuitem->slug == null)
                                    <li><a style="color: {{$footer->text_color}}" href="{{$footer_menuitem->url}}">{{$footer_menuitem->title}}</a></li>
                                    @endif
                                    @endforeach
                                    @endisset
                                </ul>

                            </div>



                        </div> --}}
                    </div>

                </div>
            </div>

        </div><!-- .footer-widgets-wrap end -->

    </div>

    <div id="copyrights" style="background: #fff">
        <div class="container">

            <div class="row col-mb-30">

                <div style="color: {{$footer->text_color}};" class="text-center text-md-start">
                   <p style="text-align: center;"> Copyrights &copy; 2022 All right reserved by <a href="https://datahostbd.com/">Datahostbd</a></p>
                </div>



            </div>

        </div>
    </div><!-- #copyrights end -->


</footer>

@endif


@endisset

