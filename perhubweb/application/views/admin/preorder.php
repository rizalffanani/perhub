
	<div class="row">
<?php
	$page = (isset($_GET["page"]) AND $_GET["page"] != "" AND intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;
	$perpage = 10;

	$this->db->where("usrid",$_SESSION["usrid"]);
	$rows = $this->db->get("preorder");
	$rows = $rows->num_rows();

	$this->db->where("usrid",$_SESSION["usrid"]);
	$this->db->order_by("status","ASC");
	$this->db->limit($perpage,($page-1)*$perpage);
	$db = $this->db->get("preorder");
  if($db->num_rows() > 0){
    foreach($db->result() as $rx){
?>

		<div class="col-md-12 m-lr-auto m-b-30">
			<div class="bg0 bor10 p-lr-40 p-t-30 p-b-40 m-lr-0-xl">
				<div class="row">
					<div class="col-md-6">
						<h4 class="mtext-104 cl2 p-b-30">
							Order ID <?php echo $rx->invoice; ?>
						</h4>
					</div>
				</div>
				<div class="m-l-25 m-r--38 m-lr-0-xl">
					<div class="row p-b-30 m-lr-0 w-full">
						<div class="col-md-2">
							<div class="how-itemcart1">
								<?php 
									$produk = $this->func->getProduk($rx->idproduk,"semua");
									if(isset($produk->tglpo)){ $tglpo = $produk->tglpo; }else{ $tglpo =  "0000-00-00 00:00:00"; }
								?>
								<img src="<?php echo $this->func->getFoto($rx->idproduk,"utama"); ?>" alt="IMG">
							</div>
						</div>
						<div class="col-md-6">
							<p class="mtext-102"><?php if(isset($produk->nama)){ echo $produk->nama; }else{ echo "Produk telah dihapus"; } ?></p>
						</div>
						<div class="col-md-4 text-right p-r-40">
							<p>Rp <?php echo $this->func->formUang($rx->harga); ?> <span style="font-size:11px">x<?php echo $rx->jumlah; ?></span></p>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-8 row">
						<?php if($rx->status == 0){ ?>
							<div class="col-md-6 m-b-10"><span class="text-danger">Belum Bayar</span></div>
							<div class="col-md-6">
								<a class="btn btn-primary" href="<?=site_url("home/invoicepreorder/?inv=".$this->func->arrEnc(array("idbayar"=>$rx->id),"encode"))?>">Cara Pembayaran</a>
							</div>
						<?php }elseif($rx->status == 1){?>
							<?php if($this->func->ubahTgl("Ymd",$tglpo) > date("Ymd")){?>
								<div class="col-12 m-b-10"><b class="text-primary">Sedang Dalam Proses Produksi</b></div>
							<?php }else{
									$this->db->where("idpo",$rx->id);
									$this->db->where("idtransaksi >",0);
									$dbx = $this->db->get("transaksiproduk");
									if($dbx->num_rows() > 0){
							?>
								<b class="text-success">Pesanan sudah diproses</b>
							<?php }else{ ?>
								<div class="col-md-6 m-b-10"><b class="text-success">Stok Ready Silahkan Melakukan Checkout/Pelunasan</b></div>
								<div class="col-md-6">
									<a class="btn btn-primary" href="<?=site_url("home/bayarpreorder/?predi=".$this->func->arrEnc(array("idbayar"=>$rx->id),"encode"))?>">Checkout Sekarang</a>
								</div>
							<?php } ?>
							<?php } ?>
						<?php } ?>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6 text-right">
								<h5 class="mtext-102 text-black">Total DP</h5>
							</div>
							<div class="col-md-6">
								<h5 class="mtext-102 text-black text-right">Rp <?php echo $this->func->formUang($rx->total); ?></h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 text-right">
								<h5 class="mtext-102 text-danger">Total Pelunasan</h5>
							</div>
							<div class="col-md-6">
								<h5 class="mtext-102 text-danger text-right">Rp <?php echo $this->func->formUang(($rx->jumlah*$rx->harga) - $rx->total); ?></h5>
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
