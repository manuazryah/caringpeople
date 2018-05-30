<?php

use yii\helpers\Html;
?>


<script src="https://maps.google.com/maps/api/js?key=AIzaSyCicUJcPikvwOB5i8rSwLKgZa6G3_9rBpU" type="text/javascript"></script>




<div class="mkdf-full-width location-map">
        <div class="mkdf-full-width-inner">
                <div class="vc_row wpb_row vc_row-fluid mkdf-section vc_custom_1455028506356 mkdf-content-aligment-left" style="">
                        <div class="clearfix mkdf-full-section-inner">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                        <div id="map" style="height: 400px; width: 100%;">
                                                        </div>
                                                        <script type="text/javascript">
                                                                var locations = [
                                                                        ['Kochi', 9.9665616, 76.29993890000003, 'Caring People , Door No. 5, DD Vyapar Bhavan ,K P Vallon Road, Kadavnthra, Cochin 20'],
                                                                        ['Thodupuzha', 9.8929802, 76.72210819999998, 'Caring People ,First Floor,Calicut College Building,Private Bus Stand,Thodupuzha-685 584 '],
                                                                        ['Mumbai', 18.1633637, 74.96149349999996, 'Caring People, Shop No 6, J2 Vijay Park, Dias & Periera Nagar, Naigaon Mumbai'],
['UK', 52.3555177, -1.1743197000000691, 'Caring People, 21 Summerhouse View,Yeovil,Somerset,BA21 4DJ'],
                                                                ];

                                                                var map = new google.maps.Map(document.getElementById('map'), {
                                                                        zoom: 6,
                                                                        center: new google.maps.LatLng(9.9665616, 76.29993890000003),
                                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                                });

                                                                var infowindow = new google.maps.InfoWindow();

                                                                var marker, i;

                                                                for (i = 0; i < locations.length; i++) {
                                                                        marker = new google.maps.Marker({
                                                                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                                                map: map,
                                                                                title: locations[i][3],
                                                                        });

                                                                        google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                                                                return function () {
                                                                                        infowindow.setContent(locations[i][0]);
                                                                                        infowindow.open(map, marker);
                                                                                }
                                                                        })(marker, i));
                                                                }
                                                        </script>

                                                        <!--                                                        <div class="col-md-6">
                                                                                                                        <div class="mkdf-tab-container" id="tab-cochin" data-icon-pack="linear_icons" data-icon-html="&lt;i class=&quot;mkdf-icon-linear-icon lnr lnr-shirt &quot; &gt;&lt;/i&gt;">
                                                                                                                                <div class="mkdf-google-map-holder">
                                                                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.607685436103!2d76.29775021452097!3d9.966561592874125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0872c9329ed9ed%3A0x3552e171d3bece6c!2sCaring+People!5e0!3m2!1sen!2sin!4v1490845210807" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

                                                                                                                                        <div class="mkdf-google-map-overlay"></div>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>

                                                                                                                <div class="col-md-6">
                                                                                                                        <div class="mkdf-tab-container" id="tab-mumbai" data-icon-pack="linear_icons" data-icon-html="&lt;i class=&quot;mkdf-icon-linear-icon lnr lnr-smile &quot; &gt;&lt;/i&gt;">
                                                                                                                                <div class="mkdf-google-map-holder">
                                                                                                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.607685436103!2d76.29775021452097!3d9.966561592874125!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b0872c9329ed9ed%3A0x3552e171d3bece6c!2sCaring+People!5e0!3m2!1sen!2sin!4v1490845210807" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                                                                                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241316.28261616433!2d72.74111683395239!3d19.082769887427222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C+Maharashtra!5e0!3m2!1sen!2sin!4v1491203047412" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                                                                                                                                        <div class="mkdf-google-map-overlay"></div>
                                                                                                                                </div>
                                                                                                                        </div>
                                                                                                                </div>-->
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


<div class="mkdf-content" id="contact">
        <div class="mkdf-content-inner">

                <div class="mkdf-full-width">
                        <div class="mkdf-full-width-inner">
                                <div class="vc_row wpb_row vc_row-fluid mkdf-section vc_custom_1453798679731 mkdf-content-aligment-left mkdf-grid-section" style="">
                                        <div class="clearfix mkdf-section-inner">
                                                <div class="mkdf-section-inner-margin clearfix">

                                                        <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-12 vc_col-md-12">
                                                                <div class="vc_column-inner ">
                                                                        <div class="wpb_wrapper">

                                                                                <div class="col-md-3 col-sm-6 col-xs-12 addr">
                                                                                        <div data-original-height="22" class="vc_empty_space" style="height: 22px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                                                <div class="wpb_wrapper">
                                                                                                        <h5>Cochin </h5>

                                                                                                </div>
                                                                                        </div>
                                                                                        <div data-original-height="20" class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                <div class="mkdf-icon-list-icon-holder">
                                                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                <i class="mkdf-icon-linear-icon lnr lnr-apartment " style="color:#545454;font-size:18px"></i> </div>
                                                                                                </div>
                                                                                                <p class="mkdf-icon-list-text" style="font-size:12px"> Caring People<br>
                                                                                                        Door No. 5 ,<br>
                                                                                                        DD Vyapar Bhavan <br>
                                                                                                        K P Vallon Road<br>
                                                                                                        Kadavnthra<br>
                                                                                                        Cochin 20</p>
                                                                                        </div>




                                                                                </div>


                                                                                <div class="col-md-3 col-sm-6 col-xs-12 addr">
                                                                                        <div data-original-height="22" class="vc_empty_space" style="height: 22px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                                                <div class="wpb_wrapper">
                                                                                                        <h5>Thodupuzha </h5>

                                                                                                </div>
                                                                                        </div>
                                                                                        <div data-original-height="20" class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                <div class="mkdf-icon-list-icon-holder">
                                                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                <i class="mkdf-icon-linear-icon lnr lnr-apartment " style="color:#545454;font-size:18px"></i> </div>
                                                                                                </div>
                                                                                                <p class="mkdf-icon-list-text" style="font-size:12px"> Caring People<br>
                                                                                                        First Floor ,<br>
                                                                                                        Calicut College Building <br>
                                                                                                        Private Bus Stand<br>
                                                                                                        Thodupuzha-685 584
                                                                                                </p>
                                                                                        </div>






                                                                                </div>


                                                                                <div class="col-md-3 col-sm-6 col-xs-12 addr">
                                                                                        <div data-original-height="22" class="vc_empty_space" style="height: 22px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                                                <div class="wpb_wrapper">
                                                                                                        <h5>Mumbai </h5>

                                                                                                </div>
                                                                                        </div>
                                                                                        <div data-original-height="20" class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                <div class="mkdf-icon-list-icon-holder">
                                                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                <i class="mkdf-icon-linear-icon lnr lnr-apartment " style="color:#545454;font-size:18px"></i> </div>
                                                                                                </div>
                                                                                                <p class="mkdf-icon-list-text" style="font-size:12px">
                                                                                                        Caring People<br/>
                                                                                                        Shop No 6,<br/>
                                                                                                        J2 Vijay Park,<br/>
                                                                                                        Dias & Periera Nagar,<br/>
                                                                                                        Naigaon Mumbai</p>
                                                                                        </div>



                                                                                </div>


                                                                                <div class="col-md-3 col-sm-6 col-xs-12 addr">
                                                                                        <div data-original-height="22" class="vc_empty_space" style="height: 22px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="wpb_text_column wpb_content_element ">
                                                                                                <div class="wpb_wrapper">
                                                                                                        <h5>UK</h5>

                                                                                                </div>
                                                                                        </div>
                                                                                        <div data-original-height="20" class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>
                                                                                        <div class="mkdf-icon-list-item mkdf-icon-list-item-default-font-family">
                                                                                                <div class="mkdf-icon-list-icon-holder">
                                                                                                        <div class="mkdf-icon-list-icon-holder-inner clearfix">
                                                                                                                <i class="mkdf-icon-linear-icon lnr lnr-apartment " style="color:#545454;font-size:18px"></i> </div>
                                                                                                </div>
                                                                                                <p class="mkdf-icon-list-text" style="font-size:12px">
                                                                                                        Caring People<br/>
                                                                                                        21 Summerhouse View,<br/>
                                                                                                        Yeovil,<br/>
                                                                                                        Somerset,<br/>
                                                                                                        BA21 4DJ</p>
                                                                                        </div>



                                                                                </div>



                                                                                <div class="row">

                                                                                        <div class="col-md-12 col-sm-12 col-lg-12" style="text-align: center;">
                                                                                                <p><span style="font-weight: 700;"> Helpline Numbers : </span> Domestic : +91 90 20 599 599 | International : +44 7445 968106 
                                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <span style="font-weight: 700;"> Email : </span>  info@caringpeople.in
                                                                                                </p>
                                                                                        </div>

                                                                                </div>




                                                                                <div class="mkdf-separator-holder clearfix  mkdf-separator-center mkdf-separator-full-width">
                                                                                        <div class="mkdf-separator" style="border-color: #eaeaea;border-bottom-width: 1px;margin-top: 25px;margin-bottom: 25px"></div>
                                                                                </div>


                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                        <div class="wpb_wrapper">
                                                                                                <h2>Get in Touch</h2>

                                                                                        </div>
                                                                                </div>

                                                                                <div class="wpb_text_column wpb_content_element ">
                                                                                        <div class="wpb_wrapper">
                                                                                                <p>Be Informed. Be Smart. Be Sure.</p>

                                                                                        </div>
                                                                                </div>
                                                                                <div data-original-height="35" class="vc_empty_space" style="height: 35px"><span class="vc_empty_space_inner"></span></div>
                                                                                <!--<div role="form" class="wpcf7" id="wpcf7-f3016-p777-o1" lang="en-US" dir="ltr">-->
                                                                                <div class="screen-reader-response"></div>
                                                                                <?= Html::beginForm(['site/contact'], 'post') ?>
                                                                                <div class="mkdf-two-columns-50-50">
                                                                                        <div class="mkdf-two-columns-50-50-inner">
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <span class="wpcf7-form-control-wrap first-name"><input type="text" name="first-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="First name*" required /></span>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <span class="wpcf7-form-control-wrap last-name"><input type="text" name="last-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Last name*" required /></span>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div class="mkdf-two-columns-50-50">
                                                                                        <div class="mkdf-two-columns-50-50-inner">
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <span class="wpcf7-form-control-wrap your-email"><input type="email" name="email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email*" required /></span>
                                                                                                        </div>
                                                                                                </div>
                                                                                                <div class="mkdf-column">
                                                                                                        <div class="mkdf-column-inner">
                                                                                                                <span class="wpcf7-form-control-wrap your-phone"><input type="text" name="phone" value="" size="40" class="wpcf7-form-control wpcf7-text" aria-invalid="false" placeholder="Phone" required /></span>
                                                                                                        </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div>
                                                                                <div><span class="wpcf7-form-control-wrap your-message"><textarea name="message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Type your message..." required></textarea></span></div>
                                                                                <div>
                                                                                        <?= Html::submitButton('<span>Submit</span>', ['class' => 'wpcf7-form-control wpcf7-submit contact-subtn', 'name' => 'contact-send']) ?>
                                                                                </div>
                                                                                <?= Html::endForm() ?>
                                                                                <!--</div>-->
                                                                        </div>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <!-- close div.content_inner -->
</div>

<style>


</style>
