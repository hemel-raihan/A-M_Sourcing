<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('assets/frontend/js/jquery.js') }}"></script>
	<script src="{{ asset('assets/frontend/js/plugins.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('assets/frontend/js/functions.js') }}"></script>
    <script src="{{ asset('js/iziToast.js') }}"></script>

    @yield('scripts')
	<script type="text/javascript" src="{{ asset('assets/frontend/particle_js/particles.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/particle_js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/particle_js/particle_new.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/particle_js/app_new.js') }}"></script>
    @include('vendor.lara-izitoast.toast')
