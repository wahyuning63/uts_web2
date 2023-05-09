<?php
 class transaksi {
 private $db;
 public function __construct()
     {
   try {
 $this->db = new PDO("mysql:host=localhost;dbname=db_buku", "root", ""); } catch (PDOException $e) { die ("Error " . $e->getMessage());
        }
    }
    public function tampil()
    {
        $sql = "SELECT * FROM tb_transaksi";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }

    public function simpan()
    {
        $sql = "insert into tb_transaksi values ('','".$_GET['kd_transaksi']."','".$_GET['id_user']."','".$_GET['id_komik']."','".$_GET['tol_harga']."')";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DISIMPAN !";
    } 

    public function hapus()
    {
        $sqls = "delete from tb_transaksi where id_transaksi='".$_GET['id_transaksi']."'";
        $stmts = $this->db->prepare($sqls);
        $stmts->execute();
        echo "DATA BERHASIL DIHAPUS !";
    }      
    public function tampil_update()
    {
        $sql = "SELECT * FROM tb_transaksi where id_transaksi='".$_GET['id_transaksi']."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }
    public function update($id_transaksi, $kd_transaksi,$id_user,$id_komik,$tol_harga)
    {
        $sql = "update tb_transaksi set kd_transaksi='".$kd_transaksi."', id_user='".$id_user."', id_komik='".$id_komik."', tol_harga='".$tol_harga."' where id_transaksi='".$id_transaksi."'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        echo "DATA BERHASIL DIUPDATE !";
    } 
    public function cari($tol_harga){
        $sql = "SELECT * FROM tb_transaksi WHERE tol_harga LIKE '%".$tol_harga."%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $data = [];
        while ($rows = $stmt->fetch()) {
            $data[] = $rows;
            }
        return $data;
    }  
    }  
