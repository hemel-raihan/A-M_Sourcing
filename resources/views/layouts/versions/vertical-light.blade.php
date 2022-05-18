<!doctype html>
<html lang="en">
	<head>
		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Kodepress designed by Datahostit">
		<meta name="author" content="Datahost It">
		<meta name="keywords" content="admin, CMS, bootstrap 5, dashboard, laravel, laravel admin, laravel admin panel, laravel admin template, laravel blade, laravel dashboard, laravel dashboard template, laravel mvc, laravel php, laravel ui template, ui kit">

        <!-- TITLE -->
        <title>Admin Dashboard</title>
        @php
        $setting  = \App\Models\Admin\Setting::where([['id',1]])->orderBy('id','desc')->first();
        @endphp
        @include('layouts.vertical.styles')
        @FilemanagerScript

	</head>

	<body class="app sidebar-mini">

		<!-- GLOBAL-LOADER -->


        @isset($setting)
        @if ($setting->preloader_status == 1)
        <div id="global-loader">
			<img src="{{ asset('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
		</div>
        @endif
        @endisset


		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

            @include('layouts.vertical.app-sidebar')

            @include('layouts.vertical.mobile-header')

                <!--app-content open-->
				<div class="app-content">
					<div class="side-app">

                        @yield('content')

					</div>
				</div>
				<!-- CONTAINER END -->
            </div>

            @include('layouts.sidebar-right')

            @include('layouts.footer')

            @yield('modal')

		</div>


        @include('layouts.vertical.scripts')
        @include('layouts.vertical.dragscripts')
	</body>
</html>
