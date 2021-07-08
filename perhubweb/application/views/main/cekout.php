<?php
	$set = $this->func->getSetting("semua");
?>
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Invoice
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<style rel="stylesheet">
		@media only screen and (min-width:721px){
			.mobilefix{
				margin-left: -36px;
			}
		}
	</style>
	<form class="p-t-0 p-b-85">
		<div class="container p-t-10 p-b-50" style="background: #f8f9fa1c;">
			<div class="row">
				<div class="col-md-7 m-l-auto m-r-auto">
					<div class="p-lr-40 p-t-30 p-b-40 m-l-0-xl m-r-0-xl p-r-15-sm p-l-15-sm">
						<div class="row">
							<div class="col-2 mobilefix">
								<img src="<?php echo base_url("assets/images/komponen/checked.png"); ?>" width="50">
							</div>
							<div class="col-10 mobilefix">
								<p style="font-size: 16px;color:#383838">Order ID <?php echo $data->invoice; ?></p>
								<h4 class="mtext-105">Terima Kasih <?php echo $this->func->getProfil($usrid->id,"nama","usrid"); ?></h4>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 m-l-auto m-r-auto m-b-30">
					<div class="bg0 bor10 p-l-40 p-r-40 p-t-30 p-b-40 m-r-0-xl m-l-0-xl p-r-15-sm p-l-15-sm">
						<h4 class="mtext-109 cl2 p-b-20">
							Pembayaran
						</h4>

						<?php
							if($data->transfer > 0){
								$bayartotal = $data->transfer + $data->kodebayar;
						?>
							<div class="p-b-13">
								<div class="row p-t-20">
									<div class="col-md-12 m-b-20">
										<!--<h5 class="text-black">Metode Pembayaran: <span class="cl1" style="font-size: 16px;">Virtual Account, E-Wallet, Mini Market, Dll</span> </h5>-->
										<h5 class="text-black">Mohon lakukan pembayaran sejumlah <span style="color: #c0392b; font-size: 20px;"><b>Rp <?php echo $this->func->formUang($bayartotal); ?></b></span></h5>
									</div>
									<div class="col-md-12 m-b-20">
										<h5 class="text-black">Pilih Metode Pembayaran:</h5>
									</div>
									<div class="col-md-12 metode-bayar row m-b-20">
										<?php if($set->payment_transfer == 1){ ?>
										<div class="col-md-6 m-b-10">
											<div class="metode-item manual" onclick="bayarManual()">
												<img class="cek" src="<?=base_url("assets/images/check.png")?>" />
												<img class="icon" src="<?=base_url("assets/images/transfer.png")?>" /><br/>
												Transfer Manual<br/>&nbsp;
											</div>
										</div>
										<?php 
											}
											if($set->payment_ipaymu == 1){
										?>
										<div class="col-md-6 m-b-10">
											<div class="metode-item otomatis" onclick="bayarOtomatis()">
												<img class="cek" src="<?=base_url("assets/images/check.png")?>" />
												<img class="icon" src="<?=base_url("assets/images/ipaymu-white.png")?>" /><br/>
												Virtual Account, E-Wallet, Minimarket, dll
											</div>
										</div>
										<?php 
											}
											if($set->payment_midtrans == 1){
										?>
										<div class="col-md-6 m-b-10">
											<div class="metode-item midtrans" onclick="bayarMidtrans()">
												<img class="cek" src="<?=base_url("assets/images/check.png")?>" />
												<img class="icon" src="<?=base_url("assets/images/midtrans.png")?>" /><br/>
												Virtual Account, E-Wallet, Minimarket, dll
											</div>
										</div>
										<?php } ?>
									</div>
								</div>
								<div class="row p-t-5 m-t-30 bayarmanual" style="display:none;">
									<div class="col-md-12 m-b-20">
										<h5 class="text-black">Silahkan transfer pembayaran ke rekening berikut:</h5>
									</div>
									<div class="col-md-12">
										<p></p>
										<?php
											foreach($bank->result() as $bn){
													echo '
														<h5 class="cl2 m-t-10 m-b-10 p-t-10 p-l-10 p-b-10" style="border-left: 8px solid #C0A230;">
															<b class="text-danger">Bank '.$bn->nama.': </b><b class="text-success">'.$bn->norek.'</b><br/>
															<span style="font-size: 90%">a/n '.$bn->atasnama.'<br/>
															KCP '.$bn->kcp.'</span>
														</h5>
													';
											}
										?>
										<p class="m-b-5 m-t-20">
										<b>PENTING: </b>
										</p>
										<ul style="margin-left: 15px;">
											<li style="list-style-type: disc;">Mohon lakukan pembayaran dalam <b>1x24 jam</b></li>
											<li style="list-style-type: disc;">Sistem akan otomatis mendeteksi apabila pembayaran sudah masuk</li>
											<li style="list-style-type: disc;">Apabila sudah transfer dan status pembayaran belum berubah, mohon konfirmasi pembayaran manual di bawah</li>
											<li style="list-style-type: disc;">Pesanan akan dibatalkan secara otomatis jika Anda tidak melakukan pembayaran.</li>
										</ul>
									</div>
								</div>
							</div>
							<hr class="m-t-30"/>
							<a href="javascript:void(0)" onclick="payMidtrans()" class="btn btn-success btn-block btn-lg text-center bayarmidtrans" style="display:none;"><i class="fa fa-chevron-circle-right"></i> &nbsp;<b>BAYAR SEKARANG</b></a>
							<a href="<?php echo site_url("manage/pesanan"); ?>" class="btn btn-danger btn-block btn-lg text-center bayarmidtrans" style="display:none;"><i class="fa fa-times"></i> &nbsp;<b>BAYAR NANTI SAJA</b></a>
							<a href="<?php echo site_url("assync/bayaripaymu/".$data->id); ?>" style="display:none;" class="btn btn-success btn-block btn-lg text-center bayarotomatis"><i class="fa fa-chevron-circle-right"></i> &nbsp;<b>BAYAR SEKARANG</b></a>
							<a href="<?php echo site_url("manage/pesanan"); ?>" style="display:none;" class="btn btn-danger btn-block btn-lg text-center bayarotomatis"><i class="fa fa-times"></i> &nbsp;<b>BAYAR NANTI SAJA</b></a>
							<a href="<?php echo site_url("manage/pesanan?konfirmasi=".$data->id); ?>" style="display:none;" class="btn btn-warning btn-block btn-lg text-center bayarmanual"><b>KONFIRMASI PEMBAYARAN</b> &nbsp;<i class="fa fa-chevron-circle-right"></i></a>
						<?php
							}else{
						?>
							<div class="p-b-13">
								<div class="row p-t-20">
									<div class="col-md-12">
										<h5 class="text-black">Metode Pembayaran: <span class="cl1" style="font-size: 16px;">Saldo <?=$this->func->getSetting("nama")?></span> </h5>
									</div>
								</div>
								<div class="row p-t-5">
									<div class="col-md-12">
										<p>Terima kasih, saldo <b class='cl1'><?=$this->func->getSetting("nama")?></b> sudah terpotong sebesar
											<span style="color: #c0392b; font-size: 20px;"><b>Rp <?php echo $this->func->formUang($data->saldo); ?></b></span>
											untuk pembayaran pesanan Anda.<br/>
											<!--Kami sudah menginformasikan kepada merchant untuk memproses pesanan Anda.-->
										</p>
									</div>
								</div>
							</div>
							<hr class="m-t-30"/>
							<a href="<?php echo site_url("manage/pesanan"); ?>" class="cl1 text-center w-full dis-block"><b>STATUS PESANAN</b> <i class="fa fa-chevron-circle-right"></i></a>
						<?php } ?>

					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 m-l-auto m-r-auto m-b-30">
					<div class="bg0 bor10 p-r-40 p-l-40 p-t-30 p-b-40 m-l-0-xl p-l-15-sm m-r-0-xl p-r-15-sm">
						<h4 class="mtext-109 cl2 p-b-20">
							Informasi Pengiriman
						</h4>

						<div class="p-b-13">
							<div class="row p-t-20">
								<div class="col-md-6">
									<h5 class="text-black p-b-10">Nama Penerima</h5>
									<p class="color1"><?php echo strtoupper(strtolower($alamat->nama)); ?></p>
								</div>
								<div class="col-md-6">
									<h5 class="text-black p-b-10">No Telepon</h5>
									<p class="color1"><?php echo $alamat->nohp; ?></p>
								</div>
							</div>
							<div class="row p-t-20">
								<div class="col-md-12">
									<h5 class="text-black p-b-10">Alamat Pengiriman</h5>
									<p class="color1">
										<?php
											$kec = $this->func->getKec($alamat->idkec,"semua");
											$kab = $this->func->getKab($kec->idkab,"nama");
											echo strtoupper(strtolower($alamat->alamat."<br/>".$kec->nama.", ".$kab."<br/>Kodepos ".$alamat->kodepos));
										?>
									</p>
								</div>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 m-r-auto m-l-auto m-b-30">
					<div class="bg0 bor10 p-l-40 p-r-40 p-t-30 p-b-40 m-l-0-xl m-r-0-xl">
						<h4 class="mtext-109 cl2 p-b-30">
							Produk Pesanan
						</h4>
						<div class="m-l-25 m-r-38 m-r-0-xl m-l-0-xl">
							<?php
								for($i=0; $i<count($transaksi); $i++){
									$ongkir = (isset($ongkir)) ? $transaksi[$i]->ongkir + $ongkir : $transaksi[$i]->ongkir;
									$this->db->where("idtransaksi",$transaksi[$i]->id);
									$db = $this->db->get("transaksiproduk");
									foreach($db->result() as $res){
										$total = (isset($total)) ? ($res->harga * $res->jumlah) + $total : $res->harga * $res->jumlah;
										$produk = $this->func->getProduk($res->idproduk,"semua");
										$variasee = $this->func->getVariasi($res->variasi,"semua");
										$variasi = ($res->variasi != 0) ? $this->func->getWarna($variasee->warna,"nama")." size ".$this->func->getSize($variasee->size,"nama") : "";
										$variasi = ($res->variasi != 0) ? "<br/><small class='text-danger'>variasi: ".$variasi."</small>" : "";
							?>
							<div class="row p-b-30 p-r-10">
								<div class="col-md-2">
									<div class="how-itemcart1">
										<img src="<?php echo $this->func->getFoto($res->idproduk,"utama"); ?>" alt="IMG">
									</div>
								</div>
								<div class="col-md-6">
									<p class="mtext-102"><?php echo $produk->nama.$variasi; ?></p>
								</div>
								<div class="col-md-4 text-right p-r-40">
									<p>Rp <?php echo $this->func->formUang($res->harga); ?> <span style="font-size:11px">x<?php echo $res->jumlah; ?></span></p>
								</div>
							</div>
							<?php
									}
								}
							?>

						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<p>Subtotal</p>
							</div>
							<div class="col-md-6">
								<p style="text-align: right">Rp <?php echo $this->func->formUang($total); ?></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<p>Ongkos Kirim</p>
							</div>
							<div class="col-md-6">
								<p style="text-align: right">Rp <?php echo $this->func->formUang($ongkir); $total += $ongkir; ?></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<h5 class="mtext-102 text-black">Total</h5>
							</div>
							<div class="col-md-6">
								<h5 class="mtext-102 text-black text-right">Rp <?php echo $this->func->formUang($total); ?></h5>
							</div>
						</div>

					</div>
				</div>
			</div>


		</div>
	</form>
	<div id="tokenGenerated" style="display:none;"></div>
