<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Hewan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
  <a class="navbar-brand" href="#">Manajemen Hewan</a>
  <div class="ms-auto">
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-danger btn-sm">Logout</button>
      </form>
  </div>
</nav>

<div class="container py-5">
    <h1 class="mb-4 text-center">Daftar Hewan</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('hewan.create') }}" class="btn btn-success">+ Tambah Hewan</a>

        {{-- Search form (GET) but we'll intercept with JS --}}
        <form id="search-form" class="d-flex" method="GET" action="{{ route('hewan.index') }}">
            <input id="search" name="search" value="{{ request('search') }}" 
                   class="form-control me-2" type="search" placeholder="Cari hewan..." aria-label="Search">
            {{-- <button id="search-btn" class="btn btn-primary" type="submit">Cari</button> --}}
        </form>
    </div>

    {{-- CONTAINER yang akan di-replace lewat AJAX --}}
    <div id="table-data">
        @include('hewan.table', ['datahewan' => $datahewan])
    </div>
</div>

{{-- jQuery (opsional) dan script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
(function($){
    // debounce function supaya tidak nge-fire tiap huruf
    function debounce(fn, delay) {
        let timer = null;
        return function() {
            let context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function(){ fn.apply(context, args); }, delay);
        };
    }

    // fungsi untuk load tabel dari server (bisa pake URL atau param search)
    function loadTable(url) {
        $.get(url, function(res) {
            // ambil #table-data dari response HTML dan replace
            const newTable = $(res).find('#table-data').html();
            $('#table-data').html(newTable);
            // ubah history agar URL menunjukkan page/search saat user copy link (opsional)
            if (history.pushState) {
                history.replaceState(null, null, url);
            }
        });
    }

    $(document).ready(function(){
        // Intercept keyup pada input search, debounce 400ms
        $('#search').on('keyup', debounce(function(e){
            e.preventDefault();
            const q = $(this).val();
            // bangun URL ke route hewan.index dengan query string search
            const url = "{{ route('hewan.index') }}" + '?search=' + encodeURIComponent(q);
            loadTable(url);
        }, 400));

        // Intercept klik pagination links yang ada di #table-data
        // gunakan event delegation karena konten diganti
        $(document).on('click', '#table-data .pagination a', function(e){
            e.preventDefault();
            const url = $(this).attr('href');
            if (url) loadTable(url);
        });

        // Optional: intercept form submit tombol Cari agar tetap pakai AJAX
        $('#search-form').on('submit', function(e){
            e.preventDefault();
            const q = $('#search').val();
            const url = "{{ route('hewan.index') }}" + '?search=' + encodeURIComponent(q);
            loadTable(url);
        });
    });
})(jQuery);
</script>

</body>
</html>
