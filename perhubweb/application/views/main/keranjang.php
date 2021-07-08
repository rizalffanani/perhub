
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg m-b-30">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shopping Cart
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
		<div class="container">
      <?php
		$keranjang = (isset($_SESSION["usrid"]) AND $_SESSION["usrid"] > 0) ? $this->func->getKeranjang() : 0;
		$hapusProduk = "";
        if($keranjang > 0){
      ?>
			<div class="row">
				<div class="col-lg-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Produk</th>
									<th class="column-2"></th>
									<th class="column-3">Harga</th>
									<th class="column-4">Jumlah</th>
									<th class="column-5">Total</th>
									<th class="column-6">#</th>
								</tr>
                <?php
                  $this->db->where("usrid",$_SESSION['usrid']);
                  $this->db->where("idtransaksi",0);
                  $ca = $this->db->get("transaksiproduk");
                  $totalbayar = 0;
                  foreach ($ca->result() as $car) {
					$produk = $this->func->getProduk($car->idproduk,"semua");
					if($produk == null){ $hapusProduk .= "hapusProduk(".$car->id.")"; }
                    $totalbayar += $car->harga * $car->jumlah;
					$variasi = $this->func->getVariasi($car->variasi,"semua");
                ?>
					<tr class="table_row" id="produk_<?php echo $car->id; ?>">
						<td class="column-1">
							<div class="how-itemcart1">
								<img src="<?php echo $this->func->getFoto($produk->id,"utama"); ?>" alt="IMG">
							</div>
						</td>
						<td class="column-2">
							<p style="font-size: 18px;font-weight: bold"><?php echo $produk->nama; ?></p>
							<?php
							  if($car->variasi > 0){
								echo "<span style='font-size:80%;color:#aaa;'><b>".$produk->variasi.": </b> ".$this->func->getWarna($variasi->warna,'nama')." ".$produk->subvariasi." ".$this->func->getSize($variasi->size,'nama')."</span>";
							  }
							  if($car->keterangan != ""){
								echo "<br/><span style='font-size:80%;color:#c0392b;'><b>Note: </b> <i>".$car->keterangan."</i></span>";
							  }
							?>
						</td>
						<td class="column-3">Rp <?php echo $this->func->formUang($car->harga); ?></td>
						<td class="column-4">
							<div class="wrap-num-product flex-w m-l-auto m-r-0">
								<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 fa fa-minus"></i>
								</div>

								<input class="mtext-104 cl3 text-center num-product produk-jumlah" type="number" min="<?php echo $produk->minorder; ?>" id="jumlah_<?php echo $car->id; ?>" name="jumlah[]" value="<?php echo $car->jumlah; ?>" data-proid="<?php echo $car->id; ?>" />

								<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
									<i class="fs-16 fa fa-plus"></i>
								</div>
							</div>
						</td>
						<td class="column-5">Rp <span id="totalhargauang_<?php echo $car->id; ?>"><?php echo $this->func->formUang($car->harga*$car->jumlah); ?></span></td>
						<td class="column-5">
							<a href="javascript:hapus(<?=$car->id?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
                <input type="hidden" id="harga_<?php echo $car->id; ?>" value="<?php echo $car->harga; ?>" />
                <input type="hidden" class="totalhargaproduk" id="totalharga_<?php echo $car->id; ?>" value="<?php echo $car->harga*$car->jumlah; ?>" />
                <input type="hidden" name="id[]" value="<?php echo $car->id; ?>" />
                <?php
                  }
                ?>
							</table>
						</div>

						<div class="bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="row">
								<div class="col-lg-9"></div>
								<div class="col-lg-3">
									<h5 class="m-b-20">Total : Rp <span id="totalbayar" style="padding-left:40px"><?php echo $this->func->formUang($totalbayar); ?></span></h5>

								</div>
							</div>


							<div class="row">
								<div class="col-md-6"></div>
								<div class="col-md-3 m-b-10">
									<a href="<?php echo site_url("shop"); ?>" class="flex-c-m stext-101 cl2 size-101 bg-2 hovbtn1 p-lr-15 trans-04">
										Kembali Berbelanja
									</a>
								</div>
								<div class="col-md-3 m-b-10">
									<a href="<?php echo site_url("home/pembayaran"); ?>" class="flex-c-m stext-101 cl0 size-101 bg-1 hovbtn2 p-lr-15 trans-04">
										Selesaikan Pesanan
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
      <?php
        }else{
      ?>
			<div class="row">
				<div class="col-lg-12 m-lr-auto p-tb-150 m-b-40 text-light bg-2">
					<div class="m-l-25 m-r--38 m-lr-0-xl text-center">
						<h3>Keranjang belanja masih kosong.</h3>
					</div>
				</div>
			</div>
      <?php
        }
      ?>
		</div>
  <script>
  	<?=$hapusProduk?>

    $(".produk-jumlah").on('change',function(){
      var jumlah = $(this).val();
      var prodid = $(this).attr("data-proid");
      var harga = Number($("#harga_"+prodid).val());
	  var hargatotal = Number(jumlah) * harga;

      if(jumlah > 0){

		if(jumlah < Number($(this).attr("min"))){
			$(this).val($(this).attr("min")).trigger("change");
			return;
	    }

		$.post("<?php echo site_url("assync/updatekeranjang"); ?>",{"update":prodid,"jumlah":jumlah},function(msg){
			var data = eval("("+msg+")");
			if(data.success == false){
				swal("Gagal",data.msg,"error")
				.then((willDelete) => {
					location.reload();
				});
			}
		});

        $("#totalhargauang_"+prodid).html(formUang(hargatotal));
        $("#totalharga_"+prodid).val(hargatotal);
        var sum = 0;
        $(".totalhargaproduk").each(function(){
          sum += parseFloat($(this).val());
        });
        $("#totalbayar").html(formUang(sum));

	  }else{
		swal({
		  title: "Anda yakin?",
		  text: "menghapus produk dari keranjang belanja",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
          //$("#produk_"+prodid).hide();
	        $.post("<?php echo site_url("assync/hapuskeranjang"); ?>",{"hapus":prodid},function(msg){
	          var data = eval("("+msg+")");
	          if(data.success == true){
	            location.reload();
	          }else{
	            confirm("Gagal menghapus pesanan, silahkan ulangi beberapa saat lagi");
	          }
	        });
		  }else{
			$(this).val($(this).attr("min"));
		  }
        });
      }
    });
	
	function hapus(id){
		$("#jumlah_"+id).val(0).trigger("change");
	}
	
	function hapusProduk(id){
		$.post("<?php echo site_url("assync/hapuskeranjang"); ?>",{"hapus":id},function(msg){
	        var data = eval("("+msg+")");
	        if(data.success == true){
	            location.reload();
	        }else{
	            confirm("Gagal menghapus pesanan, silahkan ulangi beberapa saat lagi");
	        }
	    });
	}
  </script>
