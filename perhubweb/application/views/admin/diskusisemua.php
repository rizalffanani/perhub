<?php

  $page = (isset($_GET["page"]) AND $_GET["page"] != "" AND intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;
  $perpage = 10;

  $this->db->where("usrid",$_SESSION["usrid"]);
  if(isset($_SESSION["idtoko"]) AND $_SESSION["idtoko"] > 0){
    $this->db->or_where("idtoko",$_SESSION["idtoko"]);
  }
  //$this->db->group_by("idproduk");
  $this->db->where("reply",0);
  $rows = $this->db->get("diskusi");
	$rows = $rows->num_rows();

  $this->db->where("usrid",$_SESSION["usrid"]);
  if(isset($_SESSION["idtoko"]) AND $_SESSION["idtoko"] > 0){
    $this->db->or_where("idtoko",$_SESSION["idtoko"]);
  }
  //$this->db->group_by("idproduk");
  $this->db->where("reply",0);
	$this->db->limit($perpage,($page-1)*$perpage);
  $db = $this->db->get("diskusi");

  if($db->num_rows() > 0){
    foreach($db->result() as $res){
?>
  <div class="row">
    <div class="col-md-12 m-b-30">
      <div class="bor10 p-lr-20 p-t-30 p-b-10 m-lr-0-xl p-lr-15-sm">
        <div class="row p-b-30">
          <div class="col-md-2 text-center">
            <div class="how-itemcart2">
              <img src="<?php echo $this->func->getFoto($res->idproduk,"utama"); ?>" alt="IMG">
            </div>
          </div>
          <div class="col-md-8">
            <p class="stext-109 p-t-10"><?php echo $this->func->ubahTgl("d/m/Y H:i",$res->tgl); ?></p>
            <p class="mtext-102 p-t-10 cl10"><?php echo $res->isipesan; ?></p>
            <?php
              $this->db->select("isipesan,COUNT(isipesan) as total");
              $this->db->where("reply",$res->id);
              //$this->db->limit(1);
              $this->db->order_by("id","DESC");
              $this->db->group_by("reply");
              $dbs = $this->db->get("diskusi");
              $total = 0;
              foreach($dbs->result() as $rs){
                $lastmsg = $this->func->potong($rs->isipesan,"40","...");
                $total += ($rs->total > 0) ? $rs->total : 0;
            ?>
            <p class="stext-102 p-t-10">Pesan terakhir:</p>
            <p class="stext-102"><i><?php echo $lastmsg; ?></i></p>
            <?php
              }
            ?>
          </div>
          <div class="col-md-2 p-r-40 cl1">
            <i class="fa fa-comments-o"></i><span class="mtext-102"> <?php echo $total; ?> Jawaban</span>
            <div class="m-t-40">
              <a href="<?php echo site_url("manage/diskusi/".$res->id."_".date("YmdHis")); ?>" class="stext-101 cl0 size-107 bg1 hov-btn1 p-tb-10 p-lr-25 trans-04 m-b-10">
                lihat pesan
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
    }
		echo $this->func->createPagination($rows,$page,$perpage,"refreshSemua");
  }else{
    echo "
      <div class='txt-center'>
        <img src='".base_url("assets/img/komponen/diskusi.png")."' style='width:240px;' />
        <p><h5 class='cl1 m-t-20'>BELUM ADA DISKUSI</h5></p>
      </div>
    ";
  }
?>
