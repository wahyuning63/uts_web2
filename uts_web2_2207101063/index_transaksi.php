<?php

require_once "app/transaksi.php";
$transaksi = new transaksi();
$rows = $transaksi->tampil();

if(isset($_GET["cari"])){
    $rows = $transaksi->cari($_GET["tol_harga"]);
}

if(isset($_GET['simpan'])) $vsimpan =$_GET['simpan'];
else $vsimpan ='';
if(isset($_GET['update'])) $vupdate =$_GET['update'];
else $vupdate ='';
if(isset($_GET['reset'])) $vreset =$_GET['reset'];
else $vreset ='';
if(isset($_GET['aksi'])) $vaksi =$_GET['aksi'];
else $vaksi ='';
if(isset($_GET['id_transaksi'])) $vid_transaksi =$_GET['id_transaksi'];
else $vid_transaksi ='';
if(isset($_GET['kd_transaksi'])) $vkd_transaksi =$_GET['kd_transaksi'];
else $vkd_transaksi ='';
if(isset($_GET['id_user'])) $vid_user =$_GET['id_user'];
else $vid_user ='';
if(isset($_GET['id_komik'])) $vid_komik =$_GET['id_komik'];
else $vid_komik ='';
if(isset($_GET['tol_harga'])) $vtol_harga =$_GET['tol_harga'];
else $vtol_harga ='';

if($vsimpan=='simpan' && ($vkd_transaksi<>''||$vid_user <>''||$vid_komik <>''||$vtol_harga <>'')){
    $transaksi->simpan();
    $rows = $transaksi->tampil();
    $vid_transaksi ='';
    $vkd_transaksi ='';
    $vid_user ='';
    $vid_komik ='';
    $vtol_harga = '';
}

if($vaksi=="hapus")  {
    $transaksi->hapus();
    $rows = $transaksi->tampil();
}
if($vaksi=="cari")  {
    $rows = $transaksi->cari();
}

 if($vaksi=="lihat_update")  {
    $urows = $transaksi->tampil_update();
    foreach ($urows as $row) {
    $vid_transaksi =$row['id_transaksi'];
    $vkd_transaksi =$row['kd_transaksi'];
    $vid_user =$row['id_user'];
    $vid_komik =$row['id_komik'];
    $vtol_harga =$row['tol_harga'];
    }
 }

if ($vupdate=="update"){
    $transaksi->update($vid_transaksi,$vkd_transaksi,$vid_user,$vid_komik,$vtol_harga);
    $rows = $transaksi->tampil();
    $vid_transaksi ='';
    $vkd_transaksi ='';
    $vid_user ='';
    $vid_komik ='';
    $vtol_harga = '';
}
if ($vreset=="reset"){
    $vid_transaksi ='';
    $vkd_transaksi ='';
    $vid_user ='';
    $vid_komik ='';
    $vtol_harga = '';
}


?>

<form action="?" method="get">
<table>
    <tr><td>ID_TRANSAKSI</td><td>:</td><td>
        <input type="hidden" name="id_transaksi" value="<?php echo $vid_transaksi; ?>" /><input type="text" name="kd_transaksi" value="<?php echo $vkd_transaksi; ?>" /></td></tr>
    <tr><td>KODE TRANSAKSI</td><td>:</td><td><input type="text" name="kd_transaksi" value="<?php echo $vkd_transaksi; ?>"/></td></tr>
    <tr><td>ID USER</td><td>:</td><td><input type="text"  name="id_user" value="<?php echo $vid_user; ?>"/></td></tr>
    <tr><td>ID KOMIK</td><td>:</td><td><input type="text" name="id_komik" value="<?php echo $vid_komik; ?>"/></td></tr>
    <tr><td>HARGA</td><td>:</td><td><input type="text" autocomplete="off" name="tol_harga" value="<?php echo $vtol_harga; ?>"/></td></tr>
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
        <td>KODE TRANSAKSI</td>
        <td>ID_USER</td>
        <td>ID_KOMIK</td>
        <td>TOTAL HARGA</td>
        <td>AKSI</td>
    </tr>

    <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row['id_transaksi']; ?></td>
            <td><?php echo $row['kd_transaksi']; ?></td>
            <td><?php echo $row['id_user']; ?></td>
            <td><?php echo $row['id_komik']; ?></td>
            <td><?php echo $row['tol_harga']; ?></td>
            <td><a href="?id_transaksi=<?php echo $row['id_transaksi']; ?>&aksi=hapus">Hapus</a>&nbsp;&nbsp;&nbsp;
                <a href="?id_transaksi=<?php echo $row['id_transaksi']; ?>&aksi=lihat_update">Update</a>
                &nbsp;&nbsp;&nbsp;</td>

        </tr>
    <?php 
    }