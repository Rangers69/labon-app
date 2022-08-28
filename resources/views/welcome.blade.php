<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

     <!-- Scripts -->
     <script src="{{ asset('js/app.js') }}" defer></script>
 
     <!-- Styles -->
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
     <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>
<body>
   <div id="hero">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-6">
                <h1 class="display-4">BNC Laundry</h1>
                <p class="mb-5">Pelayanan yang bagus dan murah</p>
                <a href="{{ url('login')}}" class="btn btn-primary active">Continue</a>
            </div>
            <div class="col-md-6">
                <img src="/images/hero.svg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
   </div>

   <div id="layanan">
       <div class="container">
           <div class="row text-center">
               <div class="col-md-12">
                   <h1>Layanan</h1>
               </div>
               @foreach ($layanan as $item)
                    <div class="col-lg-3 col-6">
                        <div class="card shadow my-4">
                            <div class="card-body">
                                <h2 class="mb-4">{{$item->nama}}</h2>
                                <p>Durasi : {{$item->durasi}} jam</p>
                                <p>Harga : Rp. {{number_format($item->harga)}}</p>
                            </div>
                        </div>
                    </div>
               @endforeach
           </div>
       </div>
   </div>

   <div id="lokasi">
       <div class="container">
           <div class="row text-center">
               <div class="col-md-12">
                   <h1>Lokasi</h1>
               </div>
               <div class="col-md-12 my-4">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.8931972454766!2d106.79878961535117!3d-6.145045161951135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f61a3cf216b7%3A0xdc5d7906f7053d83!2sJl.%20Sawah%20Lio%20V%20No.93%2C%20RT.1%2FRW.4%2C%20Jemb.%20Lima%2C%20Kec.%20Tambora%2C%20Kota%20Jakarta%20Barat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2011250!5e0!3m2!1sid!2sid!4v1654832425185!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
               </div>
           </div>
       </div>
   </div>

   <div id="footer">
       <p class="text-center">Copyright @ 2021</p>
   </div>
</body>
</html>