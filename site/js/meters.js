$(document).ready(function(){
  $('body').on('click', '.meter', function(){
    if($(this).siblings().is('.meter-content')){
      $(this).siblings('.meter-content').remove();
    } else {
      $.get('get_meter_content',{
         id: get_meter_id($(this)),
         serial: get_meter_serial($(this))
        },function(r){
          init_content(r);
        });
    }
  });
});

function get_meter_id(obj){
  return obj.closest('.meter').attr('meter');
}

function get_meter_serial(obj){
  return obj.closest('.meter').attr('serial');
}