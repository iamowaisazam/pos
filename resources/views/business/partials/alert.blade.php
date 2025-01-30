@if(Session::get('success'))
<script> 
$.toast({
        heading: "{{Session::get('success')}}",
        // text: "{{Session::get('success')}}",
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'info',
        hideAfter: 3500,
        stack: 6,
    });
</script>
@endif

@if(Session::get('error'))
<script> 
  $.toast({
        heading: "{{Session::get('error')}}",
        // text: "{{Session::get('success')}}",
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 3500,
        stack: 6,
    });
</script>
@endif

@if(Session::get('warning'))
<script> 
  $.toast({
        heading: "{{Session::get('warning')}}",
        // text: "{{Session::get('success')}}",
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'warning',
        hideAfter: 3500,
        stack: 6,
    });
</script>
@endif
