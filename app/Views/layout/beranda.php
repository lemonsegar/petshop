<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>
<div class="col-sm-12">
<marquee behavior="scroll" direction="left" scrollamount="5" style="font-size: 24px; color: white;">
       SELAMAT DATANG DI WEBSITE PETSHOP 
    </marquee>
    <div class="page-title-box">
        <h4 class="page-title"> Selamat Datang </h4>
    </div>
</div>
<div class="col-sm-12">
    <div class="card m-b-60">
        <h4 class="card-header mt-0">
            Hallo
        </h4>
    </div>
    <div class="card-body">
        <p class="card-text">
            <div class="alert alert-info">Selamat Datang di portal Sistem Informasi PetShop</div>
        </p>
    </div>
</div>

<?= $this->endSection('')?>