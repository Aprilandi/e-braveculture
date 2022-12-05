@if (session('insert'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Data Berhasil Ditambah',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('update'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Data Berhasil Diubah',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('delete'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Data Berhasil Dihapus',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif