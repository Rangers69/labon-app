<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TransaksiMail;
use App\Models\Barang;
use App\Models\DetailBarang;
use App\Models\Konsumen;
use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\User;
// use App\Http\Livewire\Auth;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Midtrans extends Controller
{
    //

    public function snapToken(Request $request)
    {

        // DB::transaction(function () {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-gtmiotAqQrLpfkPvdWpL8OHo';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // $this->validate();
        $data = $request->all();
        $data_barang = $request->only(['barang']);
        $layanan = DB::table('layanan')->where('id', $data['layanan'])->first();
        // Customers  Details
        $detail_user = DB::table('konsumen')->join('users', 'konsumen.user_id', '=', 'users.id')->where('konsumen.user_id', Auth::user()->id)->get();
        $id_transkasi = rand();

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $layanan->harga * $data['berat']
            )
        );

        $transaction_details =  array(
            'order_id' => $id_transkasi,
            'gross_amount' => $layanan->harga * $data['berat']
        );
        // return $layanan->id;
        // return $data_barang;
        $items = array(
            array(
                'id'       => $layanan->id,
                'price'    => $layanan->harga,
                'quantity' => $data['berat'],
                'name'     => $data_barang['barang']
            )
        );
        // return $items;
        // Populate customer's billing address
        $billing_address = array(
            'first_name'   => $detail_user[0]->name,
            'last_name'    => "",
            'address'      => $detail_user[0]->alamat,
            'city'         => "Jakarta",
            'postal_code'  => "51161",
            'phone'        => $detail_user[0]->hp,
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'   => $detail_user[0]->name,
            'last_name'    => "",
            'address'      => $detail_user[0]->alamat,
            'city'         => "Jakarta",
            'postal_code'  => "51162",
            'phone'        => $detail_user[0]->hp,
            'country_code' => 'IDN'
        );

        // Populate customer's info
        $customer_details = array(
            'first_name'       =>  $detail_user[0]->name,
            'last_name'        => "",
            'email'            => $detail_user[0]->email,
            'phone'            => $detail_user[0]->hp,
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );
        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'        => $items,
            'customer_details'    => $customer_details
        );
        $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
        // return $transaction_data;


        // // Populate customer's billing address
        // $billing_address = array(
        //     'first_name'   => "Andri",
        //     'last_name'    => "Setiawan",
        //     'address'      => "Karet Belakang 15A, Setiabudi.",
        //     'city'         => "Jakarta",
        //     'postal_code'  => "51161",
        //     'phone'        => "081322311801",
        //     'country_code' => 'IDN'
        // );

        // // Populate customer's shipping address
        // $shipping_address = array(
        //     'first_name'   => $detail_user[0]->name,
        //     'last_name'    => "",
        //     'address'      => $detail_user[0]->email,
        //     'city'         => "",
        //     'postal_code'  => "",
        //     'phone'        => $detail_user[0]->hp,
        //     'country_code' => 'IDN'
        // );
        // $detail_user = DB::table('konsumen')->join('users', 'konsumen.user_id', '=', 'users.id')->where('konsumen.user_id', Auth::user()->id)->get();

        // // Populate customer's info
        // $customer_details = array(
        //     'first_name'       => $detail_user[0]->name,
        //     'last_name'        => "",
        //     'email'            => $detail_user[0]->email,
        //     'phone'            => $detail_user[0]->hp,
        //     'billing_address'  => $billing_address,
        //     'shipping_address' => $shipping_address
        // );


        // $barang = Barang::create([
        //     'berat' => $this->berat,
        //     'user_id' => Auth::user()->id,
        // ]);

        // foreach ($this->barang as $item) {
        //     DetailBarang::create([
        //         'barang_id' => $barang->id,
        //         'nama' => $item
        //     ]);
        //     // Populate items
        //     $items = [
        //         [
        //             'id'       => $barang->id,
        //             'price'    => $layanan->harga,
        //             'quantity' => 1,
        //             'name'     => $item
        //         ]
        //     ];
        // }
        $barang = [
            'berat' => $data['berat'],
            'user_id' => Auth::user()->id,
            // 'created_at' => time(),
            // 'updated_at' => time(),
        ];

        DB::table('barang')->insert($barang);

        $data_transkasi = [
            'layanan_id' => $layanan->id,
            'id_transaksi' => $id_transkasi,
            'barang_id' => $layanan->id,
            'user_id' => Auth::user()->id,
            'total_bayar' => $layanan->harga *  $data['berat'],
            'tanggal_diterima' => now(),
            'tanggal_diambil' => now(),
            'status' => 0
        ];
        DB::table('transaksi')->insert($data_transkasi);



        // Transaksi::create([
        //     'layanan_id' => $layanan->id,
        //     'id_transaksi' => $id_transkasi,
        //     'barang_id' => $layanan->id,
        //     'total_bayar' => $layanan->harga *  $data['berat'],
        //     'tanggal_diterima' => now(),
        //     'tanggal_diambil' => now(),
        //     'status' => 0
        // ]);
        // return dd($id_transkasi);
        // $data_transkasi = (object)$data_transkasi;
        // Mail::to($this->email)->send(new TransaksiMail($data_transkasi));

        // session()->flash('sukses', 'Data berhasil ditambahkan.');
        // return redirect('/transaksi', compact('snapToken'));
        return response()->json(['snapToken' => $snapToken]);
        // });
    }

    public function callback(Request $request)
    {
        if ($request->transaction_status == 'settlement') {
            // return $request->order_id . ' Sudah bayar';
            $affected = DB::table('transaksi')
                ->where('id_transaksi', $request->order_id)
                ->update(['status' => 1]);

            // DB::table('tagihans')
            //     ->where('order_id', $request->order_id)
            //     ->update(['status' => 1]);
            return $request->order_id . ' Sudah bayar';
        } else {
            return $request;
        }
    }
}
