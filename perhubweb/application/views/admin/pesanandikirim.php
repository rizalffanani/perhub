
	<div class="row">
<?php
	$page = (isset($_GET["page"]) AND $_GET["page"] != "" AND intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;
	$perpage = 10;

	$this->db->where("status",2);
	$this->db->where("resi !=","");
	$this->db->where("usrid",$_SESSION["usrid"]);
	$rows = $this->db->get("transaksi");
	$rows = $rows->num_rows();

	$this->db->where("status",2);
	$this->db->where("resi !=","");
	$this->db->where("usrid",$_SESSION["usrid"]);
	$this->db->order_by("id","DESC");
	$this->db->limit($perpage,($page-1)*$perpage);
	$db = $this->db->get("transaksi");
  if($db->num_rows() > 0){
    foreach($db->result() as $rx){
?>

		<div class="col-md-12 m-lr-auto m-b-30">
			<div class="bg0 bor10 p-lr-40 p-t-30 p-b-40 m-lr-0-xl">
				<div class="row">
					<div class="col-md-6">
						<h4 class="mtext-104 cl2 p-b-30">
							Order ID <?php echo $rx->orderid; ?>
						</h4>
					</div>
					<div class="col-md-6 text-right">
						<a href="<?php echo site_url("manage/detailpesanan/?orderid=").$rx->orderid; ?>">Lihat Rincian Pesanan</a>
					</div>
				</div>
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<?php
						$this->db->where("idtransaksi",$rx->id);
						$trp = $this->db->get("transaksiproduk");
						$totalproduk = 0;
						$no = 1;
						foreach ($trp->result() as $key) {
                			$totalproduk += $key->harga * $key->jumlah;
							$produk = $this->func->getProduk($key->idproduk,"semua");
							$variasee = $this->func->getVariasi($key->variasi,"semua");
							$variasi = ($key->variasi != 0) ? $this->func->getWarna($variasee->warna,"nama")." ".$produk->subvariasi." ".$this->func->getSize($variasee->size,"nama") : "";
							$variasi = ($key->variasi != 0) ? "<br/><small class='text-primary'>".$produk->variasi.": ".$variasi."</small>" : "";
							if($no == 2){
					?>
							<div class="row p-b-30 m-lr-0 show-product">
					<?php
							}
					?>
					<div class="row p-b-30 m-lr-0 w-full">
						<div class="col-md-2">
							<div class="how-itemcart1">
								<img src="<?php echo $this->func->getFoto($key->idproduk,"utama"); ?>" alt="IMG">
							</div>
						</div>
						<div class="col-md-6">
							<p class="mtext-102"><?php echo $produk->nama; ?></p>
							<?=$variasi?>
						</div>
						<div class="col-md-4 text-right p-r-40">
							<p>Rp <?php echo $this->func->formUang($key->harga); ?> <span style="font-size:11px">x<?php echo $key->jumlah; ?></span></p>
						</div>
					</div>
					<?php
								$no++;
							}
  						if($no > 2){
					?>
            </div>
						<div class="row p-b-30 p-r-10">
							<a href="javascript:void(0)" class="view-product"><i class="fa fa-chevron-circle-down"></i> Lihat produk lainnya</a>
							<a href="javascript:void(0)" class="view-product" style="display:none;"><i class='fa fa-chevron-circle-up'></i> Sembunyikan produk</a>
						</div>
          <?php
              }
          ?>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-6">
								<a href="<?php echo site_url("manage/lacakpaket/".$rx->orderid); ?>" class="flex-c-m stext-101 cl2 size-107 bg8 hov-btn1 p-lr-15 trans-04 m-b-10">
									LACAK KIRIMAN
								</a>
							</div>
							<div class="col-md-6">
								<a href="javascript:void(0)" onclick="terimaPesanan(<?php echo $rx->id; ?>)" class="flex-c-m stext-101 cl0 size-107 bg1 hov-btn1 p-lr-15 trans-04 m-b-10">
									TERIMA PESANAN
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						Waktu Pengiriman:<br/>
						<i class="color1"><?php echo $this->func->ubahTgl("d M Y H:i",$rx->kirim); ?> WIB</i>
					</div>
					<div class="col-md-4">
						<div class="row">
						  <div class="col-md-6 txt-right">
    						<h5 class="mtext-102 text-black">Total Order</h5>
    					</div>
						<div class="col-md-6">
    						<h5 class="mtext-102 text-black text-right">Rp <?php echo $this->func->formUang($rx->ongkir + $totalproduk); ?></h5>
    					</div>
  					</div>
					</div>
				</div>
			</div>
		</div>
<?php
		}
		echo $this->func->createPagination($rows,$page,$perpage,"refreshDikirim");
?>
	</div>
<?php
	}else{
?>
		<div class="col-md-12 text-center cl1 p-tb-20">
			<img src="<?php echo base_url("assets/images/komponen/open-box.png"); ?>" style="width:240px;" />
			<h5 class="mtext-103 color2">TIDAK ADA PESANAN</h5>
		</div>
<?php
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$(".show-product").hide();
		$(".view-product").click(function(){
			$(this).parent().parent().find(".show-product").slideToggle();
			$(this).parent().parent().find(".view-product").toggle();
		});
	});
</script>
