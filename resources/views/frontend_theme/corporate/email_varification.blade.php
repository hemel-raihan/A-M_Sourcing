@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')

<section class=" slider-element swiper_wrapper " style="height: 300px;">
    <div class="slider-inner">

        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container">
                        <div class="slider-caption slider-caption-center">
                            <h2 data-animate="fadeInUp">Email Varification</h2>
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

            @if ($page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
            <div class="postcontent col-lg-12">
            @elseif(!$page->rightsidebar_id == 0 && $page->leftsidebar_id == 0)
            <div class="postcontent col-lg-9">
            @elseif($page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
            <div class="postcontent col-lg-9">
            @elseif(!$page->rightsidebar_id == 0 && !$page->leftsidebar_id == 0)
            <div class="postcontent col-lg-6">
            @endif

            <section id="content">
                <div class="content-wrap">
                    <div class="container clearfix">

                        <div class="accordion accordion-lg mx-auto mb-0 clearfix" style="max-width: 550px;">

                            <div class="accordion-header">
                                <div class="accordion-icon">
                                    <i class="accordion-closed icon-lock3"></i>
                                    <i class="accordion-open icon-unlock"></i>
                                </div>
                                <div class="accordion-title">
                                    Verifie yout email Id
                                </div>
                            </div>
                            <div class="accordion-content clearfix">
                                <form id="billing-form" name="billing-form" class="row mb-0" action="{{route('email.varified')}}" method="post">
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
                                    <div class="col-12 form-group">
                                        <label for="login-form-username">Email Varification Code:</label>
                                        <input type="text" id="login-form-username" name="code" value="" class="form-control" />
                                    </div>

                                    <input type="hidden" value="{{$address->email_verified_code}}" name="email_verified_code">
                                    <input type="hidden" value="{{$price->id}}" name="price_id">
                                    <input type="hidden" value="{{$address->id}}" name="address_id">

                                    <div class="col-12 form-group">
                                        <button type="submit" class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" >Submit Code</button>
                                        {{-- <a  href="{{route('resend_code.store',$address->id)}}" class="float-end">Didn't get the code?? Resend the code</a> --}}

                                    </div>

                                </form>
                                <button class="btn btn-danger waves effect" type="button"
                                            onclick="editemailvarification({{ $address->id}})">
                                            Didn't get the code?? Resend the code
                                </button>
                                <form id="deleteform-{{$address->id}}" action="{{route('resend_code.store',['id'=>$address->id,'slug'=>$price->slug])}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </section><!-- #content end -->

            </div>


@endsection

@section('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    function editemailvarification(id)

    {
        Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, Resend Code!'
}).then((result) => {
  if (result.isConfirmed) {
   event.preventDefault();
   document.getElementById('deleteform-'+id).submit();
  }
})
    }
    </script>

@endsection
