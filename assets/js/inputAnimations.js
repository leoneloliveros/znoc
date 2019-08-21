  var Bitacora = {

    inputAnimations: function() {
        $('input').focus(function(){
            $(this).parents('.form-group').addClass('focused');
        });
        $('input').blur(function(){
            var inputValue = $(this).val();
            if ( inputValue == "" ) {
                $(this).removeClass('filled');
                $(this).parents('.form-group').removeClass('focused');
            } else {
                $(this).addClass('filled');
            }
        });

        $('select').focus(function(){
            $(this).parents('.form-group').addClass('focused');
        });

        $('select').blur(function(){
            var selectValue = $(this).val();
            if ( selectValue == "" ) {
                $(this).removeClass('filled');
                $(this).parents('.form-group').removeClass('focused');
            } else {
                $(this).addClass('filled');
            }
        });

        $('textarea').focus(function(){
            $(this).parents('.form-group').addClass('focused');
        });
        $('textarea').blur(function(){
            var selectValue = $(this).val();
            if ( selectValue == "" ) {
                $(this).removeClass('filled');
                $(this).parents('.form-group').removeClass('focused');
            } else {
                $(this).addClass('filled');
            }
        });

    }



  }

  Bitacora.inputAnimations();
