$(function()
{

    function findInstanceOf(obj)
    {
        for(var v in window){
            try{
                if(window[v] instanceof obj){
                    return v;
                }
            }catch(e){}
        }
        return false;
    }

    function getContext($for)
    {
        var $context = {
            id: $for.parents('tr').attr('data-pk'),
            table: $for.parents('table').attr('id')
        }
        return JSON.stringify($context);
    };


    // When a row is hovered over, show the buttons
    $table = $('table');
    $table.on('mouseenter', 'tr', function(){ $(this).find('.btn_del').show(); })
          .on('mouseleave', 'tr', function(){ $(this).find('.btn_del').hide(); });

    // clear the fields when the clear button is pressed
    $table.on('click', '.btn_reset', function(){
        $(this).parents('form').find(':input').val('');
        return false;
    });

    // Delete a record when the delete button is pressed
    $table.on('click', '.btn_del', function() {
        $this = $(this);
        $.ajax({
            type: 'DELETE',
            data: getContext($this),
            success: function() { $this.parents('tr').fadeOut(); }
        });
    });

    // Edit a record when clicked on
    function setupEditables($page) {
        $tableName = '#'+$page+'_table';
        $table = $($tableName);
        $table.find('.ed').editable({
            type:   'text',
            url:    '#',
            params: {'table': $tableName, },
            ajaxOptions: {
                type: 'PUT',
                // dataType: 'json',
            }
        });
        $table.find('.dt').editable({
            type:   'date',
            format: 'yyyy-mm-dd',    
            viewformat: 'DD, MM d, yyyy',
        });
    }

    // $('table').on('click', '.editable-submit', function() {
    //     $form = $(this);
    //     console.log($form);
    // });


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


    // Setup for the page
    $('.btn_del').hide();
    $.fn.editable.defaults.mode = 'inline';   // Make in-place editing work in inline mode
    setupEditables('dates');
    setupEditables('item');
    setupEditables('vendor');
    setupEditables('account');
    setupEditables('user');
});

