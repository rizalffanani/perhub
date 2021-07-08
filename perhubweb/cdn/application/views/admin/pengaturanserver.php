<?php
	$set = $this->func->globalset("semua");
	$read = ($this->func->demo() == true) ? "readonly" : "";
?>
<form id="pengaturan">
	<div class="row">
		<div class="col-md-6 m-b-20">
			<div class="form-group titel" style="font-weight: bold;">
                PENGATURAN SERVER EMAIL
			</div>
			<div class="form-group">
				<label>Metode Pengiriman</label>
				<select class="form-control col-6" name="email_jenis" <?=$read?>>
                    <option value="1" <?php if($set->email_jenis == 1){ echo "selected";} ?> >sendMail()</option>
                    <option value="2" <?php if($set->email_jenis == 2){ echo "selected";} ?> >SMTP</option>
				</select>
			</div>
			<div class="form-group">
				<label>Email Pengirim Notifikasi</label>
				<input type="text" name="email_notif" class="form-control" value="<?=$set->email_notif?>" <?=$read?> />
			</div>
			<div class="form-group">
				<label>Password Email</label>
				<?php if($this->func->demo() == true){ ?>
				<input type="password" name="email_password" class="form-control col-6" value="abcdefghijk1234567890" <?=$read?> />
				<?php }else{ ?>
				<input type="password" name="email_password" class="form-control col-6" value="<?=$set->email_password?>" />
				<?php } ?>
			</div>
			<div class="form-group">
				<label>Mail Server Domain</label>
				<input type="text" name="email_server" class="form-control col-10 col-md-8" value="<?=$set->email_server?>" <?=$read?> />
			</div>
			<div class="form-group">
				<label>Mail Server Port</label>
				<input type="text" name="email_port" class="form-control col-6 col-md-3" value="<?=$set->email_port?>" <?=$read?> />
			</div>
		</div>
		<div class="col-md-6 m-b-20">
			<div class="form-group titel" style="font-weight: bold;">
                PENGATURAN API
			</div>
			<div class="form-group">
				<label>Facebook Pixel ID</label>
				<?php if($this->func->demo() == true){ ?>
				<input type="text" name="fb_pixel" class="form-control" value="12345678901234567890" <?=$read?> />
				<?php }else{ ?>
				<input type="text" name="fb_pixel" class="form-control" value="<?=$set->fb_pixel?>" />
				<?php } ?>
			</div>
			<div class="form-group">
				<label>API Key <b>WooWA</b> (Whatsapp)</label>
				<?php if($this->func->demo() == true){ ?>
				<input type="text" name="woowa" class="form-control" value="abcdefghijklmnopqrstuvwxyz1234567890" <?=$read?> />
				<?php }else{ ?>
				<input type="text" name="woowa" class="form-control" value="<?=$set->woowa?>" />
				<?php } ?>
				<small><i class="text-danger">kosongkan apabila ingin menonaktifkan notifikasi Whatsapp</i></small><br/>
			</div>
			<div class="form-group">
				<label>API Key <b>Raja Ongkir PRO</b></label>
				<?php if($this->func->demo() == true){ ?>
				<input type="text" name="rajaongkir" class="form-control" value="abcdefghijklmnopqrstuvwxyz1234567890" <?=$read?> />
				<?php }else{ ?>
				<input type="text" name="rajaongkir" class="form-control" value="<?=$set->rajaongkir?>" />
				<?php } ?>
			</div>
		</div>
		<div class="col-md-12 m-b-20">
			<div class="form-group">
				<button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Simpan</button>
				<button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Reset</button>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	$(function(){
		$("#pengaturan").on("submit",function(e){
			e.preventDefault();
            <?php
				if($this->func->demo() == true){
					echo 'swal.fire("Mode Demo Terbatas","maaf, fitur tidak tersedia untuk mode demo","error");';
				}else{
					echo '
					$.post("'.site_url("api/savesetting").'",$(this).serialize(),function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							swal.fire("Berhasil","berhasil menyimpan pengaturan umum","success").then((val)=>{
								loadSettingServer();
							});
						}else{
							swal.fire("Gagal","gagal menyimpan pengaturan","error");
						}
					});';
				}
            ?>
		});
	});
</script>