<?php $set = $this->func->getSetting("semua"); ?>
<script type="text/javascript" src="<?=$set->midtrans_snap?>" data-client-key="<?=$set->midtrans_client?>"></script>
<script type="text/javascript">
	$(function(){
		/*$.post("<?=site_url("home/midtranstoken")?>",{"invoice":<?=$data->invoice?>},function(data,status){
			if(status == 'success'){
				$("#tokenGenerated").html(data);
			}else{
				swal("Sudah diproses","Pembayaran sudah diproses","success").then(res=>{
					window.location.href = "<?=site_url("manage/pesanan")?>";
				});
			}
		});*/

	});

	function bayarManual(){
		$(".metode-item").removeClass("active");
		$(".metode-item.manual").addClass("active");
		$(".bayarmanual").show();
		$(".bayarotomatis").hide();
		$(".bayarmidtrans").hide();
	}
	function bayarOtomatis(){
		$(".metode-item").removeClass("active");
		$(".metode-item.otomatis").addClass("active");
		$(".bayarmanual").hide();
		$(".bayarmidtrans").hide();
		$(".bayarotomatis").show();
	}
	function bayarMidtrans(){
		$(".metode-item").removeClass("active");
		$(".metode-item.midtrans").addClass("active");
		$(".bayarmanual").hide();
		$(".bayarotomatis").hide();
		$(".bayarmidtrans").show();
	}
	function payMidtrans(){
		$.ajax({
			type: "POST",
			url:  "<?=site_url("home/midtranstoken")?>",
			data: {"invoice":"<?=$data->invoice?>"},
			statusCode: {
				200: function(responseObject, textStatus, jqXHR) {
					$("#tokenGenerated").html(responseObject);
					payMidtransNow();
				},
				404: function(responseObject, textStatus, jqXHR) {
					swal("Sudah diproses","Pembayaran gagal diproses, kami akan mencobanya kembali, apabila pesan ini terjadi berulang silahkan hubungi admin toko.","success").then(res=>{
						window.location.href = "<?=site_url("home/invoice?revoke=true&inv=".$_GET["inv"])?>"; //"<?=site_url("manage/pesanan")?>";
					});
				},
				500: function(responseObject, textStatus, jqXHR) {
					swal("Sudah diproses","Pembayaran gagal diproses, API Key tidak valid, silahkan hubungi admin toko untuk memperbaiki kendala ini.","success").then(res=>{
						window.location.href = "<?=site_url("home/invoice?revoke=true&inv=".$_GET["inv"])?>"; //"<?=site_url("manage/pesanan")?>";
					});
				}
			}
		});
	}
	function payMidtransNow(){
		snap.pay($("#tokenGenerated").html(), {
			onSuccess: function(result){
				//confirm(result.transaction_id);
				var url = "<?=site_url("home/midtranspay")?>?order_id=<?=$data->invoice?>&status=success&transaction_id="+result.transaction_id;
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", url);
				//form.setAttribute("target", "_blank");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("name", "response");
				hiddenField.setAttribute("value", JSON.stringify(result));
				form.appendChild(hiddenField);

				document.body.appendChild(form);
				form.submit();
				console.log(result);
			},
			onPending: function(result){
				//confirm("Pending: "+result.transaction_id);
				/* You may add your own implementation here */
				//alert("wating your payment!"); 
				var url = "<?=site_url("home/midtranspay")?>?order_id=<?=$data->invoice?>&status=pending&transaction_id="+result.transaction_id;
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", url);
				//form.setAttribute("target", "_blank");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("name", "response");
				hiddenField.setAttribute("value", JSON.stringify(result));
				form.appendChild(hiddenField);

				document.body.appendChild(form);
				form.submit();
				console.log(result);
			},
			onError: function(result){
			},
			onClose: function(){
			}
		}); 
	}
</script>
