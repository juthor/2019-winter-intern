$.fn.rachel = function(){
    return this.each(function(){
        //alert($(this).children('.material-icons').length);
        if($(this).children('.fa-fw').length==0){
            $(this).prepend('<span class="fas fa-check-circle fa-fw rachel-on"></span><span class="far fa-fw fa-circle rachel-off"></span>');

            

            // $(this).find('input').trigger('change');

            $(this).children('input').on('change',function(e){
                ale($(this).attr('name'),$(this).attr('value'));
            });
        }

        if($(this).find('input').prop('checked')==true){
            $(this).addClass('checked');
        }else{
            $(this).removeClass('checked');
        }
    });

    function ale(inputName,value){
        var input = $('input[name="'+inputName+'"][value="'+value+'"]');

        switch(input.attr('type')){
            case 'radio':
                $('input[name="'+inputName+'"]').each(function(){
                    if($(this).prop('checked')){
                        $(this).parents('label.rachel').addClass('checked');
                    }else{
                        $(this).parents('label.rachel').removeClass('checked');
                    }
                });
                break;

            case 'checkbox':
                if(input.prop('checked')){
                    input.parents('label.rachel').addClass('checked');
                }else{
                    input.parents('label.rachel').removeClass('checked');
                }
                break;
        }
    }
};