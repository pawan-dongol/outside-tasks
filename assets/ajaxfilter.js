
jQuery(document).ready(function ($) {

    $('#eventform select').on('change',function (e) {

        // var form = document.forms.namedItem("eventform"); // high importance!, here you need change 
        
        var form = new FormData()

        form.append('filter', $("#eventform select").val());
        form.append('action', 'ajax_template_call');
       
        e.preventDefault();
       
        $.ajax({
            url: ajaxStuff.ajaxurl,
            type: "GET",
            data: form,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('response' + JSON.stringify(data));
            },
            error: function () {
              // handle error case here
            }
        });
    });

    $('').trigger('click');
});