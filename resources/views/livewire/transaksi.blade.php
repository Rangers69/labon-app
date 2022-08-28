<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('layouts/sidebar')
        </div>
        <div class="col-md-9">
            <h2>Halaman Transaksi</h2>

            @include('layouts/flashdata')
            <form id="pay-transaksi" action="/snapToken" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                @foreach($detail_user as $sr)
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $sr->name }}" readonly>
                                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $sr->email }}" readonly>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="hp">Hp</label>
                                    <input type="number" class="form-control" id="hp" min="1" name="hp" value="{{ $sr->hp }}" readonly>
                                    @error('hp') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" readonly>{{ $sr->alamat }}
                                    </textarea>
                                    @error('alamat') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="layanan_nama">Layanan</label>
                                    <select wire:model="layanan_nama" name="layanan" class="form-control" id="layanan_nama">
                                        <option>Pilih Layanan</option>
                                        @foreach ($layanan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }} / (Rp.
                                            {{ number_format($item->harga) }})
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('layanan_nama') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="berat">Jumlah Sepatu ( 1 Sepatu = 1 Pasang )</label>
                                    <input wire:model="berat" type="number" class="form-control" name="berat" id="berat" min="1">
                                    @error('berat') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="total_bayar">Total Bayar</label>
                                    <input wire:model="total_bayar" readonly type="text" name="total_bayar" class="form-control" id="total_bayar">
                                    @error('total_bayar') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Masuan Merek / Jenis Barang Anda</label>
                                    @foreach ($barang as $key => $item)
                                    <div class="input-group mb-2">
                                        <input wire:model="barang.{{$key}}" type="text" name="barang" class="form-control">
                                        <div class="input-group-prepend">
                                            <div wire:click="hapus_barang({{$key}})" class="input-group-text pointer">x</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @error('barang') <small class="text-danger">{{ $message }}</small> @enderror
                                    @error('barang.*') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                {{-- <span wire:click="tambah_barang" class="badge badge-primary pointer">Tambah</span> --}}
                            </div>
                        </div>
                        {{-- wire:click="store" --}}
                        <button id="pay-button" type="submit" class="btn btn-success btn-sm mt-3">Simpan Transaksi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>