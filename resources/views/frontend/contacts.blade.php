@extends('frontend.app')

@section('content')


        <!-- Contact Us -->
        <section class="section-padding">
            <div>
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <h3 class="mt-1 mb-4">Get In Touch</h3>
                        <h6 class="text-dark">Address :</h6>
                        <p>86 Petersham town, New South wales Waedll Steet, Australia PA 6550</p>
                        <h6 class="text-dark">Phone :</h6>
                        <p>+91 12345-67890, (+91) 123 456 7890</p>
                        <h6 class="text-dark">Mobile :</h6>
                        <p>(+20) 220 145 6589, +91 12345-67890</p>
                        <h6 class="text-dark">Email :</h6>
                        <p>iamosahan@gmail.com, info@gmail.com</p>
                        <h6 class="text-dark">Website :</h6>
                        <p>www.askbootstrap.com</p>

                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d109552.19658195564!2d75.78663251672796!3d30.900473637371658!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a837462345a7d%3A0x681102348ec60610!2sLudhiana%2C+Punjab!5e0!3m2!1sen!2sin!4v1530462134939" width="100%" height="340" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Us -->
        <hr>
        <!-- Contact Me -->
        <section class="section-padding">
            <div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 section-title text-left mb-4">
                        <h2>Contact Us</h2>
                    </div>

                    <form class="col-lg-12 col-md-12"  name="sentMessage" id="contactForm" novalidate="" action="{{ route('contacts.store') }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}


                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="from_u" placeholder="Full Name" class="form-control" id="name" required="" data-validation-required-message="Please enter your name.">
                                <p class="help-block"></p>
                                @if($errors->has('from_u'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('from_u') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="control-group form-group col-md-6">
                                <label>Phone Number <span class="text-danger">*</span></label>
                                <div class="controls">
                                    <input type="tel" name="phone" placeholder="Phone Number" class="form-control" id="phone" required="" data-validation-required-message="Please enter your phone number.">
                                </div>

                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                            <div class="control-group form-group col-md-6">
                                <div class="controls">
                                    <label>Email Address <span class="text-danger">*</span></label>
                                    <input type="email" name="email" placeholder="Email Address" class="form-control" id="email" required="" data-validation-required-message="Please enter your email address.">
                                </div>

                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Message <span class="text-danger">*</span></label>
                                <textarea rows="4"  name="content" cols="100" placeholder="Message" class="form-control" id="message" required="" data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                            </div>


                            @if($errors->has('content'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn-success">Send Message</button>
                    </form>


                </div>
            </div>
        </section>
        <!-- End Contact Me -->





@endsection
