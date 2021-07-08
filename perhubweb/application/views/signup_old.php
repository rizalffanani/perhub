<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
<div class="seksen-shadow"></div>
<div class="seksen">
	<div class="wrapper" id="load">
		<div class="seksen-title">
			<i class="fa fa-send"></i> Mendaftar
			<div class="seksen-title-border"></div>
		</div>
		<div class="seksen-content">
			<form id="form-signup">
				<ul class="sign-left">
					<li>
						<p id="error" style="color:#cc0000;display:none;"><small>terjadi kesalahan, mohon formulir dilengkapi dulu</small></p>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-user"></span>
							<input type="text" name="nama" class="form border border-grey" placeholder="Nama Lengkap" required />
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-mobile" style="font-size: 18px;"></span>
							<input type="text" onkeypress="return isNumber(event)" name="nohp" class="form border border-grey" placeholder="Nomor Handphone" required />
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-envelope"></span>
							<input type="email" id="email" name="email" class="form border border-grey" placeholder="Alamat Email" required />
							<p id="imelerror" style="color:#cc0000;display:none;"><small>terjadi kesalahan, mohon formulir dilengkapi dulu</small></p>
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-lock" style="font-size:16px;"></span>
							<input type="password" name="pass" class="form border border-grey" placeholder="Kata Sandi" required />
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-venus-mars"></span>
							<select name="kelamin" class="form border border-grey" required >
								<option value="0">Jenis Kelamin</option>
								<option value="1">Pria</option>
								<option value="2">Wanita</option>
							</select>
						</div>
					</li>
					<li>
						<select name="tgl" class="form border border-grey" style="width:25%;" required >
							<option value="0">Tanggal</option>
							<?php
								for($i=1; $i<=31; $i++){
									$a = ($i<10) ? 0 .$i : $i;
									echo '<option value="'.$a.'">'.$i.'</option>';
								}
							?>
						</select>
						<select name="bln" class="form border border-grey" style="width:48%;" required >
							<option value="00">Bulan</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
						<select name="thn" class="form border border-grey" style="width:25%;" required >
							<option value="">Tahun</option>
							<?php
								$awal = date("Y") - 65;
								$akhir = date("Y") - 17;
								for($i=$awal; $i<=$akhir; $i++){
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
							?>
						</select>
					</li>
					<li>
						<button type="submit" class="btn btn-green" id="submit">Daftar Akun</button>
					</li>
					<li>
						sudah punya akun BELIWARGA? <a href="<?php echo site_url("home/signin"); ?>">Masuk disini</a>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validation(){
		return 0;
	}
	function isNumber(evt) {
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode > 31 && (charCode < 48 || charCode > 57)) {
			return false;
		}
		return true;
	}
	
	$(function(){
		localStorage["error"] = 0;
		
		$("#form-signup").on("submit",function(e){
			e.preventDefault();
			
			if(validation() == 0){
				$(".form").prop("readonly",true);
				$("#submit").html("<i class='fa fa-spin fa-spinner'></i> tunggu sebentar...");
				$.post("<?php echo site_url("home/signup"); ?>",$(this).serialize(),function(msg){
					$("#load").html(msg);
				});
			}else{
				$("#error").show();
			}
		});
		
		$(".form").each(function(){
			$(this).keyup(function(){
				if($(this).attr("type") == "email"){
					if($(this).val().indexOf("@") != -1 && $(this).val().indexOf(".") != -1){
						$.post("<?php echo site_url("home/signup/cekemail"); ?>",{"email":$("#email").val()},function(msg){
							var result = eval('('+msg+')');
							
							if(result.success == true){
								$("#email").addClass("border-green");
								$("#email").removeClass("border-red");
								$("#email").removeClass("border-grey");
								$("#imelerror").hide();
							}else{
								$("#email").addClass("border-red");
								$("#email").removeClass("border-grey");
								$("#email").removeClass("border-green");
								$("#imelerror").show();
								$("#imelerror small").html(result.message);
							}
						});
					}else{
						$(this).addClass("border-red");
						$(this).removeClass("border-grey");
						$(this).removeClass("border-green");
						$("#imelerror").show();
						$("#imelerror small").html("masukkan format email dengan benar");
					}
				}else{
					if($(this).val() != ""){
						$(this).addClass("border-green");
						$(this).removeClass("border-red");
						$(this).removeClass("border-grey");
					}else{
						$(this).addClass("border-red");
						$(this).removeClass("border-grey");
						$(this).removeClass("border-green");
					}
				}
			});
		});
		
	});
</script>