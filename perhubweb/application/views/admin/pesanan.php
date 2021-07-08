
	<!-- Container -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<h4 class="mtext-105 cl2 m-b-20">Status Pesanan</h4>
			<div class="tab tab-riwayat">
        		<ul class="nav nav-tabs m-b-40" role="tablist">
					<li class="nav-item">
						<a class="nav-link klik belumbayar" href="#belumbayar" role="tab" data-tablink="belumbayar" data-toggle="tab">Belum Bayar</a>
					</li>
					<li class="nav-item">
						<a class="nav-link dikemas" href="#dikemas" role="tab" data-tablink="dikemas" data-toggle="tab">Dikemas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link dikirim" href="#dikirim" role="tab" data-tablink="dikirim" data-toggle="tab">Dikirim</a>
					</li>
					<li class="nav-item">
						<a class="nav-link selesai" href="#selesai" role="tab" data-tablink="selesai" data-toggle="tab">Selesai</a>
					</li>
					<li class="nav-item">
						<a class="nav-link batal" href="#batal" role="tab" data-tablink="batal" data-toggle="tab">Dibatalkan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link preorder" href="#preorder" role="tab" data-tablink="preorder" data-toggle="tab">PREORDER</a>
					</li>
				</ul>
							<!-- Konten -->
			  <div class="tab-content">
				  <!-- BELUM BAYAR -->
          <div class="tab-pane fade in" role="tabpanel" id="belumbayar"></div>
					  <!-- DIKEMAS -->
					<div class="tab-pane fade in" role="tabpanel" id="dikemas"></div>
					  <!-- DIKIRIM -->
					<div class="tab-pane fade in" role="tabpanel" id="dikirim"></div>
					  <!-- SELESAI -->
					<div class="tab-pane fade in" role="tabpanel" id="selesai"></div>
					  <!-- BATAL -->
					<div class="tab-pane fade in" role="tabpanel" id="batal"></div>
					  <!-- PRE ORDER -->
					<div class="tab-pane fade in" role="tabpanel" id="preorder"></div>

			  </div>
			</div>
		</div>
	</div>
  	<script type="text/javascript">
		$(function(){
			<?php
				if(isset($_GET["konfirmasi"])){
					$datar = [
						"ipaymu"=>"",
						"ipaymu_link"=>"",
						"ipaymu_trx"=>"",
						"ipaymu_tipe"=>"",
						"ipaymu_channel"=>"",
						"ipaymu_nama"=>"",
						"ipaymu_kode"=>"",
						"midtrans_id"=>""
					];
					$this->db->where("id",$_GET["konfirmasi"]);
					$this->db->update("pembayaran",$datar);
					$this->func->notiftransfer($_GET["konfirmasi"]);
					echo "konfirmasi(".$_GET["konfirmasi"].")";
				}
			?>

			$("#belumbayar").load("<?php echo site_url("assync/pesanan?status=belumbayar"); ?>",function(){$(".nav-item .klik").trigger("click");});

			$(".nav-link").each(function(){
					var tab = $(this).data("tablink");
				$(this).click(function(){
						//if($("#"+tab).html() == ""){
						$("#"+tab).html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
						//$(".nav-link .active").removeClass("active");
					//	$(this).addClass("active");
						//var id = $("a",this).attr("id");
						$("#"+tab).load("<?php echo site_url("assync/pesanan?status="); ?>"+tab);
						//}
				});
			});

				$("#upload").on("submit",function(e){
					$("#upload button").hide();
					$("#upload").append("<h5 class='cl1'><i class='fa fa-circle-o-notch'></i> Mengunggah...</h5>");
				});
		});

		function cekMidtrans(bayar){
			$('.status-modal').addClass('show-modal2');
			$("#status").load("<?=site_url("assync/cekmidtrans")?>?bayar="+bayar);
		}
    	function bayarUlang(trx,invoice){
			swal({
				title: "Anda yakin?",
				text: "metode pembayaran sebelumnya akan dibatalkan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					<?php
						$revoke = site_url("home/invoice?revoke=true&inv=");
						$klik = site_url("home/invoice?inv=");
						$set = $this->func->getSetting("semua");
						if(strpos($set->midtrans_snap,"sandbox") == false){
					?>
					/*$.post("<?php echo site_url("assync/bayarulangpesanan"); ?>",{"bayar":trx},function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							window.location.href = "<?=$klik?>";
						}else{
							swal("Gagal!","Gagal membatalkan pembayaran sebelumnya, coba ulangi beberapa saat lagi","error");
						}
					});*/
					$.ajax({
						type: "POST",
						url:  "<?=site_url("assync/bayarulangpesanan")?>",
						data: {"bayar":trx},
						statusCode: {
							200: function(responseObject, textStatus, jqXHR) {
								var data = eval("("+msg+")");
								if(data.success == true){
									window.location.href = "<?=$klik?>";
								}else{
									swal("Gagal!","Gagal membatalkan pembayaran sebelumnya, coba ulangi beberapa saat lagi","error");
								}
							},
							404: function(responseObject, textStatus, jqXHR) {
								window.location.href = "<?=$revoke?>"+invoice;
							},
							500: function(responseObject, textStatus, jqXHR) {
								window.location.href = "<?=$revoke?>"+invoice;
							}
						}
					});
					<?php }else{ ?>
					swal("Gagal!","Admin menggunakan server sandbox dari midtrans, jadi tidak dapat mengubah status transaksi di midtrans, tapi anda dapat mengganti metode pembayaran lain","error").then((res) =>{
						window.location.href = "<?=$revoke?>"+invoice;
					});
					<?php } ?>
				}
			});
    	}
		function konfirmasi(bayar){
			$('.konfirmasi-modal').addClass('show-modal2');
			$("#bayar").val(bayar);
		}
    	function terimaPesanan(trx){
			swal({
				title: "Anda yakin?",
				text: "pesanan akan di selesaikan dan dana akan diteruskan kepada penjual.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/terimaPesanan"); ?>",{"pesanan":trx},function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							refreshDikirim(1);
							$(".selesai").trigger("click");
						}else{
							swal("Gagal!","Gagal menyelesaikan pesanan, coba ulangi beberapa saat lagi","error");
						}
					});
				}
			});
    	}
    	function ajukanbatal(trx){
			swal({
				title: "Anda yakin?",
				text: "pesanan akan dibatalkan dan apabila penjual telah menyetujui maka pembayaran akan dikembalikan ke saldo Anda.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/requestbatalkanPesanan"); ?>",{"pesanan":trx},function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							refreshBatal(1);
							$(".batal").trigger("click");
						}else{
							swal("Gagal!","Gagal mengajukan pembatalan pesanan, coba ulangi beberapa saat lagi","error");
						}
					});
				}
			});
   		}
		function batal(bayar){
			swal({
				title: "Anda yakin?",
				text: "pesanan akan dibatalkan.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/batalkanPesanan"); ?>",{"pesanan":bayar},function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							refreshBatal(1);
							$(".batal").trigger("click");
						}else{
							swal("Gagal!","Gagal membatalkan pesanan, doba ulangi beberapa saat lagi","error");
						}
					});
				}
			});
		}
		function perpanjang(bayar){
			swal({
				title: "Anda yakin?",
				text: "Batas waktu pengemasan penjual akan diperpanjang 2 hari.",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/perpanjangPesanan"); ?>",{"pesanan":bayar},function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							refreshBatal(1);
							$(".dikemas").trigger("click");
						}else{
							swal("Gagal!","Gagal membatalkan pesanan, doba ulangi beberapa saat lagi","error");
						}
					});
				}
			});
		}
		function refreshBelumbayar(page){
			$("#belumbayar").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#belumbayar").load("<?php echo site_url("assync/pesanan?status=belumbayar&page="); ?>"+page);
		}
		function refreshBatal(page){
			$("#batal").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#batal").load("<?php echo site_url("assync/pesanan?status=batal&page="); ?>"+page);
		}
		function refreshDikemas(page){
			$("#dikemas").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#dikemas").load("<?php echo site_url("assync/pesanan?status=dikemas&page="); ?>"+page);
		}
		function refreshDikirim(page){
			$("#dikirim").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#dikirim").load("<?php echo site_url("assync/pesanan?status=dikirim&page="); ?>"+page);
		}
		function refreshSelesai(page){
			$("#selesai").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#selesai").load("<?php echo site_url("assync/pesanan?status=selesai&page="); ?>"+page);
		}
		function refreshPO(page){
			$("#preorder").html("<div class='m-lr-auto txt-center p-tb-20'><h5>loading...</h5></div>");
			$("#preorder").load("<?php echo site_url("assync/pesanan?status=po&page="); ?>"+page);
		}
  	</script>


	<!-- Modal1 -->
	<div class="wrap-modal2 js-modal2 status-modal p-t-60 p-b-20">
		<div class="overlay-modal2 js-hide-modal2"></div>
		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent col-md-6 m-lr-auto">
				<button class="how-pos3 hov3 trans-04 js-hide-modal2">
					<img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
				</button>

				<div class="row">
					<div id="status" class="col-12">
					
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal2 js-modal2 konfirmasi-modal p-t-60 p-b-20">
		<div class="overlay-modal2 js-hide-modal2"></div>
		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent col-md-6 m-lr-auto">
				<button class="how-pos3 hov3 trans-04 js-hide-modal2">
					<img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-12 p-b-20">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<h4>Upload Bukti Transfer <span style="font-size: 15px">(.jpg, .png, .pdf)</span></h4>
						</div>
					</div>
					<form id="upload" class="row p-lr-0 m-lr-0 w-full" method="POST" enctype="multipart/form-data" action="<?php echo site_url("manage/konfirmasi"); ?>">
						<input name="idbayar" type="hidden" id="bayar" value="0"/>
						<div class="col-md-12 p-b-20">
							<div class="m-lr-20">
								<div class="upload-options">
									<label>
										<input type="file" name="bukti" class="w-full pointer image-upload bor8 p-t-15 p-b-15 p-l-25 p-r-30 p-lr-0-lg" accept="image/*" />
									</label>
								</div>
							</div>
						</div>
						<div class="col-md-4 m-lr-10 p-l-25 p-r-30 p-lr-0-lg">
							<button type="submit" class="flex-c-m stext-101 cl0 size-107 bg1 hov-btn1 p-lr-15 trans-04 m-b-10">
								Upload
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
