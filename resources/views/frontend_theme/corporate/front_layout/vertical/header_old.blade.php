
@php
$navbar = \App\Models\Appearance_Settings\Navbarsetting::find(1);
// $page = \App\Models\Appearance_Settings\Navbarsetting::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
@endphp
@isset($navbar)
@if ($navbar->container == 'container-sm')
<header id="header" class="full-header transparent-header dark">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                {{-- @php
                    $logo  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
                @endphp --}}
                @isset($setting)
                <div id="logo">
                    <a href="{{route('home')}}" class="standard-logo" data-dark-logo="{{asset('uploads/settings/'.$setting->logo)}}"><img src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Canvas Logo"></a>
                    <a href="{{route('home')}}" class="retina-logo" data-dark-logo="{{asset('uploads/settings/'.$setting->logo)}}"><img src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Canvas Logo"></a>
                </div><!-- #logo end -->
                @endisset

                <div class="header-misc">

                    <!-- Top Search
                    ============================================= -->
                    {{-- <div id="top-search" class="header-misc-icon">
                        <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
                    </div><!-- #top-search end --> --}}

                    <!-- Top Cart
                    ============================================= -->
                    <div id="top-cart" class="header-misc-icon d-none d-sm-block">
                        <a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">5</span></a>
                        <div class="top-cart-content">
                            <div class="top-cart-title">
                                <h4>Shopping Cart</h4>
                            </div>
                            <div class="top-cart-items">
                                <div class="top-cart-item">
                                    <div class="top-cart-item-image">
                                        <a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
                                    </div>
                                    <div class="top-cart-item-desc">
                                        <div class="top-cart-item-desc-title">
                                            <a href="#">Blue Round-Neck Tshirt with a Button</a>
                                            <span class="top-cart-item-price d-block">$19.99</span>
                                        </div>
                                        <div class="top-cart-item-quantity">x 2</div>
                                    </div>
                                </div>
                                <div class="top-cart-item">
                                    <div class="top-cart-item-image">
                                        <a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
                                    </div>
                                    <div class="top-cart-item-desc">
                                        <div class="top-cart-item-desc-title">
                                            <a href="#">Light Blue Denim Dress</a>
                                            <span class="top-cart-item-price d-block">$24.99</span>
                                        </div>
                                        <div class="top-cart-item-quantity">x 3</div>
                                    </div>
                                </div>
                            </div>
                            <div class="top-cart-action">
                                <span class="top-checkout-price">$114.95</span>
                                <a href="#" class="button button-3d button-small m-0">View Cart</a>
                            </div>
                        </div>
                    </div><!-- #top-cart end -->

                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu">

                    <ul class="menu-container">
                         {{-- <li class="menu-item"> --}}
                            @isset($menuitems)
                            @foreach ($menuitems as $menuitem)
                            @if($menuitem->childs->isEmpty())
                            @if ($menuitem->slug != null)
                            <li class="menu-item">
                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$menuitem->slug)}}"><div>{{$menuitem->title}}</div></a>
                            </li>
                            @else
                            <li class="menu-item">
                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{$menuitem->url}}"><div>{{$menuitem->title}}</div></a>
                            </li>
                            @endif
                            @else
                            <li class="menu-item">
                                @if ($menuitem->slug != null)
                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$menuitem->title}}</div></a>
                                @else
                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$menuitem->title}}</div></a>
                                @endif
                                <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                    @foreach ($menuitem->childs as $item)
                                    @if ($item->childs->isEmpty())
                                    <li class="menu-item">
                                        <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$item->slug)}}"><div>{{$item->title}}</div></a>
                                    </li>
                                    @else
                                    <li class="menu-item">
                                        <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$item->title}}</div></a>
                                        <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                            @foreach ($item->childs as $itemm)
                                            @if ($itemm->childs->isEmpty())
                                            <li class="menu-item">
                                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$itemm->slug)}}"><div>{{$itemm->title}}</div></a>
                                            </li>
                                            @else
                                            <li class="menu-item">
                                                <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$itemm->title}}</div></a>
                                                <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                                    @foreach ($itemm->childs as $itemmm)
                                                    <li class="menu-item">
                                                        <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$itemmm->slug)}}"><div>{{$itemmm->title}}</div></a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endif
                                            @endforeach

                                        </ul>
                                    </li>
                                    @endif

                                    @endforeach

                                </ul>
                            </li>
                            @endif
                            @endforeach
                            @endisset
                    </ul>

                </nav><!-- #primary-menu end -->

                {{-- <form class="top-search-form" action="search.html" method="get">
                    <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
                </form> --}}

            </div>
        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header><!-- #header end -->
