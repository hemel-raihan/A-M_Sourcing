<div id="top-bar">
    <div class="container clearfix">

        <div class="row justify-content-between">
            <div class="col-12 col-md-auto">

                <!-- Top Links
                ============================================= -->
                <div class="top-links on-click">
                    <ul class="top-links-container">
                        {{-- <li class="top-links-item"><a href="index.html">Home</a>
                            <ul class="top-links-sub-menu">
                                <li class="top-links-item"><a href="about.html">(+01)123 456 789</a></li>
                                <li class="top-links-item"><a href="faqs.html">info@example.com</a></li>
                                <li class="top-links-item"><a href="contact.html">Suite 20 Golden Street USA</a></li>
                            </ul>
                        </li> --}}
                        <li class="top-links-item"><a href="#"><i class="icon-line-phone-call"></i> {{$setting->phone}}</a></li>
                        <li class="top-links-item"><a href="#"><i class="icon-email3"></i> {{$setting->email}}</a></li>
                        <li class="top-links-item"><a href="#"><i class="icon-address-card1"></i> {{$setting->contact}}</a></li>
                            {{-- <div class="top-links-section">
                                <form id="top-login" autocomplete="off">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="email" class="form-control" placeholder="Email address">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="top-login-checkbox">
                                        <label class="form-check-label" for="top-login-checkbox">Remember Me</label>
                                    </div>
                                    <button class="btn btn-danger w-100" type="submit">Sign in</button>
                                </form>
                            </div> --}}
                        </li>
                    </ul>
                </div><!-- .top-links end -->

            </div>

            <div class="col-12 col-md-auto">

                <!-- Top Social
                ============================================= -->
                <ul id="top-social">
                    <li><a href="https://www.facebook.com/DataHostBD/" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a></li>
                    <li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a></li>
                    {{-- <li class="d-none d-sm-flex"><a href="#" class="si-dribbble"><span class="ts-icon"><i class="icon-dribbble"></i></span><span class="ts-text">Dribbble</span></a></li>
                    <li><a href="#" class="si-github"><span class="ts-icon"><i class="icon-github-circled"></i></span><span class="ts-text">Github</span></a></li>
                    <li class="d-none d-sm-flex"><a href="#" class="si-pinterest"><span class="ts-icon"><i class="icon-pinterest"></i></span><span class="ts-text">Pinterest</span></a></li> --}}
                    <li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a></li>
                    <li><a href="tel:+1.11.85412542" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+1.11.85412542</span></a></li>
                    <li><a href="mailto:info@canvas.com" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text">info@canvas.com</span></a></li>
                </ul><!-- #top-social end -->

            </div>

        </div>

    </div>
</div>
