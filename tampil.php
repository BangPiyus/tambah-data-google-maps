<?php

function bersihkan($string) {
    return preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
}

function angkasaja($data){
    $hasil = preg_replace('/\D/', '', $data);
    return $hasil;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Kontak</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  
  <style>
  
    /* Efek air */
    body {
      background: #000;
      color:#fff;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'%3E%3Cg fill-opacity='.1'%3E%3Cpath fill='%2300f' d='M50 12L25 88l50-24-25-64zm0 25l-19 38 38-19-19-19zM27 75l8-3-3-8-5 11zM54 29l-4 9 9-4-5-5z'/%3E%3C/g%3E%3C/svg%3E");
      animation: water 20s infinite linear alternate;
    }

    @keyframes water {
      0% {
        background-position: 50% 0%;
      }
      100% {
        background-position: 50% 100%;
      }
    }
    .centered-form {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
  </style>
</head>
<body>

<div class="centered-form" style="padding:15px;margin:15px;">
  <div class="col-md-6">
    <h4 class="text-center">Render Data</h4>
    <p>Isi nama kota lalu klik proses</p>
    <form method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Kota</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
        <br><br>
        
      </div>
      <button type="submit" name="cek" class="btn btn-primary btn-lg btn-block"  style="width:100%">PROSES</button>
    </form>
    <br><br>
    <?php
        if(isset($_POST['cek'])){
            $kota = trim(strtolower($_POST['nama']));

            $datanya = '';

            // Baca isi file JSON
            $json_data = file_get_contents('hasil.json');

            $pecah = explode('googleUrl',$json_data);
            $banyak_pecah = count($pecah);

            // var_dump($pecah[0]);
            for ($i=0; $i <$banyak_pecah ; $i++) { 
                $pecah_2 = explode('name',$pecah[$i]);   
                $pecah_3 = explode('website',$pecah_2[1]);
                $pecah_4 = explode('phone',$pecah_3[1]);
                $namax = trim(bersihkan($pecah_3['0']));
                $hpx = angkasaja(bersihkan($pecah_4['1']));

                $hpx_2 = substr($hpx, 0,1);
                if($hpx_2=='0'){
                    $hp_3 = '62'.substr($hpx,1);
                }else{
                    $hp_3 = $hpx;
                }
    ?>
    
    <?php
                $datanya .= $namax.' '.$kota.','.$hp_3.PHP_EOL;
                // echo $namax.' '.$kota.','.$hp_3.'<br>'; 
            }
    ?>
    <label class="form-label">Hasil</label>
    <textarea class="form-control"><?= $datanya; ?></textarea>
    <?php

        }
    ?>
  </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
