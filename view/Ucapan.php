<?php
include "services/functions.php";

if (isset($_POST['submit'])) {
  if (inputKomentar($_POST) > 0) {
    echo "
        <script>
        swal({
          title: 'Komentar Gagal !',
          text: 'Coba ulangi',
          icon: 'error',
          button: 'Ok',
        });
        </script>
      ";
  } else {
    echo "
        <script>
        swal({
          title: 'Komentar Berhasil',
          text: 'Terima Kasih atas Ucapan dan Doa nya 🥰',
          icon: 'success',
          button: 'Ok',
        });
        </script>
      ";
  }
}

$jumlahUcapan = 7;
$viewUcapan = count(koneksi("SELECT * FROM komentar"));
$jumlahHalaman = ceil($viewUcapan / $jumlahUcapan);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$hitungPagination = ($jumlahUcapan * $halamanAktif) - $jumlahUcapan;

$komentar = koneksi("SELECT * FROM komentar ORDER BY id DESC LIMIT $hitungPagination, $jumlahUcapan");

?>



<section class="bg-wakwak" id="ucapan">
  <div class="container py-5">
    <div class="row text-center justify-content-center">
      <div class="col-12 mb-5" data-aos="zoom-in" data-aos-duration="1300" data-aos-delay="2250">
        <h1 class="font-dancing fs-40">Wishes</h1>
        <p class="p-0 m-0">Doa Restu Anda merupakan karunia</p>
        <p class="p-0 m-0">yang sangat berarti bagi kami.</p>
      </div>
      <div class="col-md-10 col-12 mx-2" data-aos="zoom-in" data-aos-duration="1300" data-aos-delay="2500">
        <div class="card bg-fee rounded-3 p-3">

          <form action="" method="post">
            <div class="mb-3">
              <input type="text" name="nama" placeholder="Nama" class="form-control" required />
            </div>
            <div class="mb-3">
              <textarea name="ucapan" placeholder="ucapan" rows="4" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
              <select name="status" class="form-select" required>
                <option disabled selected>Konfirmasi Kehadiran</option>
                <option value="Hadir">Hadir</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
              </select>
            </div>
            <div class="mb-3 text-start">
              <button type="submit" name="submit" class="btn bg-berem btn-outline-secondary text-white">Kirim</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- hasil komentar -->
<section class="bg-wakwak">
  <div class="container mb-3">
    <div class="row">
      <div class="col-md-12">
        <?php $i = 1; ?>
        <?php foreach ($komentar as $db) : ?>

          <div class="card komen rounded-4 border border-0 mt-3">

            <div class="card-header" style="background-color: #8785a2;">
              <div class="row d-flex justify-content-between">
                <div class="col">
                  <small class="text-white"><i class="bi bi-person-fill" style="color: #ffe2e2; margin-right: 2px;"></i><?= $db['nama']; ?></small>
                </div>
                <div class="col-auto">
                  <small class="text-white" style="font-size: 11px; margin-top: 5px;"><?= $db['date']; ?></small>
                </div>
              </div>
            </div>

            <div class="card-body" style="margin-top: -10px;">
              <small class="d-flex mb-2" style="font-weight: bold;"><?= $db['status']; ?></small>
              <hr style="margin-top: -1px;">
              <p class="card-text" style="margin-top: -10px;"><?= $db['ucapan']; ?></p>
            </div>

          </div>
          <?php $i++; ?>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</section>

<!-- pagination -->
<div class="container">
  <nav aria-label="Page navigation example" class="d-flex justify-content-center align-items-center">
    <ul class="pagination">
      <?php if ($halamanAktif > 1 ) : ?>
      <li class="page-item">
        <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if($i == $halamanAktif ) : ?>
        <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>" style="font-weight:bold; color:#ffe2e2;"><?= $i; ?></a></li>
        <?php else : ?>
      <li class="page-item"><a class="page-link text-dark" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
      
      <?php endif; ?>
    <?php endfor; ?>


      <?php if($halamanAktif < $jumlahHalaman) : ?>
      <li class="page-item">
        <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <?php endif; ?>


    </ul>
  </nav>

</div>


<style>
  body {
    background-color: #ffe2e2;
  }

  .komen {
    overflow: hidden;
  }
</style>