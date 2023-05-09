<?php

require_once "app/komik.php";
$komik = new komik();
$rows = $komik->tampil();

if(isset($_GET["cari"])){
    $rows = $komik->cari($_GET["penulis"]);
}

if(isset($_GET['simpan'])) $vsimpan =$_GET['simpan'];
else $vsimpan ='';
if(isset($_GET['update'])) $vupdate =$_GET['update'];
else $vupdate ='';
if(isset($_GET['reset'])) $vreset =$_GET['reset'];
else $vreset ='';
if(isset($_GET['aksi'])) $vaksi =$_GET['aksi'];
else $vaksi ='';
if(isset($_GET['id_komik'])) $vid_komik =$_GET['id_komik'];
else $vid_komik ='';
if(isset($_GET['judul_komik'])) $vjudul_komik =$_GET['judul_komik'];
else $vjudul_komik ='';
if(isset($_GET['penulis'])) $vpenulis =$_GET['penulis'];
else $vpenulis ='';
if(isset($_GET['penerbit'])) $vpenerbit =$_GET['penerbit'];
else $vpenerbit ='';
if(isset($_GET['harga'])) $vharga =$_GET['harga'];
else $vharga ='';

if($vsimpan=='simpan' && ($vjudul_komik <>''||$vpenulis<>''||$vpenerbit <>''||$vharga <>'')){
    $komik->simpan();
    $rows = $komik->tampil();
    $vid_komik ='';
    $vjudul_komik ='';
    $vpenulis ='';
    $vpenerbit ='';
    $vharga = '';
}

if($vaksi=="hapus")  {
    $komik->hapus();
    $rows = $komik->tampil();
}
if($vaksi=="cari")  {
    $rows = $komik->cari();
}

 if($vaksi=="lihat_update")  {
    $urows = $komik->tampil_update();
    foreach ($urows as $row) {
    $vid_komik =$row['id_komik'];
    $vjudul_komik =$row['judul_komik'];
    $vpenulis =$row['penulis'];
    $vpenerbit =$row['penerbit'];
    $vharga =$row['harga'];
    }
 }

if ($vupdate=="update"){
    $komik->update($vid_komik,$vjudul_komik,$vpenulis,$vpenerbit,$vharga);
    $rows = $komik->tampil();
    $vid_komik ='';
    $vjudul_komik ='';
    $vpenulis ='';
    $vpenerbit ='';
    $vharga ='';
}
if ($vreset=="reset"){
    $vid_komik ='';
    $vjudul_komik ='';
    $vpenulis ='';
    $vpenerbit ='';
    $vharga ='';
}


?>

<form action="?" method="get">
<table>
    <tr><td>ID USER</td><td>:</td><td>
        <input type="hidden" name="id_komik" value="<?php echo $vid_komik; ?>" /><input type="text" name="judul_komik" value="<?php echo $vjudul_komik; ?>" /></td></tr>
    <tr><td>KOMIK</td><td>:</td><td><input type="text" name="judul_komik" value="<?php echo $vjudul_komik; ?>"/></td></tr>
    <tr><td>PENULIS</td><td>:</td><td><input type="text" autocomplete="off" name="penulis" value="<?php echo $vpenulis; ?>"/></td></tr>
    <tr><td>PENERBIT</td><td>:</td><td><input type="text" name="penerbit" value="<?php echo $vpenerbit; ?>"/></td></tr>
    <tr><td>HARGA</td><td>:</td><td><input type="text" name="harga" value="<?php echo $vharga; ?>"/></td></tr>
    <tr><td></td><td></td><td>
    <input type="submit" name='simpan' value="simpan"/>
    <input type="submit" name='update' value="update"/>
    <input type="submit" name='reset' value="reset"/>
    <input type="submit" name='cari' value="cari"/>
    </td></tr>
</table>
</form>



    <table border="1px">
    <tr>
        <td>ID</td>
        <td>KOMIK</td>
        <td>PENULIS</td>
        <td>PENERBIT</td>
        <td>HARGA</td>
        <td>AKSI</td>
    </tr>

      <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row['id_komik']; ?></td>
            <td><?php echo $row['judul_komik']; ?></td>
            <td><?php echo $row['penulis']; ?></td>
            <td><?php echo $row['penerbit']; ?></td>
            <td><?php echo $row['harga']; ?></td>
            <td><a href="?id_komik=<?php echo $row['id_komik']; ?>&aksi=hapus">Hapus</a>&nbsp;&nbsp;&nbsp;
                <a href="?id_komik=<?php echo $row['id_komik']; ?>&aksi=lihat_update">Update</a>
                &nbsp;&nbsp;&nbsp;</td>

        </tr>
    <?php 
    }