<div>

    @else

    <header id="header" class="full-header transparent-header dark">
        @include('frontend_theme.corporate.front_layout.vertical.topbar')
        <div id="header-wrap">
            <div class="container">
                <div class="header-row">

                    <!-- Logo
                    ============================================= -->
                    {{-- @php
                        $logo  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
                    @endphp --}}
                    @isset($setting)
                    <div id="logo">
                        <a href="{{route('home')}}" class="standard-logo" data-dark-logo="{{asset('uploads/settings/'.$setting->logo)}}"><img src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Canvas Logo"></a>
                        <a href="{{route('home')}}" class="retina-logo" data-dark-logo="{{asset('uploads/settings/'.$setting->logo)}}"><img src="{{asset('uploads/settings/'.$setting->logo)}}" alt="Canvas Logo"></a>
                    </div><!-- #logo end -->
                    @endisset

                    <div class="header-misc">

                        <!-- Top Search
                        ============================================= -->
                        {{-- <div id="top-search" class="header-misc-icon">
                            <a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
                        </div><!-- #top-search end --> --}}

                        <!-- Top Cart
                        ============================================= -->


                    </div>

                    <div id="primary-menu-trigger">
                        <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                    </div>

                    <!-- Primary Navigation
                    ============================================= -->
                    <nav class="primary-menu">

                        <ul class="menu-container">
                             {{-- <li class="menu-item"> --}}
                                @isset($menuitems)
                                @foreach ($menuitems as $menuitem)
                                @if($menuitem->childs->isEmpty())
                                @if ($menuitem->slug != null)
                                <li class="menu-item">
                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$menuitem->slug)}}"><div>{{$menuitem->title}}</div></a>
                                </li>
                                @else
                                <li class="menu-item">
                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{$menuitem->url}}"><div>{{$menuitem->title}}</div></a>
                                </li>
                                @endif
                                @else
                                <li class="menu-item">
                                    @if ($menuitem->slug != null)
                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$menuitem->title}}</div></a>
                                    @else
                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$menuitem->title}}</div></a>
                                    @endif
                                    <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                        @foreach ($menuitem->childs()->with('childs')->get() as $item)
                                        @if ($item->childs->isEmpty())
                                        <li class="menu-item">
                                            <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$item->slug)}}"><div>{{$item->title}}</div></a>
                                        </li>
                                        @else
                                        <li class="menu-item">
                                            <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$item->title}}</div></a>
                                            <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                                @foreach ($item->childs()->with('childs')->get() as $itemm)
                                                @if ($itemm->childs->isEmpty())
                                                <li class="menu-item">
                                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$itemm->slug)}}"><div>{{$itemm->title}}</div></a>
                                                </li>
                                                @else
                                                <li class="menu-item">
                                                    <a class="menu-link" style="color: {{$navbar->text_color}}" href="#"><div>{{$itemm->title}}</div></a>
                                                    <ul class="sub-menu-container" style="background: {{$navbar->background_color}}">
                                                        @foreach ($itemm->childs()->with('childs')->get() as $itemmm)
                                                        <li class="menu-item">
                                                            <a class="menu-link" style="color: {{$navbar->text_color}}" href="{{route('page',$itemmm->slug)}}"><div>{{$itemmm->title}}</div></a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                @endif
                                                @endforeach

                                            </ul>
                                        </li>
                                        @endif

                                        @endforeach

                                    </ul>
                                </li>
                                @endif
                                @endforeach
                                @endisset
                        </ul>

                    </nav><!-- #primary-menu end -->

                    {{-- <form class="top-search-form" action="search.html" method="get">
                        <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
                    </form> --}}

                </div>
            </div>
        </div>
        <div class="header-wrap-clone"></div>
    </header><!-- #header end -->

@endif
@endisset
