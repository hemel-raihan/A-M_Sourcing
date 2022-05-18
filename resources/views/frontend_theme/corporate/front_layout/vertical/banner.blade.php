

@isset($custom_page)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$custom_page->title}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/pagephoto/'.$custom_page->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($servicc)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$servicc->title}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($productt)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$productt->title}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset

@isset($pricecategory)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$pricecategory->name}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($alljobs)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">Career</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset

@isset($servicecategory)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$servicecategory->name}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($pricecategories)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">Price Categories</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($blog)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">{{$blog->name}}</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


@isset($Faq)
<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">FAQ</h2>
                        </div>
                    </div>
                    {{-- <div class="swiper-slide-bg" style="background-image: url('{{asset('uploads/servicephoto/'.$servicc->image)}}');"></div> --}}
                    <div class="swiper-slide-bg" style="background-image: url('{{asset('assets/frontend/images/banner.png')}}');"></div>
                    <div class="swiper-slide-bg"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset


