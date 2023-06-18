@extends('frontend.layouts.app')

@section('content')
<section class="pt-4 mb-4">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-6 text-center text-lg-left">
                <h1 class="fw-600 h4">{{ translate('Register your shop')}}</h1>
            </div>
            <div class="col-lg-6">
                <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                    <li class="breadcrumb-item opacity-50">
                        <a class="text-reset" href="{{ route('home') }}">{{ translate('Home')}}</a>
                    </li>
                    <li class="text-dark fw-600 breadcrumb-item">
                        <a class="text-reset" href="{{ route('shops.create') }}">"{{ translate('Register your shop')}}"</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="pt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xxl-5 col-xl-6 col-md-8 mx-auto">
                <form id="shop" class="" action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (!Auth::check())
                        <div class="bg-white rounded shadow-sm mb-3">
                            <div class="fs-15 fw-600 p-3 border-bottom">
                                {{ translate('Personal Info')}}
                            </div>
                            <div class="p-3">
                                <div class="form-group">
                                    <label>{{ translate('Your Name')}} <span class="text-primary">*</span></label>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Name') }}" name="name">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Your Email')}} <span class="text-primary">*</span></label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Your Password')}} <span class="text-primary">*</span></label>
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password">
                                </div>
                                <div class="form-group">
                                    <label>{{ translate('Repeat Password')}} <span class="text-primary">*</span></label>
                                    <input type="password" class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                </div>
                            </div>

                        </div>
                    @endif
                    <div class="bg-white rounded shadow-sm mb-4">
                        <div class="fs-15 fw-600 p-3 border-bottom">
                            {{ translate('Basic Info')}}
                        </div>
                        <div class="p-3">
                            <div class="form-group">
                                <label>{{ translate('Shop Name')}} <span class="text-primary">*</span></label>
                                <input type="text" class="form-control" placeholder="{{ translate('Shop Name')}}" name="name" required>
                            </div>
                            <!-- <div class="form-group">
                                <label>{{ translate('Logo')}}</label>
                                <div class="custom-file">
                                    <label class="custom-file-label">
                                        <input type="file" class="custom-file-input" name="logo" accept="image/*">
                                        <span class="custom-file-name">{{ translate('Choose image') }}</span>
                                    </label>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label>{{ translate('Address')}} <span class="text-primary">*</span></label>
                                <input type="text"  class="form-control mb-3" placeholder="{{ translate('Address')}}" name="address" required>
                            </div>

                            <div class="form-group">
                                <label>{{ translate('Location')}} <span class="text-primary">*</span></label>
                                <input type="text" id="us2-address" class="form-control mb-3" placeholder="{{ translate('Address')}}" name="location" required>
                            </div>
                        </div>
                        <div class="container well">
                            <div id="maparea" style="width: 500px; height: 400px;"></div>


                            <input type="hidden" id="us2-lat" name="lat">
                             <input type="hidden" id="us2-lon" name="lon">
                            <div class=""></div>
                            <div id="atm" style="display: none">
                            </div>
                            <div id="pharmacy" style="display: none">
                                <div>

                                </div>
                            </div>
                        </div>
                    </div>



                    @if(get_setting('google_recaptcha') == 1)
                        <div class="form-group mt-2 mx-auto row">
                            <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                        </div>
                    @endif



                    <div class="text-right">
                        <button type="submit" class="btn btn-primary fw-600">{{ translate('Register Your Shop')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://maps.google.com/maps/api/js?key=AIzaSyDIrQe3jyOWbsBGWhCWtMQ_XWbngzhiNTM&sensor=true&libraries=places'></script>
    <script src='https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js'></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript">
    // making the CAPTCHA  a required field for form submission
    $(document).ready(function(){
        // alert('helloman');
        $("#shop").on("submit", function(evt)
        {
            var response = grecaptcha.getResponse();
            if(response.length == 0)
            {
            //reCaptcha not verified
                alert("please verify you are humann!");
                evt.preventDefault();
                return false;
            }
            //captcha verified
            //do the rest of your validations here
            $("#reg-form").submit();
        });
    });
</script>

    <script>
        $(document).ready(function() {
            $('#maparea').locationpicker({
                inputBinding: {
                    latitudeInput: $('#us2-lat'),
                    longitudeInput: $('#us2-lon'),
                    locationNameInput: $('#us2-address')
                },
                enableAutocomplete: true,
                onchanged: function(currentLocation) {
                    var placeType = ["atm", "pharmacy"];
                    var sep = ',';
                    var request = [],resultset,
                        lat = currentLocation.latitude,
                        lan = currentLocation.longitude;
                    for (var i = 0; i < placeType.length; i++) {
                        request = {
                            location: new google.maps.LatLng(lat, lan),
                            types: [placeType[i]],
                            rankBy: google.maps.places.RankBy.DISTANCE

                        };
                        var container = document.getElementById(placeType[i]);
                        //console.log(container);
                        var service = new google.maps.places.PlacesService(container);
                        service.nearbySearch(request, callback);
                        //console.log(placeType[i]);
                        function callback(results, status) {
                            if (status == google.maps.places.PlacesServiceStatus.OK) {
                                for (var j = 0; j < 3; j++) {
                                    resultset += results[j].name + sep + results[j].vicinity + '.<br>'

                                }

                            }
                        }

                    }
                } //end onchange

                /*
                 onchanged: function(currentLocation) {
                 var placeType = ["atm", "pharmacy"];
                 var sep = ',';
                 var request = [],
                 lat = currentLocation.latitude,
                 lan = currentLocation.longitude;
                 for (var i = 0; i < placeType.length; i++) {
                 request = {
                 location: new google.maps.LatLng(lat, lan),
                 types: [placeType[i]],
                 rankBy: google.maps.places.RankBy.DISTANCE
                 };
                 var container = document.getElementById("'" + placeType[i] + "'");
                 var service = new google.maps.places.PlacesService(container);
                 service.nearbySearch(request, callback);

                 function callback(results, status) {
                 if (status == google.maps.places.PlacesServiceStatus.OK) {
                 for (var j = 0; j < 3; j++) {
                 var input = document.getElementById("'" + placeType[i] + "'");

                 var resultset += results[j].name + sep + results[j].vicinity + '.';
                 console.log(resultset);

                 }

                 }
                 }
                 }
                 } //end of onchange function
                 */
            });
        });
    </script>
@endsection
