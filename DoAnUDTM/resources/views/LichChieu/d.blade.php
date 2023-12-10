<script>
    $(document).ready(function() {
     $('#create-phim-form').on('submit', function(event) {
         event.preventDefault();
         
         let formData = new FormData(this);
 
         $.ajax({
             url: "{{ route('create_lichchieu') }}",
             type: 'POST',
             data: formData,
             contentType: false,
             processData: false,
 
             success: function(res) {
                 console.log(res.phongchieu);
                 alert(res.message);
                 window.location.href = document.referrer;
             },
             error: function(er) {
                 let err = er.responseJSON;
                 $.each(err.errors, function(index, value) {
                     $('.errorMessage').append('<span class="text-danger">' + value + '</span><br/>  ')
                 });
             }
         });
     });
 });
 
 </script>