<style>
    .centered {
        position: absolute;
        top: 50%;
        left: 35%;
        transform: translate(-50%, -50%);
        width: 70%;
        height: 50%;
        padding: 0px 10px;
        /* background: #f2f4f4; */
        background: rgba(204, 204, 204, 0.5);
        margin-left: 18px;
        }
    .centered a,h5{
        color: #fff;
        font-weight: bold;
        text-decoration: none;
        outline: 0 solid;
    }
    .post-cat{
        position: absolute;
        left: 0;
        top: 0;
        margin-left: 30px;

        /* position: relative; */
        z-index: 1;
        display: inline-block;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0px 10px;
        /* margin-left: 40px; */
        line-height: 21px;
        height: 19px;
        /* top: -1px; */
        letter-spacing: .55px;
    }
    .ts-orange-bg {
        background: #ff6e0d;
    }
</style>
@php
    $slider = \App\Models\Admin\Slide\Slider::where('status','=',true)->first();
@endphp
{{-- <div id="particles-js"> --}}

<section id="particles-js" class=" slider-element swiper_wrapper min-vh-60 min-vh-md-80" style="height: 900px">
{{-- <img src="{{asset('uploads/slide_image/-6225dbf1ded13.jpg')}}"> --}}
<div class="row">
<div class="col-12" style="text-align: center; position: absolute; z-index: 1; top: 28%;">
    <h2 data-animate="fadeInUp" style="color: white;">AGILE1TECH CORP.</br>

        PASSIONATE FOR THE RIGHT SOLUTION

    </h2>
</div>
</div>

{{-- <div class="slider-inner">

    <div class="swiper-container swiper-parent">
        <div class="swiper-wrapper">
            <div class="swiper-slide dark">
                <div class="container">

                    <div class="slider-caption slider-caption-center">
                        <h2 data-animate="fadeInUp">AGILE1TECH CORP.</br>

                            PASSIONATE FOR THE RIGHT SOLUTION

                        </h2>
                        {{-- <div id="oc-portfolio" class="owl-carousel portfolio-carousel carousel-widget" data-margin="20" data-pagi="false" data-autoplay="5000" data-items-xs="2" data-items-sm="3" data-items-md="3" data-items-xl="4">
                            @foreach ($slider->slides as $mainslide)
                            <div class="portfolio-item">
                                <div class="portfolio-image">
                                    <a href="portfolio-single.html">
                                        <img style="height: 200px;
                                        width: 200px;
                                        border-radius: 50%;
                                        margin-top: 100px;"
                                        src="{{asset('uploads/slide_image/'.$mainslide->slideimage)}}" alt="Open Imagination">
                                    </a>
                                    <div class="centered"><a href="#" style="color:#4b6ca9; font-size: 14px">asdasdasdasdasdasd</a></div>
                                    <div class="bg-overlay">
                                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-speed="350">
                                            <a href="{{asset('uploads/slide_image/'.$mainslide->slideimage)}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeInUpSmall" data-hover-speed="350" data-lightbox="image"><i class="icon-line-plus"></i></a>
                                        </div>
                                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-speed="350"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}

                    </div>
                </div>
                {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/slide_image/-6225dbf1ded13.jpg')}}');"></div> --}}
                <div class="swiper-slide-bg"></div>
            </div>
        </div>
    </div>
</div>

</section>
