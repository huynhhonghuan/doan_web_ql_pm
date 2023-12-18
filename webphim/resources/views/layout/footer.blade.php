<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('#tablephim', {
            language: {
                info: 'Hiện thị trang _PAGE_ trên _PAGES_',
                infoEmpty: 'Không có phim nào',
                infoFiltered: '(được lọc từ tổng số _MAX_ phim)',
                lengthMenu: 'Hiện thị _MENU_ phim',
                zeroRecords: 'Không tìm thấy',
                search: 'Tìm kiếm: ',
                paginate: {
                    previous: '<<',
                    next: '>>'
                }
            },
            // scrollX: true,
        });
    });
</script>
<script>
    $('.select-year').change(function() {
        var year = $(this).find(':selected').val();
        var id_movie = $(this).attr('id');

        //alert(year);
        $.ajax({
            url: "{{ route('admin.movie.update_year') }}",
            method: "GET",
            data: {
                year: year,
                id_movie: id_movie,
            },
            success: function() {
                alert('Thay đổi năm phim thành năm ' + year + ' thành công');
            }
        });
    })
</script>
@yield('footer')
