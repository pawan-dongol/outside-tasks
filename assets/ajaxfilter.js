
jQuery('#filter select').on('change',function (e) {
  ajaxFunction();
});

function ajaxFunction(){
     var filter = jQuery('#filter');
     // console.log(filter.attr('action'));
    jQuery.ajax({
        url:filter.attr('action'),
        data:filter.serialize(), // form data
        type:filter.attr('method'), // POST
        beforeSend:function(xhr){
            jQuery('#response').html('Processing...'); // changing the button label
        },
        success:function(data){
            jQuery('#response').html(data); // insert data
        }
    });
    return false;
}