(function($) {
$('.alert').hide();
$('#gallery-1').royalSlider({
    addActiveClass: true,
    arrowsNav: false,
    controlNavigation: 'none',
    imageAlignCenter: true,
    imageScaleMode: 'none',
    autoScaleSlider: true,
    autoScaleSliderWidth:1400,
    loop: true,
    fadeinLoadedSlide: false,
    globalCaption: false,
    keyboardNavEnabled: true,
    globalCaptionInside: false,
    allowCSS3:true,
    autoPlay: {
        enabled:true
    }

});

$('#surfclub-form-submit').click(function() {
    $('#surfclub-contact').validate({
        rules:{
            first_name:"required",
            last_name:"required",
            email:{required:true,email: true},
            message:"required"
        },
    
        messages:{
            first_name:'Please enter your first name, so we do not have to respond with Hey dude! or something',
            last_name:'Please enter your last name so we can respond to you as Mr. or Mrs. Dumass',
            email:{
                required:'Let\'s get a valid email in here or all is for naught',
                email:'Enter a valid email address'
            },
        },
  
        errorClass: 'help-inline',
        errorElement: 'span',
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
    
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        },
    
        submitHandler: function(form) {
            var dataString = $('#surfclub-contact').serialize();
            $.ajax({
                type: 'POST',
                url: 'http://surfclub.corymoore.com/wp-content/themes/surfclub2/inc/mail.php',
                data: dataString,
                success: function(response) {
                    if(response === 'true') {
                        $('.alert').addClass('alert-success').fadeIn('slow').html('Thanks for getting in touch ' + $('input#first_name').val() + '<a class="close" data-dismiss="alert">×</a>');
                        $('.alert').alert();
                    } else {
                        $('.alert').addClass('alert-error').fadeIn('slow').html('There was an error processing your request' + '<a class="close" data-dismiss="alert">×</a>');
                        $('.alert').alert();
                    }
                }
            });
        }
    });
});
$('button#subscribe').click(function() {
    $("#mailchimp-subscribe").validate({
        rules:{
            name:"required",
            email:{required:true,email: true},
            message:"required"
        },
    
        messages:{
            first_name:"Please enter your first name, so we don't have to respond with Hey dude! or something",
            email:{
                required:"Let's get a valid email in here or all is for naught",
                email:"Enter a valid email address"
            },
        },
    
        errorClass: "help-inline",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
                    
        },
        
        submitHandler: function(form) {
            var dataString = $('#mailchimp-subscribe').serialize();
            $.ajax({
                type: "POST",
                url: "http://surfclub.corymoore.com/wp-content/themes/surfclub2/inc/mailchimp/subscribe.php",
                data: dataString,
                success: function(data) {

                    var json = $.parseJSON(data);

                    //alert(data); return false;
                    if(json.result === true) {
                        $('.alert').addClass('alert-success').fadeIn('slow').html('<a class="close" data-dismiss="alert">×</a>' + json.response + ' ' + $('input#first_name').val());
                        $(".alert").alert();
                    } else {
                        $('.alert').addClass('alert-error').fadeIn('slow').html(json.response + '<a class="close" data-dismiss="alert">×</a>');
                        $(".alert").alert();
                    }
                }
                
            });
        }
    });
});


})(jQuery);
