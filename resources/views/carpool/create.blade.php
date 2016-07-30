@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new Carpool</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal" id="carpoolfrm" role="form" method="POST" onsubmit="return validateCarpool()" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-3 control-label">From :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="fromtxt" name="fromtxt" onFocus="geolocate()" required />
                                <input type="hidden" id="fromlocality" name="fromcity" />
                                <input type="hidden" id="fromadministrative_area_level_2" name="fromdist" />
                                <input type="hidden" id="fromadministrative_area_level_1" name="fromstate" />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">To:</label>
                            <div class="col-md-6">
                                <input type="text" id="totxt" class="form-control" name="totxt" value="" required />
                                <input type="hidden" id="tolocality" name="tocity" />
                                <input type="hidden" id="toadministrative_area_level_2" name="todist" />
                                <input type="hidden" id="toadministrative_area_level_1" name="tostate" />

                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label">Carpool Type:</label>
                            <div class="col-md-3">
                                <select name="pool_type" id="pooltype" class="form-control" onchange="showPoolType(this.value)">
                                    <option value="R" selected="selected">Regular</option>
                                    <option value="O" >One Time</option>
                                </select>
                            </div>
                        </div>
                        <div id="regular-pool">
                            <div class="form-group" >
                                <label class="col-md-3 control-label">Start Time:</label>
                                <div  class="timepicker input-group date form_datetime col-md-3" data-date-format="HH:ii P">
                                    <input type="text"  name="from_time" size="16" class="form-control" id="from_time" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                <label class="col-md-2">Return Time:</label>
                                <div  class="timepicker input-group date form_datetime col-md-3" data-date-format="HH:ii P">
                                    <input type="text"  name="return_time" size="16" class="form-control" id="return_time" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                            </div>
                        
                            <div class="form-group" id="reg_div" style="display: none;">
                                <label class="col-md-3 control-label">Registration Number:</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="reg_num" name="reg_num" max="16"  />
                                </div>
                            </div>
                        </div>
                        
                        <div id="onetime-pool" style="display: none;" >
                            <div class="form-group" >
                                <label class="col-md-3 control-label">Time of journey:</label>
                                <div id="datetimepicker"  class="input-group date form_datetime col-md-5" data-date-format="dd-M-yyyy HH:ii P">
                                    <input type="text"  name="journey_date" size="16" class="form-control" id="journey_date" />
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                </div>
                                
                            </div>
                            <div class="form-group">
                            <label class="col-md-3 control-label">Price(INR) :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="price" name="price"  />
                            </div>
                        </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description:</label>
                            <div class="col-md-6">
                                <textarea name="details" rows="4" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">You would like to be:</label>
                            <label class="col-md-2"> <input type="radio" name="user_type" value="D"  />Driver</label>
                            <label class="col-md-3"> <input type="radio" name="user_type" value="P"   />Passenger </label>
                            <label class="col-md-3"> <input type="radio" name="user_type" value="B" checked="checked" />Driver or Passenger</label>
                        </div>
                       

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" id="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

    var placeSearch, autocomplete, autocomplete2;
    var componentForm = {
        locality: 'long_name',
        administrative_area_level_2: 'long_name',
        administrative_area_level_1: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('fromtxt')),
                {types: ['geocode']});
        autocomplete2 = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('totxt')),
                {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
        autocomplete2.addListener('place_changed', fillInAddress2);
    }

// [START region_fillform]
    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                //console.log(addressType + ':' + val);
                $('#from' + addressType).val(val)
            }
        }
    }

    function fillInAddress2() {
        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                // console.log(addressType + ':' + val);
                $('#to' + addressType).val(val)
            }
        }
    }



// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
// [END region_geolocation]

    function validateCarpool() {
        var frmTxt = $('#frmtxt');
        var toTxt = $('#totxt');
        if (frmTxt == toTxt) {
            alert('From and to address should be different')
            return false;
        }
        if($('#fromadministrative_area_level_2').val()=='' || $('#toadministrative_area_level_2').val()==''){
            alert('Please select location from autosuggest only');
            return false;
        }
        $('#submit').text('Processing your request .... ')
        $('#submit').attr('disabled', true);
        $.post('{{Route::currentRouteName()}}', $('#carpoolfrm').serialize(), function (result) {
            //console.log(result);
            if (result.status) {
                //alert("Your carpool has been added successfully.");
                $( '<div id="alert" class="alert alert-success" role="alert" style="display:none;">Your Carpol has been created successfully.</div>' ).insertAfter( ".navbar" );
                $(document).scrollTop(0);
                $('.alert').fadeIn(400).delay(2000).fadeOut(500,function(){window.location = "{{ url('/my-carpools') }}";})
                

            }else{
                $( '<div id="alert" class="alert alert-success" role="alert alert-danger">Sorry! there is some problem. Please try again later.</div>' ).insertAfter( ".navbar" );
                $(document).scrollTop(0);
            }
        });
        return false;
    }

    function showPoolType(val){
        if(val=='R'){
             $('#onetime-pool').hide();
             $('#regular-pool').show();
        }else{
            $('#onetime-pool').show();
            $('#regular-pool').hide();
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&callback=initAutocomplete"
        async defer>
</script>

@endsection

@section('head')
<link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.3.4/css/bootstrap-datetimepicker.min.css" />
@endsection

@section('foot')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.3.4/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/smalot-bootstrap-datetimepicker/2.3.4/js/locales/bootstrap-datetimepicker.uk.js">
    </script>
    <script type="text/javascript">
       $('#datetimepicker').datetimepicker({
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
    });
    $('.timepicker').datetimepicker({
        startView:1,
        maxView:1
    });
    
    </script>
@endsection
