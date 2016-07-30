@extends('app')

@section('content')
<ol class="breadcrumb" style="margin-bottom: 5px;">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Contact Us</li>
</ol>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Contact Form</h2>
                </div>
                <div class="panel-body">
                    <form  class="form-horizontal" method="post" name="contactform" id="contactform" role="form" onsubmit="return validateContact()">
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="name">Name *</label>
                            
                            <div class="col-lg-10">
                                <input class="form-control" id="name" name="name" placeholder="Your Name" type="text" required />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="email">Email *</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="email" name="email" placeholder="Your Email" type="email" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="mobile">Mobile</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="mobile" name="mobile" placeholder="Your Mobile" type="text"  />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="inputSubject">Subject</label>
                            <div class="col-lg-10">
                                <input class="form-control" id="subject" name="subject" placeholder="Subject Message" type="text" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="message">Message *</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" id="message" name="message" placeholder="Your message..." required rows="4"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">
                                    Send Message
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
function validateContact() {
        var name = $('#name');
        var email = $('#email');
        if (name=='' || email == '') {
            alert('Please insert all field from *.');
            return false;
        }
        $('#submit').text('Processing your request .... ');
        $('#submit').attr('disabled', true);
        $.post('{{Route::currentRouteName()}}', $('#contactform').serialize(), function (result) {
            console.log(result);
            if (result.status) {
                $( '<div id="alert" class="alert alert-success" role="alert" style="display:none;">'+result.message+'</div>' ).insertAfter( ".navbar" );
                $(document).scrollTop(0);
                $('.alert').fadeIn(400);
                $('#submit').text('Processed');
                document.forms.contactform.reset();
            }else{
                $( '<div id="alert" class="alert alert-success" role="alert alert-danger">Sorry! there is some problem. Please try again later.</div>' ).insertAfter( ".navbar" );
                $(document).scrollTop(0);
            }
        });
        return false;
    }
</script>
@endsection