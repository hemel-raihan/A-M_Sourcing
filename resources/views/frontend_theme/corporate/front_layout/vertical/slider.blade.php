@php
    $page = \App\Models\Pagebuilder\Custompage::where([['type','=','main-page'],['status','=',true]])->orderBy('id','desc')->first();
    $slider = \App\Models\Admin\Slide\Slider::where('status','=',true)->first();
@endphp
{{-- <div class="container-lg" style="background: #19a1dd;">
    <div class="container-md" style="background: white;"> --}}
        @isset($slider)


                    @if ($slider->container == 'container-sm')
                    <div class="container-sm">
                        <div class="main-div">

                    <section id="slider" class=" slider-element swiper_wrapper min-vh-{{$slider->width}} min-vh-md-{{$slider->height}}">
                        <div class="slider-inner">

                            <div class="swiper-container swiper-parent">
                                <div class="swiper-wrapper">
                                    @foreach ($slider->slides as $mainslide)
                                    <div class="swiper-slide dark">
                                        <div class="container">
                                            <div class="slider-caption slider-caption-center">
                                                <h2 data-animate="fadeInUp">{{$mainslide->title}}</h2>
                                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">{!!$mainslide->content!!}</p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/slide_image/'.$mainslide->slideimage)}}');"></div>
                                    </div>
                                    @endforeach
                                    {{-- <div class="swiper-slide dark">
                                        <div class="container">
                                            <div class="slider-caption slider-caption-center">
                                                <h2 data-animate="fadeInUp">Beautifully Flexible</h2>
                                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
                                            </div>
                                        </div>
                                        <div class="video-wrap">
                                            <video poster="images/videos/explore-poster.jpg" preload="auto" loop autoplay muted>
                                                <source src='images/videos/explore.mp4' type='video/mp4' />
                                                <source src='images/videos/explore.webm' type='video/webm' />
                                            </video>
                                            <div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="container">
                                            <div class="slider-caption">
                                                <h2 data-animate="fadeInUp">Great Performance</h2>
                                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">You'll be surprised to see the Final Results of your Creation &amp; would crave for more.</p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/slider/3.jpg')}}'); background-position: center top;"></div>
                                    </div> --}}
                                </div>
                                <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
                                <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
                                <div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
                            </div>

                        </div>
                    </section>
                        </div>
                    </div>

                    @else

                    {{-- <section id="slider" class=" slider-element swiper_wrapper min-vh-{{$slider->width}} min-vh-md-{{$slider->height}}"> --}}
                        <section id="slider" class=" slider-element swiper_wrapper  min-vh-md-{{$slider->height}}" style="min-height: {{$slider->width}}vh;">
                        <div class="slider-inner">

                            <div class="swiper-container swiper-parent">
                                <div class="swiper-wrapper">
                                    @foreach ($slider->slides as $mainslide)
                                    <div class="swiper-slide dark">
                                        <div class="container">
                                            <div class="slider-caption slider-caption-center" >
                                                <h2 data-animate="fadeInUp">{{$mainslide->title}}</h2>
                                                <p  class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">{!!$mainslide->content!!}</p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/slide_image/'.$mainslide->slideimage)}}');"></div>
                                    </div>
                                    @endforeach
                                    {{-- <div class="swiper-slide dark">
                                        <div class="container">
                                            <div class="slider-caption slider-caption-center">
                                                <h2 data-animate="fadeInUp">Beautifully Flexible</h2>
                                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>
                                            </div>
                                        </div>
                                        <div class="video-wrap">
                                            <video poster="images/videos/explore-poster.jpg" preload="auto" loop autoplay muted>
                                                <source src='images/videos/explore.mp4' type='video/mp4' />
                                                <source src='images/videos/explore.webm' type='video/webm' />
                                            </video>
                                            <div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="container">
                                            <div class="slider-caption">
                                                <h2 data-animate="fadeInUp">Great Performance</h2>
                                                <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">You'll be surprised to see the Final Results of your Creation &amp; would crave for more.</p>
                                            </div>
                                        </div>
                                        <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/slider/3.jpg')}}'); background-position: center top;"></div>
                                    </div> --}}
                                </div>
                                <div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
                                <div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
                                <div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
                            </div>

                        </div>
                    </section>

                    @endif

                    @endisset
    {{-- </div>
</div> --}}


