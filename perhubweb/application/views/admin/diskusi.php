<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!-- Container -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<h4 class="mtext-105 cl2 m-b-20">Diskusi Produk</h4>
			<div class="tab tab-riwayat">
        		<ul class="nav nav-tabs m-b-40" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" href="javascript:void(0)" data-tablink="semua" >Semua Diskusi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)" data-tablink="beli" >Mengikuti</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="javascript:void(0)" data-tablink="toko" >Produk Saya</a>
					</li>
				</ul>
				<!-- Konten -->
				<div class="p-tb-10 p-l-20 p-r-40 m-b-20" style="background-color:#c0392b;color:#fff;position:relative;align-items:middle;">
					<span onclick="$(this).parent().hide();" class="pointer" style="position:absolute;right:14px;"><i class="fa fa-times"></i></span>
					Mohon berhati-hati jika diminta untuk chat dan melakukan pembayaran diluar Allbatik.id
				</div>
				<div class="tab-content">
          			<div class="tab-pane active" id="load">
						<h5 class="cl1 txt-center"><i class="fa fa-spin fa-circle-o-notch"></i> Loading data...</h5>
					</div>
			  	</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
	$(function(){
		$("#load").load("<?php echo site_url("assync/diskusi?cat=semua"); ?>");

		$(".nav-link").each(function(){
			$(this).click(function(){
				$("#load").html('<i class="fa fa-spin fa-spinner"></i> &nbsp;sedang memuat...');
				$(".nav-link.active").removeClass("active");
				$(this).addClass("active");
				var id = $(this).data("tablink");
				$("#load").load("<?php echo site_url("assync/diskusi?cat="); ?>"+id);
			});
		});
	});

	function refreshSemua(page){
		$("#load").html('<i class="fa fa-spin fa-spinner"></i> &nbsp;sedang memuat...');
		$("#load").load("<?php echo site_url("assync/diskusi?cat=semua&page="); ?>"+page);
	}
	function terimaPesanan(id){
		$.post("<?php echo site_url("assync/accPenjualan?p=terima"); ?>",{"data":id},function(e){
			var hasil = eval("("+e+")");
			if(hasil.success == true){
				refreshKonfirm(1);
			}else{
				swal("Error!","Gagal menerima pesanan, cobalah beberapa saat lagi.","error");
			}
		});
	}
	function tolakPesanan(id){
		swal({
			title: "Anda yakin?",
			text: "pesanan akan dibatalkan karena produk habis dan dana pembelian akan dikembalikan kepada pembeli.",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.post("<?php echo site_url("assync/accPenjualan?p=tolak"); ?>",{"data":id},function(e){
					var hasil = eval("("+e+")");
					if(hasil.success == true){
						refreshKonfirm(1);
						swal("Success","Berhasil membatalkan pesanan, apabila produk sudah habis silahkan edit produk.","success");
					}else{
						swal("Error!","Gagal menolak pesanan, cobalah beberapa saat lagi.","error");
					}
				});
			}
		});
	}
</script>
