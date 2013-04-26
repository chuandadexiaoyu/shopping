$(function(){

    function getContext($for)
    {
        var $context = {
            id: $for.parents('tr').attr('data-pk'),
            table: $for.parents('table').attr('id')
        }
        return JSON.stringify($context);
    }


    function setup_editables()
    {
        // Instructions for in-place editing
        // $('.ed').editable({
        //     type: 'text',
        //     url:  '#',
        //     params: {'table': $(this).parents('table').attr('id'), 'foo':'bar' },
        //     ajaxOptions: {
        //         type: 'put',
        //         dataType: 'json',
        //         // params: $(this).parents('table').attr('id')
        //         // params: {'table': $(this).parents('table').attr('id')}
        //     }
        // });

        // $('.hp').editable({
        //     type: 'select',
        //     url: 'admin/'+tab_name+'/edit',
        //     source: [
        //         {value: 'admin', text: 'admin'},
        //         {value: 'entry', text: 'entry'},
        //         {value: 'report', text: 'report'}
        //     ],
        // });
//      console.log('editables set up');
    }

    // When a row is hovered over, show the buttons
    $('tr').hover(
        function() {
            $(this).find('.btn_del').css('display', 'block');
        },
        function() {
            $(this).find('.btn_del').css('display', 'none');
        }
    );

    // Delete a record when the delete button is pressed
    $('.btn_del').click(function() {
        $this = $(this);
        $.ajax({
            type: 'DELETE',
            data: getContext($this),
            success: function() { $this.parents('tr').fadeOut(); }
        });
    });

    // add a record when the add button is pressed
    // $('.btn_add').click(function() {
    //     $this = $(this);
    //     $.ajax({
    //         type: 'POST',
    //         data: getContext($this)
    //         // success: function() { $this.parents('tr').fadeOut(); }
    //     });
    //     return false;
    // });

    // clear the fields when the clear button is pressed
    $('.btn_reset').click(function(){
        $form = $(this).parents('form');
        $form.find(':input').val('');
        return false;
    });

    // Setup for the page
    $('.btn_del').css('display', 'none');
    $.fn.editable.defaults.mode = 'inline';   // Make in-place editing work in inline mode
    setup_editables();
});