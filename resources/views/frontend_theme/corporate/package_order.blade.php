@extends('frontend_theme.corporate.front_layout.app')

@section('styles')

@endsection

@section('content')

@isset($service)
@include('frontend_theme.corporate.front_layout.vertical.banner',['servicc'=>$service])
@endisset

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
                    </br>
                        <div class="row col-mb-50  gutter-50">
                            <div class="col-lg-8">
                                <h3>Billing Address</h3>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde, vel odio non dicta provident sint ex autem mollitia dolorem illum repellat ipsum aliquid illo similique sapiente fugiat minus ratione.</p>

                                <form id="billing-form" name="billing-form" class="row mb-0" action="{{route('package.store',$price->slug)}}" method="post">
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
                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-name">Name:</label>
                                        <input type="text" id="billing-form-name" name="name" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-lname">Email:</label>
                                        <input type="text" id="billing-form-lname" name="email" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-name">Contact No:</label>
                                        <input type="text" id="billing-form-name" name="contact_no" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-lname">Country:</label>
                                        <input type="text" id="billing-form-lname" name="country" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-name">City:</label>
                                        <input type="text" id="billing-form-name" name="city" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-lname">Zip Code:</label>
                                        <input type="text" id="billing-form-lname" name="zip_code" value="" class="sm-form-control" />
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="billing-form-lname">NDA File:</label>
                                        <input type="file" id="billing-form-lname" name="nda_file" value="" class="sm-form-control" />
                                    </div>


                                    <button type="submit" class="button button-3d float-end">Place Order</button>
                                </form>
                            </div>

                            <div class="col-lg-4">
                                <style>
                                    .package-order {
                                        background-color: #25D06F;
                                        border-color: #25D06F;
                                        color: white;
                                    }
                                    .single-pricing-table span.title {
                                        text-transform: uppercase;
                                        font-size: 18px;
                                        display: block;
                                        color: white;
                                        font-weight: 700;
                                        margin-bottom: 19px;
                                        -webkit-transition: .5s;
                                        transition: .5s;
                                    }
                                    .single-pricing-table .price {
                                        color: #25D06F;
                                        margin-bottom: 22px;
                                    }
                                    .single-pricing-table {
                                        padding: 51px 0px 60px;
                                        text-align: center;
                                        -webkit-transition: .5s;
                                        transition: .5s;
                                    }
                                </style>
                                <div class="single-pricing-table package-order">
                                    <span class="title">{{$price->title}}</span>
                                    <div class="price">
                                    <h1 style="color: white;">{{$price->price}}৳</h1>
                                    </div>
                                    <div class="features">
                                        {!!$price->body!!}
                                    </div>
                                </div>
                            </div>


                        </div>
                    </br>
                    </div>
                </div>
            </section><!-- #content end -->

            </div>


@endsection

@section('scripts')

@endsection
