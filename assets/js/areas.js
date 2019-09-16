$(function(){
area = {
  init: function () {

  },
  events: function() {
  $("#newArea").on("click", area.validateForm);
  },
  getFormData: function() {
    darosArea = {
      'nombreArea' : $('area').val(),
      'responsableArea' : $('responsableArea').val(),
   }
   $.post(
     base_url+'Areas/'
   )
  }
}
area.init();

});
