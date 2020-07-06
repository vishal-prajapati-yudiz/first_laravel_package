<!DOCTYPE html>
<html>
<head>
	<title>Contact Us</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body style="margin-top: 50px;">
	<div class="container">
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form id="formContactusDetail" class="form-horizontal" action="{{ route('contactus.save') }}" method="POST">
          @csrf
          <fieldset>
            <legend class="text-center">Contact us</legend>
            @if(Session::has('message'))
              <p class="alert alert-info">{{ Session::get('message') }}</p>
            @endif
            
            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Enter Your name" class="form-control">
              </div>
            </div>
    
            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="Enter Your email" class="form-control">
              </div>
            </div>

             <!-- Contact input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="contact">Mobile</label>
              <div class="col-md-9">
                <input id="contact" name="contact" type="text" placeholder="Enter Your mobile number" class="form-control">
              </div>
            </div>
    
            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Enter Your Message..." rows="5"></textarea>
              </div>
            </div>
  
            <!-- Form actions -->
            <div class="form-group col-md-12">
              <div class="col-md-5">
              </div>
              <div class="col-sm-7">
                 <button type="submit" class="btn btn-success">Submit</button>
                 <a href=""><button type="button" class="btn btn-danger">Cancel</button></a>
              </div>
            </div>
          </fieldset>
          </form>
        </div>
      </div>
	</div>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#formContactusDetail").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 255,
                },
                email:{
                    required:true,
                    maxlength:255,
                    email: true,
                    valid_email: true,
                    remote: {
                        url: "{{ route('user.contactus.email') }}",
                        type: "post",
                        data: {
                            _token: function() {
                                return "{{csrf_token()}}"
                            },
                            type: "user",
                        }
                    },
                },
                contact:{
                    required:true,
                    maxlength:16,
                    minlength:8,
                    pattern: /^(\d+)(?: ?\d+)*$/,
                    remote: {
                        url: "{{ route('user.contactus.contact') }}",
                        type: "post",
                        data: {
                            _token: function() {
                                return "{{csrf_token()}}"
                            },
                            type: "user",
                        }
                    },
                },
                message: {
                    required: true,
                    maxlength: 255,
                },
            },
            messages: {
                name:{
                    required:"@lang('validation.required',['attribute'=>'name'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'name','max'=>255])",
                },
                email:{
                    required:"@lang('validation.required',['attribute'=>'email'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'email','max'=>255])",
                    email:"@lang('validation.email',['attribute'=>'email'])",
                    valid_email:"@lang('validation.email',['attribute'=>'email'])",
                    remote:"@lang('validation.unique',['attribute'=>'email'])",
                },
                contact:{
                    required:"@lang('validation.required',['attribute'=>'mobile'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'mobile','max'=>16])",
                    minlength:"@lang('validation.min.string',['attribute'=>'mobile','min'=>8])",
                    pattern:"@lang('validation.numeric',['attribute'=>'mobile'])",
                    pattern:"mobile must be a number.",
                    remote:"@lang('validation.unique',['attribute'=>'mobile'])",
                },
                message:{
                    required:"@lang('validation.required',['attribute'=>'message'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'message','max'=>255])",
                },
            },
            errorClass: 'help-block',
            errorElement: 'span',
            highlight: function (element) {
               $(element).closest('.form-group').addClass('has-error').css('color','red');
            },
            unhighlight: function (element) {
               $(element).closest('.form-group').removeClass('has-error').css('color','black');
            },
            errorPlacement: function (error, element) {
                if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#formContactusDetail').submit(function(){
            if( $(this).valid() ){
                addOverlay();
                $("input[type=submit], input[type=button], button[type=submit]").prop("disabled", "disabled");
                return true;
            }
            else{
                return false;
            }
        });

       //For Remove Allert Message
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });

        
        //For Jquery Validations       
        $.validator.addMethod("not_empty", function(value, element) {
            return this.optional(element) || /\S/.test(value);
        }, "Only space is not allowed.");

        $.validator.addMethod("valid_email", function(value, element) {
            return this.optional(element) || /^([\w-\.\+\_]+@([\w-]+\.)+([\w-]{2,})+)?$/.test(value);
        }, "Please enter a valid email address.");

        $.validator.addMethod("valid_url", function(value, element) {
          return this.optional(element) || /^(?:http(s)?:\/\/)?(www\.)?[A-Za-z]+(\.[a-z]{2,})*$/gm.test(value);
        }, "Please enter valid link.");

});
</script>