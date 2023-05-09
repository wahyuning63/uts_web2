<?php

require_once "app/user.php";
$user = new user();
$rows = $user->tampil();

if(isset($_GET["cari"])){
    $rows = $user->cari($_GET["alamat"]);
}

if(isset($_GET['simpan'])) $vsimpan =$_GET['simpan'];
else $vsimpan ='';
if(isset($_GET['update'])) $vupdate =$_GET['update'];
else $vupdate ='';
if(isset($_GET['reset'])) $vreset =$_GET['reset'];
else $vreset ='';
if(isset($_GET['aksi'])) $vaksi =$_GET['aksi'];
else $vaksi ='';
if(isset($_GET['id_user'])) $vid_user =$_GET['id_user'];
else $vid_user ='';
if(isset($_GET['nama_user'])) $vnama_user =$_GET['nama_user'];
else $vnama_user ='';
if(isset($_GET['no_telpon'])) $vno_telpon =$_GET['no_telpon'];
else $vno_telpon ='';
if(isset($_GET['alamat'])) $valamat =$_GET['alamat'];
else $valamat ='';

if($vsimpan=='simpan' && ($vnama_user <>''||$vno_telpon<>''||$valamat <>'')){
    $user->simpan();
    $rows = $user->tampil();
    $vid_user ='';
    $vnama_user ='';
    $vno_telp ='';
    $valamat ='';
}

if($vaksi=="hapus")  {
    $user->hapus();
    $rows = $user->tampil();
}
if($vaksi=="cari")  {
    $rows = $user->cari();
}

 if($vaksi=="lihat_update")  {
    $urows = $user->tampil_update();
    foreach ($urows as $row) {
    $vid_user =$row['id_user'];
    $vnama_user =$row['nama_user'];
    $vno_telpon =$row['no_telpon'];
    $valamat =$row['alamat'];
    }
 }

if ($vupdate=="update"){
    $user->update($vid_user,$vnama_user,$vno_telpon,$valamat);
    $rows = $user->tampil();
    $vid_user ='';
    $vnama_user ='';
    $vno_telp ='';
    $valamat ='';
}
if ($vreset=="reset"){
    $vid_user ='';
    $vnama_user ='';
    $vno_telpon ='';
    $valamat ='';
}


?>

<form action="?" method="get">
<table>
    <tr><td>ID USER</td><td>:</td><td>
        <input type="hidden" name="id_user" value="<?php echo $vid_user; ?>" /><input type="text" name="nama_user" value="<?php echo $vnama_user; ?>" /></td></tr>
    <tr><td>NAMA</td><td>:</td><td><input type="text" name="nama_user" value="<?php echo $vnama_user; ?>"/></td></tr>
    <tr><td>ALAMAT</td><td>:</td><td><input type="text" autocomplete="off" name="alamat" value="<?php echo $valamat; ?>"/></td></tr>
    <tr><td>NO TELPON</td><td>:</td><td><input type="text" name="no_telpon" value="<?php echo $vno_telpon; ?>"/></td></tr>
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
        <td>NAMA</td>
        <td>NO TELEPON</td>
        <td>ALAMAT</td>
        <td>AKSI</td>
    </tr>

    <?php foreach ($rows as $row) { ?>
        <tr>
            <td><?php echo $row['id_user']; ?></td>
            <td><?php echo $row['nama_user']; ?></td>
            <td><?php echo $row['no_telpon']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><a href="?id_user=<?php echo $row['id_user']; ?>&aksi=hapus">Hapus</a>&nbsp;&nbsp;&nbsp;
                <a href="?id_user=<?php echo $row['id_user']; ?>&aksi=lihat_update">Update</a>
                &nbsp;&nbsp;&nbsp;</td>

        </tr>
    <?php 
    }