{{-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $message }}</strong>
</div>
@endif
<script>
    // JavaScript code to handle the close button click event
    document.addEventListener('DOMContentLoaded', function() {
        var closeButtons = document.querySelectorAll('.close[data-dismiss="alert"]');
        
        closeButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.style.display = 'none';
            });
        });
    });
</script> --}}
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.options.timeOut = 10000;
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':

                toastr.options.timeOut = 10000;
                toastr.success("{{ Session::get('message') }}");
               

                break;
            case 'warning':

                toastr.options.timeOut = 10000;
                toastr.warning("{{ Session::get('message') }}");
               

                break;
            case 'error':

                toastr.options.timeOut = 10000;
                toastr.error("{{ Session::get('message') }}");
               

                break;
        }
    @endif
</script>