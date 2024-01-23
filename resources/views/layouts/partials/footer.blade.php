<footer id="footer" class="footer">
  <div class="credits">
    Developed by <a target="_blank" href="https://www.codecell.com.bd">CodeCell Limited</a>
  </div>
</footer>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/theme.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script>
  
  onload = () => {
    // Show session's message
    "@if(session('success') || session('warning') || session('info') || session('error'))"
        let success = "{{ session('success') }}"
        let warning = "{{ session('warning') }}"
        let info = "{{ session('info') }}"
        let error = "{{ session('error') }}"
        
        toastr.options.timeOut = 2500
  
        if(success) toastr.success(success)
        if(warning) toastr.warning(warning)
        if(info) toastr.info(info)
        if(error) toastr.info(error)
    "@endif"
  }
</script>