<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Perhitungan Total Pembelian</title>
    <style>
        body
        {
            font-family:Arial,sans-serif;
            background-image: url('Backgraund.jpeg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container
        {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: 150px auto;
        }
        form 
        {
            width: 45%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
        }
        label 
        {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="number"] 
        {
            width: 96%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        button[type="submit"] 
        {
            width: 100%;
            height: 40px;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        button[type="submit"]:hover 
        {
            background-color: #3e8e41;
        }
        .result 
        {
            width: 45%;
            background-color: #f0f0f0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
    <!-- Ini adalah form yang nantinya input harga totalnya akan di ambil 
     untuk melakukan perhitungan sedangkan kode member hanya di isi ketika 
     costumer adalah member -->

        <form action="" method="post">
         <label for="total_pembelian"><b>Total Pembelian :</b></label>
         <input type="number" id="total_pembelian" name="total_pembelian" required>
         <label for="kode_member"><b>Kode Member (Jika Member) : </b></label>
         <input type="text" id="kode_member" name="kode_member">
         <button type="submit" name="submit"><b>Hitung</b></button>
        </form>

        <!-- Function untuk menentukan hak member pada customer -->
    <?php
    function hitung_diskon($total_pembelian, $kode_member) 
    {
      if ($kode_member != '') // ketika kode member di isi maka akan mendapatkan discound member
      {
        // Member
        if ($total_pembelian >= 500000) 
        {
          $diskon = 20; //Jika membeli di atas 500.000 akan mendapatkan discond 10% + 10% = 20%
        } 
        elseif ($total_pembelian >= 300000) 
        {
          $diskon = 15; //Jika membeli di atas 300.000 sampai 500.000 akan mendapatkan discound 10% + 5% = 15%
        } 
        else 
        {
          $diskon = 10; // hanya diskon member dengan total pembeliah di bawah 300.000 akan mendapatkan 10%
        }
      } 
      else // jika tidak di isi maka akan di deteksi sistem bukan member
      {
        // Bukan member
        if ($total_pembelian >= 500000) 
        {
          $diskon = 10; // untuk yang bukan member mendapatkan discond 10% dengan total pembelian 500.000
        } 
        else 
        {
          $diskon = 0; //total Pembeliah di bawah 500.000 maka tidak mendapatkan diskon
        }
      }
      return $diskon;
    }
    //Rumus untuk menghitung total pembelian setelah diskon untuk mendapatkan hasil akhir
    function hitung_total_pembelian_setelah_diskon($total_pembelian, $diskon) 
    {
        $total_pembelian_setelah_diskon = $total_pembelian - ($total_pembelian * $diskon / 100);
        return $total_pembelian_setelah_diskon;
    }
    // Melakukan pengambilan data input dari form untuk di kelolah perhitunggannya
    if (isset($_POST['submit'])) 
    {
        $total_pembelian = $_POST['total_pembelian']; // mengambil nilai total pembelian dari form
        $kode_member = $_POST['kode_member']; // mengambil nilai kode member dari input form
  
        $diskon = hitung_diskon($total_pembelian, $kode_member); // menentukan discond yang akan di gunakan
        // melakukan perhitungan dengan function
        $total_pembelian_setelah_diskon = hitung_total_pembelian_setelah_diskon($total_pembelian, $diskon);
        
        ?>
        <!-- Untuk menampilkan hasil perhitungan-->
        <div class="result">
             <h2>Hasil Perhitungan</h2>
             <!-- fungsi number_format digunakan untuk memformatnya dalam tampilan uang Rupiah yang menambahakan . dan , -->
             <p>Total Pembelian: Rp <?php echo number_format($total_pembelian, 2, ',', '.'); ?></p>
             <p>Diskon: <?php echo $diskon; ?>%</p>
             <!-- fungsi number_format digunakan untuk memformatnya dalam tampilan uang Rupiah yang menambahakan . dan , -->
             <p>Total Pembelian Setelah Diskon: Rp <?php echo number_format($total_pembelian_setelah_diskon, 2, ',', '.'); ?></p>
        </div>
        <?php
    }
    // CREDIT
    // Pembuat Fareza Dava Rabbani
    // Kelas 3P41
    // NIM 23.240.0057
    ?>
</body>
</html>