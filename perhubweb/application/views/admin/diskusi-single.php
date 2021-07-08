<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!-- Container -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
		<?php
			$pid = explode("_",$disid);
			$this->db->where("id",$pid[0]);
			$db = $this->db->get("diskusi");
			foreach($db->result() as $res){
				$produk = $this->func->getProduk($res->idproduk,"semua");
				$this->db->where("reply",$res->id);
				//$this->db->limit(1);
				$this->db->order_by("id","ASC");
				$dbs = $this->db->get("diskusi");
				$total = ($dbs->num_rows() > 0) ? $dbs->num_rows() : 0;
				$dari = ($res->idtoko == $this->func->getUser($_SESSION["usrid"],"idtoko")) ? 2 : 1;
		?>
			<h4 class="mtext-105 cl2 m-b-20">Diskusi Produk &raquo; <small><i><?php echo $produk->nama; ?></i></small></h4>
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
                <p class="stext-109 p-t-10"><?php echo $this->func->ubahTgl("d M Y H:i",$res->tgl)." WIB"; ?></p>
                <p class="mtext-102 p-t-10 cl10"><?php echo $res->isipesan; ?></p>
                <p class="stext-102 p-t-10">Produk: <span class="cl1"><?php echo $produk->nama; ?></span></p>
              </div>
              <div class="col-md-2 p-r-40 cl1">
                <i class="fa fa-comments-o"></i><span class="mtext-102"> <?php echo $total; ?> Jawaban</span>
              </div>
            </div>

						<?php
							foreach($dbs->result() as $rs){
								$user = $this->func->getUser($rs->usrid,"semua");
								$img = ($rs->dari == 2) ? "store.png" : "user.png";
								$nama = ($rs->dari == 2) ? $this->func->getToko($user->idtoko,"nama")." <span class='cl1'>[penjual]</span>" : $this->func->getProfil($user->id,"nama","usrid");
						?>
            <div class="row p-b-30">
              <div class="col-md-2"></div>
              <div class="col-md-10">
              	<div class="row p-t-30 p-b-30" style="border-top: 1px solid #f1f1f1;border-bottom: 1px solid #f1f1f1;">
                  <div class="col-md-1 col-2 p-t-10 text-center">
                    <img src="<?php echo base_url("assets/img/komponen/".$img); ?>" width="40">
                  </div>
                  <div class="col-9 p-t-10">
                    <p class="stext-102 cl10">
                      <?php echo $rs->isipesan; ?>
                    </p>
                    <p class="p-t-10 stext-109">
											<?php echo "<b>".$nama."</b> &nbsp; ".$this->func->ubahTgl("d M Y H:i",$rs->tgl)." WIB"; ?>
                    </p>
                  </div>
                </div>
							</div>
            </div>
						<?php
							}
						?>

            <div class="row p-b-30">
	            <div class="col-md-2"></div>
							<div class="col-md-10">
                <div class="row p-t-50 ">
                  <div class="col-md-10">
                    <h4 class="mtext-101 m-b-20">Tambahkan Pesan</h4>
                    <form id="tambahdiskusi">
											<input type="hidden" name="reply" value="<?php echo $res->id; ?>" />
											<input type="hidden" name="dari" value="<?php echo $dari; ?>" />
											<input type="hidden" name="idproduk" value="<?php echo $produk->id; ?>" />
											<input type="hidden" name="idtoko" value="<?php echo $produk->idtoko; ?>" />
                      <textarea class="form-control stext-118 cl2 plh3" name="isipesan" placeholder="Ketik sesuatu..."></textarea>

	                    <div class="row">
	                      <div class="col-md-2 m-t-20">
	                        <button type="submit" class="flex-c-m stext-101 cl0 size-107 bg1 hov-btn1 trans-04 m-b-10">
	                          Kirim
	                        </button>
	                    	</div>
	                    </div>
									</form>
                  </div>
                </div>

            	</div>
            </div>
          </div>
        </div>
      </div>
			<?php
				}
			?>
		</div>
	</div>

<script type="text/javascript">
	$(function(){
		$("#tambahdiskusi").on("submit",function(e){
			e.preventDefault();
			$("textarea",this).prop("readonly",true);
			$.post("<?php echo site_url("assync/tambahdiskusi"); ?>",$(this).serialize(),function(msg){
		  	var data = eval("("+msg+")");
		  	if(data.success == true){
					swal("Berhasil!", "pertanyaan Anda sudah disimpan", "success").then((value) => {
					  location.reload();
					});
		    }else{
					swal("Gagal!","gagal menyimpan diskusi","error");
		    }
		  });
		});
	});
</script>
