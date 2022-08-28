@component('mail::message')
# Hore, cucian sudah kering.
# Waktunya kita healing

@component('mail::table')
|                      |                                                                                 |
| -------------------- | ------------------------------------------------------------------------------- | 
| Nama                 | {{$transaksi->barang->user->name}}                                              | 
| Layanan              | {{$transaksi->layanan->nama}}                                                   |
| Berat                | {{$transaksi->barang->berat}} Kg                                                |
| Total Bayar          | Rp. {{number_format($transaksi->total_bayar)}}                                  |
| Tanggal diambil      | {{ \Carbon\Carbon::parse($transaksi->tanggal_diambil)->format('d m Y, H:i') }}  |
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
