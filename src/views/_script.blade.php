<script>
    if(typeof(flash_messages) !== 'undefined')
        if(flash_messages != null)
            for(i = 0; i < flash_messages.length; i++)
                toastr[flash_messages[i]['type']](flash_messages[i]['message'], flash_messages[i]['title'], flash_messages[i]['options']);
</script>