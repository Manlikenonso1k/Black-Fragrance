@extends('layouts.app')

@section('content')

    <section id="thank-you" class="padding-large bg-light-grey">
      <div class="container">
        <div class="row">
          <div class="page-header col-md-6">
            <div class="section-header">
              <h1 class="page-title">Thank You!</h1>
              <p>We will get back to you as soon as possible.</p>
            </div>
          </div>
          <div class="contact-information">
            <div class="col-md-6">
              <div class="section-header">
                <h2 class="section-title">Get in touch</h2>
              </div>
              <div class="row">
                <div class="d-flex flex-wrap bg-light">
                  <div class="col-md-6 border-right border-bottom">
                    <div class="detail">
                      <h3>Phones</h3>
                      <ul class="list-unstyled">
                        <li>
                          <i class="icon icon-phone"></i>+1650-243-00023
                        </li>
                        <li>
                          <i class="icon icon-phone"></i>+1650-243-00021
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 border-bottom">
                    <div class="detail">
                      <h3>Emails</h3>
                      <ul class="list-unstyled">
                        <li>
                          <i class="icon icon-envelope"></i>
                          <a href="mailto:info@yourcompany.com">info@yourcompany.com</a>
                        </li>
                        <li>
                          <i class="icon icon-envelope"></i>
                          <a href="mailto:info@yourcompany.com">info@yourcompany.com</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6 border-right">
                    <div class="address detail">
                      <h3>Address</h3>
                      <ul class="list-unstyled">
                        <li>
                          <i class="icon icon-location"></i>
                          <span>North Melbourne VIC 3051, Australia</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="detail">
                      <h3>Social Links</h3>
                      <ul class="social-links list-unstyled d-flex">
                        <li><a href="#" class="icon icon-facebook"></a></li>
                        <li><a href="#" class="icon icon-twitter"></a></li>
                        <li><a href="#" class="icon icon-youtube-play"></a></li>
                        <li><a href="#" class="icon icon-behance-square"></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    
    <section id="instagram" class="padding-large">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Follow our instagram</h2>
        </div>
        <p>Our official Instagram account <a href="#">@ultras</a> or <a href="#">#Black Fragrance</a>
        </p>
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image1.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image2.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image3.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image4.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image5.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img src="images/insta-image6.jpg" alt="instagram" class="insta-image">
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
        </div>          
      </div>
    </section>

    <section id="shipping-information">
      <hr>
      <div class="container">
        <div class="row d-flex flex-wrap align-items-center justify-content-between">
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-truck"></i>
              <h4 class="block-title">
                <strong>Free shipping</strong> Over $200
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-return"></i>
              <h4 class="block-title">
                <strong>Money back</strong> Return within 7 days
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-tags1"></i>
              <h4 class="block-title">
                <strong>Buy 4 get 5th</strong> 50% off
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-help_outline"></i>
              <h4 class="block-title">
                <strong>Any questions?</strong> experts are ready
              </h4>
            </div>
          </div>
        </div>
      </div>
      <hr>
    </section>

@endsection
