<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
			<!--<form id="form">
				<ul class="sign-left">
					<li>
						<p id="error" style="color:#cc0000;display:none;"><small>alamat email tidak ditemukan, mohon cek kembali.</small></p>
						<p id="sukses" style="color:#00cc00;display:none;"><small>berhasil menyetel ulang password, silahkan cek email anda untuk langkah selanjutnya.</small></p>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-envelope"></span>
							<input type="text" name="email" class="form border border-grey" placeholder="Alamat Email" required />
						</div>
					</li>
					<li>
						<button type="submit" class="btn btn-green" id="submit">Setel ulang password</button>
					</li>
				</ul>
			</form>-->
			<form id="form" class="p-t-50 p-b-50 p-lr-30">
					<div class="m-b-12 how-pos4-parent">
						Masukkan alamat email Anda untuk mengatur ulang password.
						<p id="error" style="color:#cc0000;display:none;"><small>alamat email tidak ditemukan, mohon cek kembali.</small></p>
						<p id="sukses" style="color:#00cc00;display:none;"><small>berhasil menyetel ulang password, silahkan cek email anda untuk langkah selanjutnya.</small></p>
					</div>
					<div class="bor8 m-b-12 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-20 p-r-30" type="email" name="email" placeholder="Email">
					</div>
					<div class="row m-t-10">
							<div class="col-md-12">
									<div id="prosesmail" style="display:none;"><h5 class="cl1"><i class="fa fa-circle-o-notch fa-spin"></i> Memproses...</h5></div>
									<button id="submitmail" type="submit" class="flex-c-m w-full stext-101 cl0 size-101 bg1 hov-btn1 p-lr-15 trans-04">
											KIRIM EMAIL
									</button>
							</div>
					</div>
			</form>

<script type="text/javascript">
	$(function(){
		$("#form").on("submit",function(e){
			e.preventDefault();

			$(".form").prop("readonly",true);
			$("#submitmail").hide();
			$("#prosesmail").show();
			$.post("<?php echo site_url("home/signin/pwreset"); ?>",$(this).serialize(),function(msg){
				var data = eval('('+msg+')');
				$("#submitmail").show();
				$("#prosesmail").hide();
				if(data.success == true){
					$(".form").val("");
					$(".form").prop("readonly",false);
					swal("Berhasil!","Berhasil mengirimkan password baru, silahkan cek inbox email Anda.","success").then((value) =>{
						window.location.href = "<?php echo site_url("home/signin"); ?>";
					});
				}else{
					swal("Gagal!","Alamat email tidak ditemukan, pastikan alamat email sudah benar.","error");
				}
			});
		});
	});
</script>
