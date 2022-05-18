<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    @include('frontend_theme.corporate.front_layout.vertical.styles')

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
    @php
    $setting  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
    @endphp
    @isset($setting)
	<title>{{$setting->company_name}}</title>
    <link rel="icon" sizes="16x16" type="image/gif" href="{{asset('uploads/settings/'.$setting->logo)}}">
    @else
    <title>Home</title>
    @endisset

</head>

<body class="stretched">

    

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix" >


        <!-- Header
		============================================= -->



            @php
            $menus = \App\Models\Frontmenu\Frontmenu::with('menuItems')->where([['type','=','main-menu'],['status','=',true]])->first();
            // foreach($menus as $menu)
            // {
            //     $menuitems = $menu->menuItems;
            // }
            $menuitems = $menus->menuItems()->with('childs')->get();
            @endphp

            @isset($menus)

            @include('frontend_theme.corporate.front_layout.vertical.header',['menuitems'=>$menuitems])
            @else
            @include('frontend_theme.corporate.front_layout.vertical.header')
            @endisset




        {{-- ........header end........ --}}

        <!-- Slider start
		============================================= -->
        {{-- @if (!Request::is('default*') && !Request::is('blog/details*')  && !Request::is('gallery/all*'))
        @include('frontend_theme.corporate.front_layout.vertical.slider')
        @endif --}}
        {{-- @if (!Request::is('default*') && !Request::is('blog/details*') && !Request::is('service/details*')  && !Request::is('gallery/all*')) --}}

        @if (Route::current()->getName() == 'home')

        @include('frontend_theme.corporate.front_layout.vertical.slider')

        @endif

        <!-- Slider end
		============================================= -->



		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
                @php
                    $page = \App\Models\Pagebuilder\Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
                @endphp
                {{-- <div class="container-lg" style="background: #19a1dd;">
                    <div class="container-md" style="background: #f9fdff;"> --}}
                        {{-- <div class="body"> --}}
                            {{-- <div class="{{($page->container == 'container-sm') ? 'container-sm' : '' }}">
                                <div class="main-div"> --}}
                                    <section id="content" style="background-image: url('{{asset('uploads/custompagephoto/'.$page->background_img)}}'); background: {{$page->background_color}}; margin-left: {{$page->left_margin}}; margin-right: {{$page->right_margin}};">
                                        <div class="content-wrap">
                                           <div class="{{($page->container == 'container-sm') ? 'container-sm' : 'container-lg' }} clearfix">
                                                <div class="row">
                                                    @if(!$page->leftsidebar_id == 0)
                                                    @php
                                                    $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Left Side Bar'],['id','=',$page->leftsidebar_id]])->get();
                                                    foreach($sidebars as $sidebar)
                                                    {
                                                        $widgets = $sidebar->widgets()->get();
                                                    }
                                                    @endphp

                                                    @include('frontend_theme.corporate.front_layout.vertical.left_sidebar',['widgets'=>$widgets])
                                                    @endif

                                                    @yield('content')

                                                    @if(!$page->rightsidebar_id == 0)
                                                    @php
                                                    $sidebars = \App\Models\Admin\Sidebar::where([['type','=','Right Side Bar'],['id','=',$page->rightsidebar_id]])->get();
                                                    foreach($sidebars as $sidebar)
                                                    {
                                                        $widgets = $sidebar->widgets()->get();
                                                    }
                                                    @endphp
                                                    @include('frontend_theme.corporate.front_layout.vertical.right_sidebar',['widgets'=>$widgets])
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                {{-- </div>
                            </div> --}}
                        {{-- </div> --}}


                    {{-- </div>
                </div> --}}


			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->

        @php
        $footer_menus = \App\Models\Frontmenu\Frontmenu::where([['type','=','footer-menu'],['status','=',true]])->get();
        foreach($footer_menus as $footer_menu)
        {
            $footer_menuitems = $footer_menu->menuItems()->with('childs')->get();
        }
        @endphp
        @isset($footer_menuitems)
        @include('frontend_theme.corporate.front_layout.vertical.footer',['footer_menuitems'=>$footer_menuitems])
        @else
        @include('frontend_theme.corporate.front_layout.vertical.footer')
        @endisset

		<!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

    @include('frontend_theme.corporate.front_layout.vertical.scripts')


</body>
</html>
