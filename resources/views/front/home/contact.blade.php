@include('front.common.header')
    <div class="slider-area">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>Contact Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container section-padding">
        <div class="row">
            <div class="col-md-6">
                <!-- <div class="map">

                    <div class="info-card v-center">
                        <span> Where We Are?</span>
                        <div class="info-body mt-3">
                            <div class="mb-3">
                                <span>
                                    <i class="fas fa-phone-alt"></i>
                                </span>
                                <p>


                                    128, MOHMMADS CASTLE, MADHURANAGAR COLONY, YOUSAFGUDA MAIN ROAD, HYDERABAD,
                                    TELANGANA, 500038

                                </p>
                            </div>


                        </div>
                    </div>


                </div> -->
              
                    <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-home"></i></span>
                    <div class="media-body">
                        <h3>
                            Where We Are?
                        </h3>
                    <p> My Home Hub, Madhapur, Patrika Nagar, HITEC City Hyderabad, Telangana 500081</p>
                   
                    </div>
                    </div>
                    <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                    <div class="media-body">
                    <h3>Give Us A Call</h3>
                    <a href="tel:+919652252233" title="+919652252233">+919652252233 or  18003099090</a>
                   
                    </div>
                    </div>
                    <div class="media contact-info">
                    <span class="contact-info__icon"><i class="ti-email"></i></span>
                    <div class="media-body">
                    <h3>Drop Us A Line</h3>
                    <a href="mailto:support@stpaulseducationacademy.com" title="support@stpaulseducationacademy.com">support@stpaulseducationacademy.com</a>
                    </div>
                    </div>
                    </div>
            
            <div class="col-md-6">
                <div class="getintouch">
                    <h3>Get in touch </h3>
                    <p>Are you confused about your career? Worry not! We are here to help you achieve the best career
                        ahead. Get in touch with our education counsellor to get the best career advice for your life.
                        Please submit your details below, and our experts will get in touch with you, giving you the
                        guidance you require to excel.</p>
                   <form class="contactus-form" id="contact-form" method="post" action="{{route('home.contact_form')}}">
                    @csrf 
                       <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" required="" placeholder="Name" id="name" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="email" required="" placeholder="Email" id="email" class="form-control" name="email">
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" required="" placeholder="Phone Number" id="phone" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="text" required="" placeholder="Subject" id="subject" class="form-control" name="subject">
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <textarea placeholder="Message" id="message1" class="form-control" name="message1" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group form-icon">
                                    <input type="submit"  class="btn" style="position: relative;">

                                </div>
                            </div>
                            <div class="alert-msg" id="alert-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@include('front.common.footer')
