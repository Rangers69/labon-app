@component('mail::message')
# Hore,transaksi berhasil. 

@component('mail::table')
|                  |                                                                                 |
| ---------------- | ------------------------------------------------------------------------------- | 
| Nama             | {{$transaksi->barang->user->name}}                                              | 
| Layanan          | {{$transaksi->layanan->nama}}                                                   |
| Berat            | {{$transaksi->barang->berat}} Kg                                                |
| Estimasi         | {{$transaksi->layanan->durasi}} Jam                                             |
| Total Bayar      | Rp. {{number_format($transaksi->total_bayar)}}                                  |
| Tanggal diterima | {{ \Carbon\Carbon::parse($transaksi->tanggal_diterima)->format('d m Y, H:i') }} |
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
