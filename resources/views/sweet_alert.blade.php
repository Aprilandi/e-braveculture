@if (session('success'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('transaksi'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: "Terima kasih!",
        text: "{{ session('transaksi') }}"
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('password'))
<script>
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: "Email atau Password yang anda masukkan salah!",
        text: "{{ session('password') }}"
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif
