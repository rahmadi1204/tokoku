   <script>
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $('#logout').click(function(e) {
           Swal.fire({
               title: 'Are you sure?',
               text: "Anda Akan Keluar Dari Aplikasi!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Oke, Keluar!'
           }).then((result) => {
               if (result.isConfirmed) {
                   $('#logoutform').submit();
               }
           })
       });
       $('.delete').click(function(e) {
           let id = $(this).data('id');
           let name = $(this).data('name');
           console.log(name);
           Swal.fire({
               title: 'Are you sure?',
               text: "Anda Akan Menghapus Data " + name + "!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Oke, Hapus!'
           }).then((result) => {
               if (result.isConfirmed) {
                   $.ajax({
                       type: "POST",
                       url: "{{ route('setting.user.delete') }}",
                       data: {
                           id: id,
                           name: name,
                       },
                       success: function(response) {
                           $(".overlay").show();
                           Swal.fire(
                               'Deleted!',
                               'Data ' + name + ' Dihapus',
                               'success'
                           );
                           location.reload();
                       }
                   });
               }
           })
       });
   </script>
   @if (session()->has('success'))
       <script>
           const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                   toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
           })

           Toast.fire({
               icon: 'success',
               title: '{{ session()->get('success') }}'
           })
       </script>
   @elseif (session()->has('info'))
       <script>
           const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                   toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
           })

           Toast.fire({
               icon: 'info',
               title: '{{ session()->get('info') }}'
           })
       </script>
   @elseif (session()->has('error'))
       <script>
           const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               didOpen: (toast) => {
                   toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
           })

           Toast.fire({
               icon: 'error',
               title: '{{ session()->get('error') }}'
           })
       </script>
   @endif
