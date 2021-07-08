<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($_SESSION["usrid"])){

?>
	<div class="subtitle">
		<b>BELI PRODUK</b>
		<div class="line"></div>
	</div>
	<div class="kolom">
		<form id="beli" method="POST" action="<?php echo site_url("assync/prosesbeli"); ?>">
			<input type="hidden" name="idproduk" value="<?php echo $id; ?>" />
			<input type="hidden" name="idtoko" value="<?php echo $idtoko; ?>" />
			<div class="kolom6">
				Produk:<br/>
				<b style="font-size:120%;"><?php echo $nama; ?></b>
				<div class="divider"></div>
				<div class="kolom-separo">
					Jumlah Barang
					<input id="jumlah" type="number" class="form-bordered" value="1" name="jumlah" style="width:80%;" required />
				</div>
				<div class="kolom-separo">
					Harga Satuan<br/>
					<b id="harga" style="font-size:130%;">Rp. <?php echo $this->func->formUang($harga); ?></b>
					<input type="hidden" name="harga" id="subtotal" value="<?php echo $harga; ?>" />
				</div>
			</div>
			<div class="kolom6">
				Keterangan<br/>
				<textarea rows=4 name="keterangan" class="form-bordered" placeholder="Contoh: Ukuran M, Warna Biru, dll"></textarea>
			</div>
			<div class="kolom-fluid">
				<button type="submit" id="tombolbeli" class="btn btn-default full" style="font-size:120%;"><i class="fa fa-shopping-basket"></i> &nbsp;Beli Produk Ini</button>
				<div class="hide divider errorbeli"></div>
				<div class="hide alert alert-red errorbeli"><i class="fa fa-exclamation-triangle"></i> &nbsp;Terjadi kesalahan pada saat melakukan checkout, silahkan ulangi beberapa saat lagi.</div>
			</div>
		</form>
	</table>

	<script type="text/javascript">
		$(function(){
			$(".btn,.form-bordered").focus(function(){
				$(".errorbeli").hide();
				$(".errorongkir").hide();
			});

			$("#beli").on("submit",function(e){
				e.preventDefault();
				var tombol = $("#tombolbeli").html();
				$("#tombolbeli").html("<i class='fa fa-refresh fa-spin'></i> &nbsp;Memproses...");
				$.post("<?php echo site_url("assync/prosesbeli"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						closeModal();
						beliPropKeranjang();
					}else{
						$("#tombolbeli").html(tombol);
						$(".errorbeli").show();
					}
				});
			});

		/*	$("#idprov").change(function(){
				$.post("<?php echo site_url("assync/getkab"); ?>",{"id":$(this).val()},function(msg){
					var data = eval("("+msg+")");
					$("#idkab").html(data.html);
				});
			});
			$("#idkab").change(function(){
				var rajaongkir = $("#idkab option:selected").data("rajaongkir");
				$("#tujuan").val(rajaongkir);
				cekOngkir();
				$.post("<?php echo site_url("assync/getkec"); ?>",{"id":$(this).val()},function(msg){
					var data = eval("("+msg+")");
					$("#idkec").html(data.html);
				});
			});

			$("#tambahbaru").click(function(){
				$("#alamatlama").removeClass("show");
				$("#alamatlama").addClass("hide");
				$("#alamatbaru").removeClass("hide");
				$("#alamatbaru").addClass("show");
				$("#alamat").val(0);
				$("#alamatalamat,#idkab,#idkec,#nama,#nohp,#idprov,#judul,#kodepos").prop("required",true);
			});
			$("#lama").click(function(){
				$("#alamatbaru").removeClass("show");
				$("#alamatbaru").addClass("hide");
				$("#alamatlama").removeClass("hide");
				$("#alamatlama").addClass("show");
				var valu = $(".drop-form-select.active").data("value");
				var valc = $(".drop-form-select.active").data("rajaongkir");
				$("#tujuan").val(valc);
				$("#alamat").val(valu);
				$("#alamatalamat,#idkab,#idkec,#nama,#nohp,#idprov,#judul,#kodepos").prop("required",false);
				cekOngkir();
			});

			$("#jumlah").change(function(){
				if($(this).val() < 1){
					$(this).val(1);
				}

				var harga = parseInt("<?php echo $harga; ?>");
				var jml = parseInt($(this).val());
				var total = harga * jml;

				$("#harga").html("Rp. "+formUang(total));
				$("#subtotal").val(total);
				totalHarga();

				var berat = parseInt("<?php echo $berat; ?>") * parseInt($(this).val());
				if(parseInt(berat) >= 3000){
					$("#service option.posbiasa").show();
				}else{
					$("#service option.posbiasa").hide();
				}
				cekOngkir();
			});

			$(".drop-form-select").each(function(){
				$(this).click(function(){
					if($(this).hasClass("active")){
						$(".drop-form-select").addClass("show");
						$(this).removeClass("active");
					}else{
						$(".drop-form-select").removeClass("active");
						$(".drop-form-select").removeClass("show");
						$(this).addClass("active");
						$("#alamat").val($(this).data("value"));
						$("#tujuan").val($(this).data("rajaongkir"));
						cekOngkir();
					};
				});
			});

			$("#service").change(function(e){
				e.preventDefault();
				cekOngkir();
			});
			$("#kurir").change(function(){
				if($(this).val() != ""){
					var data = $("#service"+$(this).val()).html();
					$("#service").html(data);
					var berat = parseInt("<?php echo $berat; ?>") * parseInt($("#jumlah").val());
					if($(this).val() == "pos"){
						if(parseInt(berat) >= 3000){
							$("#service option.posbiasa").show();
						}else{
							$("#service option.posbiasa").hide();
						}
					}
					$("#ongkir").html("-");
				}
			});

			// UBAH TUJUAN
			var valc = $(".drop-form-select.active").data("rajaongkir");
			$("#tujuan").val(valc);*/
		});

	/*	function cekOngkir(){
			if($("#service").val() != ""){
				var dari = "<?php echo $kotatoko; ?>",
				tujuan = $("#tujuan").val(),
				berat = parseInt("<?php echo $berat; ?>") * parseInt($("#jumlah").val()),
				kurir = $("#kurir").val(),
				service = $("#service").val();

				$("#ongkir").html("<i class='fa fa-spin fa-spinner'></i> tunggu sebentar...");
				$.post(
					"<?php echo site_url("assync/cekongkir"); ?>",
					{"dari":dari,"tujuan":tujuan,"berat":berat,"kurir":kurir,"service":service},
					function(msg){
						var hasil = eval("("+msg+")");
						if(hasil.success == true){
							$("#ongkir").html("Rp. "+formUang(hasil.harga));
							$("#totalharga").html("Rp. "+formUang(hasil.harga));
							$("#totalongkir").val(hasil.harga);
							totalHarga();
						}else{
							$("#ongkir").html("<small style='color:#cc0000;'><small>"+hasil.response+"</small></small>");
							$("#totalongkir").val(0);
							$(".errorongkir").show();
						}
					}
				);
			}
		}
		function totalHarga(){
			var harga = parseInt($("#subtotal").val()),
			ongkir = parseInt($("#totalongkir").val());

			var total = harga + ongkir;
			$("#totalharga").val(total);
			$("#hargatotal").html("Rp. "+formUang(total));
		}*/
	</script>

<select id="servicejne" style="display:none;">
	<option value="">Pilih Paket</option>
	<option value="REG">REG</option>
	<option value="OKE">OKE</option>
	<option value="YES">YES</option>
</select>
<select id="servicepos" style="display:none;">
	<option value="">Pilih Paket</option>
	<option value="Paket Kilat Khusus">Paket Kilat Khusus</option>
	<option value="Express Next Day Barang">Express Next Day</option>
	<option class="posbiasa" style="display:none;" value="biasa">POS Biasa</option>
</select>
<select id="servicetiki" style="display:none;">
	<option value="">Pilih Paket</option>
	<option value="REG">REG</option>
	<option value="ECO">ECO</option>
	<option value="ONS">ONS</option>
</select>

<?php }else{ ?>
	<i class="fa fa-refresh fa-spin"></i> tunggu sebentar...
	<script type="text/javascript">
		window.location.href="<?php echo site_url("home/signin"); ?>";
	</script>
<?php } ?>
