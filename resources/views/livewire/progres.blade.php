<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Halaman Progres</h2>

            @include('layouts/flashdata')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Tanggal diterima</label>
                    <input wire:model="tanggal_diterima" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Tanggal diambil</label>
                    <input wire:model="tanggal_diambil" type="date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Search</label>
                    <div class="input-group">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search">
                        <div class="input-group-prepend" style="cursor: pointer">
                            <div wire:click="format_search" class="input-group-text">x</div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="10%" scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Layanan</th>
                        <th scope="col">Tanggal Diterima</th>
                        <th scope="col">Tanggal Diambil</th>
                        <th scope="col">Status</th>
                        @if(auth()->user()->role_id == '3')

                        @else
                        <th width="10%" scope="col">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($progres as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{$item->user->name}}</td>
                        <td>Rp. {{ number_format($item->total_bayar) }}</td>
                        <td>{{ $item->layanan->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_diterima)->format('d m Y, H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_diambil)->format('d m Y, H:i') }}</td>
                        <td>
                            @if ($item->status == 0)
                            <span class="badge badge-secondary">Sudah Dibayar</span>
                            @elseif ($item->status == 1)
                            <span class="badge badge-dark">Waiting</span>
                            @elseif ($item->status == 2)
                            <span class="badge badge-primary">Proses Pencucian</span>
                            @elseif ($item->status == 3)
                            <span class="badge badge-info">Selesai</span>
                            @elseif ($item->status == 4)
                            <span class="badge badge-info">telah diambil</span>
                            @elseif ($item->status == 5)
                            <span class="badge badge-info">telah diantar</span>
                            @elseif ($item->status == 6)
                            <span class="badge badge-info">Selesai</span>
                            @endif
                        </td>
                        <td>

                            @if(auth()->user()->role_id == '3')

                            @else
                            @if ($item->status == 0)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-dark mr-2">Waiting</button>
                            @elseif ($item->status == 1)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-primary mr-2">Proses Pencucian</button>
                            @elseif ($item->status == 2)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-info mr-2">Selesai dicuci</button>
                            @elseif ($item->status == 3)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-info mr-2">telah diambil</button>
                            @elseif ($item->status == 4)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-info mr-2">telah diantar</button>
                            @elseif ($item->status == 5)
                            <button wire:click="aksi({{ $item->id }})" type="button" class="btn btn-sm btn-info mr-2">Selesai</button>
                            @endif
                            @endif


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $progres->links() }}
        </div>
    </div>
</div>