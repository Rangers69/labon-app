<div class="list-group d-none d-sm-none d-md-block">
    @can('admin')
    <a href="/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="/karyawan" class="list-group-item list-group-item-action">Karyawan</a>
    <a href="/layanan" class="list-group-item list-group-item-action">Layanan</a>
    {{-- <a href="/transaksi" class="list-group-item list-group-item-action">Transaksi</a> --}}
    <!-- <a href="/transaksi" class="list-group-item list-group-item-action">Transaksi</a>
    <a href="/progres" class="list-group-item list-group-item-action">Progres</a> -->
    @endcan

    @can('karyawan')
    <a href="/dashboard" class="list-group-item list-group-item-action">Dashboard</a>
    <a href="/layanan" class="list-group-item list-group-item-action">Layanan</a>
    @endcan

    @can('konsumen')
    <a href="/transaksi" class="list-group-item list-group-item-action">Transaksi</a>
    @endcan

    <a href="/progres" class="list-group-item list-group-item-action">Progres</a>
</div>