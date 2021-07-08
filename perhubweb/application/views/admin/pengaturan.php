<!-- Container -->
	<div class="bg0 m-t-23">
		<div class="container m-b-75">
			<h4 class="mtext-105 cl2 m-b-20">Akun Saya</h4>
			<div class="tab">
				<ul class="nav nav-tabs m-b-40" role="tablist">
					<li class="nav-item">
						<a class="nav-link klik" href="#saldo" role="tab" data-toggle="tab" style="padding-left:40px;padding-right:40px;">Saldo <?php echo $this->func->globalset("nama"); ?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link klikrek" href="#rekening" role="tab" data-toggle="tab" style="padding-left:40px;padding-right:40px;">Rekening</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#alamat" role="tab" data-toggle="tab" style="padding-left:40px;padding-right:40px;">Alamat</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#informasi" role="tab" data-toggle="tab" style="padding-left:40px;padding-right:40px;">Pengaturan Akun</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=site_url("home/signout")?>" style="padding-left:40px;padding-right:40px;">Logout</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
          			<!-- SALDO -->
					<div role="tabpanel" class="tab-pane fade in m-b-60" id="saldo">
						<div class="container p-b-10 p-lr-50">
							<div class="row p-l-25 p-r-15 p-t-10 p-lr-0-lg p-b-10 bg-saldo m-b-40">
								<div class="col-md-8 m-lr-auto">
									<div class="p-lr-40 p-t-20 p-b-20 m-lr-0-xl p-lr-15-sm">
										<h4 class="mtext-108 cl10">Saldo Saat Ini</h4>
										<h2 class="ltext-110 m-t-20" style="color: rgb(26, 150, 68);"><b>Rp <?php echo $this->func->formUang($this->func->getSaldo($_SESSION["usrid"],"saldo","usrid")); ?>,-</b></h2>
									</div>
								</div>
								<div class="col-md-4 m-lr-auto">
									<div class="p-l-40 p-t-20 p-t-20 p-b-20 m-lr-0-xl p-lr-15-sm">
										<a href="javascript:topupSaldo()" class="flex-c-m mtext-101 cl0 p-tb-14 bg-1 hov-btn1 p-lr-15 trans-04 m-b-10">
											<i class="fa fa-upload"></i>&nbsp; Top Up
										</a>
										<a href="javascript:tarikSaldo()" class="flex-c-m mtext-101 cl0 p-tb-14 bg-2 hov-btn1 p-lr-15 trans-04 m-b-10">
											<img src="<?php echo base_url("assets/images/icons/wallet.png"); ?>" class="p-r-10"> Tarik Saldo
										</a>
									</div>
								</div>
							</div>

							<!-- Riwayat  Topup -->
							<div class="row bor10 p-l-25 p-r-15 m-t-20 p-lr-0-lg">
								<div class="col-md-12 m-lr-auto m-b-30">
									<div class="row p-t-30 p-b-20 m-lr-0-xl">
										<div class="col-md-8">
										<h5 class="mtext-101">Top Up Saldo</h5>
										</div>
										<!--<div class="col-md-4 text-right">
											<a href="#" class="js-show-modal1"><i class="fa fa-history"></i> Lihat Semua Transaksi</a>
										</div>-->
									</div>

									<div class="row">
										<div class="col-md-12 m-lr-auto">
											<div id="loadhistorytopup">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Riwayat Tarik -->
							<div class="row bor10 p-l-25 p-r-15 m-t-20 p-lr-0-lg">
								<div class="col-md-12 m-lr-auto m-b-30">
									<div class="row p-t-30 p-b-20 m-lr-0-xl">
										<div class="col-md-8">
										<h5 class="mtext-101">Transaksi Terakhir</h5>
										</div>
										<!--<div class="col-md-4 text-right">
											<a href="#" class="js-show-modal1"><i class="fa fa-history"></i> Lihat Semua Transaksi</a>
										</div>-->
									</div>

									<div class="row">
										<div class="col-md-12 m-lr-auto">
											<div id="loadhistorysaldo">
											</div>
										</div>
									</div>
								</div>
							</div>
		        		</div>
					</div>

  					<!-- Tab Informasi Akun -->
					<div role="tabpanel" class="tab-pane fade in" id="informasi">
						<div class="container">
							<div class="row">
								<div class="col-md-8 m-lr-auto m-b-30 bor8 p-all-40" style="position:relative;overflow:hidden;z-index:1;">
									<!--
									<img style="position:absolute;top:10%;right:0;z-index:-1;" src="<?php echo base_url("assets/img/komponen/user-detail.png"); ?>" />
									-->
									<div class="m-b-20">
										<h5 class="mtext-109 color1">profil pengguna</h5>
									</div>
									<?php
										$profil = $this->func->getProfil($_SESSION["usrid"],"semua","usrid");
										$user = $this->func->getUser($_SESSION["usrid"],"semua");
									?>
									<form class="form-horizontal" id="profil">
										<div class="form-group">
											<div class="m-b-10">
												<label class="mtext-102 control-label" style="padding-top: 10px;">Nama</label>
												<input class="form-control stext-111 cl2 plh3 size-116 col-md-6" type="text" name="nama" value="<?php echo $profil->nama; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="m-b-10">
												<label class="mtext-102 control-label" style="padding-top: 10px;">Email</label>
												<input class="form-control stext-111 cl2 plh3 size-116 col-md-6" type="text" name="email" value="<?php echo $user->username; ?>">
											</div>
										</div>
										<div class="form-group">
											<div class="m-b-10">
												<label class="mtext-102 control-label" style="padding-top: 10px;">No Handphone</label>
												<input class="form-control stext-111 cl2 plh3 size-116 col-md-6" type="text" name="nohp" value="<?php echo $profil->nohp; ?>">
											</div>
										</div>
										<div class="form-group">
											<label class="mtext-102 control-label" style="padding-top: 10px;">Kelamin</label>
											<div class="rs1-select2 rs2-select2 bor8 col-md-4 col-8 p-lr-0">
												<select class="js-select2 w-full" name="kelamin">
													<option value="">Kelamin</option>
													<option value="1" <?php if($profil->kelamin == 1){ echo "selected"; } ?>>Laki-laki</option>
													<option value="2" <?php if($profil->kelamin == 2){ echo "selected"; } ?>>Perempuan</option>
												</select>
												<div class="dropDownSelect2"></div>
											</div>
										</div>
										<div class="form-group m-t-50">
											<a href="javascript:void(0)" onclick="simpanProfil()" class="stext-101 cl0 size-107 bg-1 hovbtn2 p-tb-10 p-lr-25 trans-04 m-b-10">
												simpan pengaturan
											</a>
											<span id="profilload" class="cl1" style="display:none;"><i class='fa fa-spin fa-spinner'></i> Menyimpan...</span>
										</div>
									</form>
								</div>

								<div class="col-md-8 m-lr-auto m-b-30 bor8 p-all-40" style="position:relative;overflow:hidden;z-index:1;">
									<!--
									<img style="position:absolute;top:5%;right:0;z-index:-1;" src="<?php echo base_url("assets/img/komponen/password.png"); ?>" />
									-->
									<div class="m-b-20">
										<h5 class="mtext-109 color1">ganti password</h5>
									</div>
									<form class="form-horizontal" id="gantipassword">
										<div class="form-group">
											<div class="m-b-10">
												<label class="mtext-102 control-label" style="padding-top: 10px;">Password Baru</label>
												<input class="form-control stext-111 cl2 plh3 size-116 col-md-6" type="password" name="password" value="">
											</div>
										</div>
										<div class="form-group m-t-50">
											<a href="javascript:void(0)" onclick="simpanPassword()" class="stext-101 cl0 size-107 bg-1 hovbtn2 p-tb-10 p-lr-25 trans-04 m-b-10">
												simpan password
											</a>
											<span id="passwload" class="cl1" style="display:none;"><i class='fa fa-spin fa-spinner'></i> Menyimpan...</span>
										</div>
									</form>
								</div>
							</div>
						</div>


					</div>

					<!-- REKENING -->
					<div role="tabpanel" class="tab-pane fade" id="rekening">
						<?php
							$this->db->where("usrid",$_SESSION["usrid"]);
							$db = $this->db->get("rekening");

							if($db->num_rows() <= 10){
						?>
						<div class="row">
							<div class="col-lg-12 m-lr-auto m-b-30">
								<div class="m-l-25 m-r--38 m-lr-0-xl">
									<div class="row">
										<div class="col-md-4 m-tb-20">
											<a href="javascript:tambahRekening();" class="stext-101 cl0 size-101 bg-1 hovbtn2 p-lr-30 p-tb-14 trans-04">
												<i class="fa fa-plus"></i> &nbsp;Tambah Rekening
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>

						<div class="row">
							<div class="col-lg-12 m-lr-auto m-b-50">
								<div class="m-l-25 m-r--38 m-lr-0-xl">
									<div class="wrap-table-alamat">
										<table class="table-alamat table-responsive">
											<tr class="table_head">
												<th class="p-l-20">#</th>
												<th>No Rekening</th>
												<th>Atasnama</th>
												<th>Bank</th>
												<th>Kantor Cabang</th>
												<th></th>
											</tr>

											<?php
												$no = 1;
												foreach($db->result() as $res){
											?>
											<tr class="table_row">
												<td class="p-lr-20 p-tb-10">
													<p><?php echo $no; ?></p>
												</td>
												<td>
													<p><?php echo $res->norek; ?></p>
												</td>
												<td>
													<p><?php echo $res->atasnama; ?></p>
												</td>
												<td>
													<p>BANK <?php echo $this->func->getBank($res->idbank,"nama"); ?></p>
												</td>
												<td>
													<p><?php echo $res->kcp; ?></p>
												</td>
												<td>
													<a href="javascript:editRekening(<?php echo $res->id; ?>)" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="javascript:hapusRekening(<?php echo $res->id; ?>)" class="btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
											<?php
													$no++;
												}
												if($db->num_rows() == 0){
													echo "<tr><td class='p-all-10 txt-center' colspan=5>
													<p class='cl1'><i class='fa fa-exclamation-triangle'></i> Belum ada daftar rekening, silahkan tambah data untuk menarik saldo.</p>
													</td></tr>";
												}
											?>

										</table>
									</div>
								</div>
							</div>
						</div>
          			</div>

					<!-- ALAMAT -->
					<div role="tabpanel" class="tab-pane fade" id="alamat">
						<?php
							$this->db->where("usrid",$_SESSION["usrid"]);
							$db = $this->db->get("alamat");

							if($db->num_rows() <= 10){
						?>
						<div class="row">
							<div class="col-lg-12 m-lr-auto m-b-30">
								<div class="m-l-25 m-r--38 m-lr-0-xl">
									<div class="row">
										<div class="col-md-4 m-tb-20">
											<a href="javascript:tambahAlamat();" class="stext-101 cl0 size-101 bg-1 hovbtn2 p-lr-30 p-tb-14 trans-04">
												<i class="fa fa-plus"></i> &nbsp;Tambah Alamat
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>

						<div class="row">
							<div class="col-lg-12 m-lr-auto m-b-50">
								<div class="m-l-25 m-r--38 m-lr-0-xl">
									<div class="wrap-table-alamat">
										<table class="table-alamat table-responsive">
											<tr class="table_head">
												<th class="p-l-20">#</th>
												<th>Nama Penerima</th>
												<th>No Handphone</th>
												<th>Alamat</th>
												<th></th>
											</tr>

											<?php
												$no = 1;
												foreach($db->result() as $res){
											?>
											<tr class="table_row">
												<td class="p-lr-20 p-tb-10">
													<p><?php echo $res->judul; ?></p>
													<small class="label-primary">Alamat Utama</small>
												</td>
												<td>
													<p><?php echo $res->nama; ?></p>
												</td>
												<td>
													<p><?php echo $res->nohp; ?></p>
												</td>
												<td>
													<p><?php echo $res->alamat."<br/><small>Kodepos ".$res->kodepos."</small>"; ?></p>
												</td>
												<td>
													<a href="javascript:editAlamat(<?php echo $res->id; ?>)" class="btn btn-success" title="Edit"><i class="fa fa-edit"></i></a>
													<a href="javascript:hapusAlamat(<?php echo $res->id; ?>)" class="btn btn-danger" title="Hapus"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
											<?php
													$no++;
												}
												if($db->num_rows() == 0){
													echo "<tr><td class='p-all-10 txt-center' colspan=5>
													<p class='cl1'><i class='fa fa-exclamation-triangle'></i> Belum ada alamat tersimpan.</p>
													</td></tr>";
												}
											?>

										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>

		</div>
	</div>

  <script type="text/javascript">
    $(function(){
      $(".klik").trigger("click");

			$("#loadhistorysaldo").load("<?php echo site_url("assync/getHistoryTarik"); ?>");
			$("#loadhistorytopup").load("<?php echo site_url("assync/getHistoryTopup"); ?>");

			$("#rekeningchange").change(function(){
				if($(this).val() == 0){
					$('.wrap-modal2').removeClass("show-modal2");
					$('#tambahrekening').addClass("show-modal2");
					$(this).val("").trigger("change");
				}
			});

			$("#tariksaldo form").on("submit",function(e){
				e.preventDefault();
				$(".submitbutton",this).parent().append("<span class='cl1'>Memproses...</span>");
				$(".submitbutton",this).hide();
				var submitbtn =	$(".submitbutton",this);

				$.post("<?php echo site_url("manage/saldo"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal("Berhasil!","Berhasil menarik saldo, tunggu maks. 2 hari kerja sampai uang Anda masuk ke rekening","success").then((value) => {
							location.reload();
						});
					}else{
						swal("Gagal!",data.msg,"error");
						submitbtn.show();
						submitbtn.parent().find("span").remove();
					}
				});
			});

			$("#topupsaldo form").on("submit",function(e){
				e.preventDefault();
				$(".submitbutton",this).parent().append("<span class='cl1'>Memproses...</span>");
				$(".submitbutton",this).hide();
				var submitbtn =	$(".submitbutton",this);

				$.post("<?php echo site_url("assync/topupsaldo"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						window.location.href= "<?=site_url("home/topupsaldo")?>?inv="+data.idbayar;
					}else{
						swal("Gagal!",data.msg,"error");
						submitbtn.show();
						submitbtn.parent().find("span").remove();
					}
				});
			});

			$("#tambahalamat form").on("submit",function(e){
				e.preventDefault();
				$(".submitbutton",this).parent().append("<span class='cl1'>Memproses...</span>");
				$(".submitbutton",this).hide();
				var submitbtn =	$(".submitbutton",this);

				$.post("<?php echo site_url("assync/tambahalamat"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal("Berhasil!","Berhasil menambah alamat","success").then((value) => {
							location.reload();
						});
					}else{
						swal("Gagal!","Gagal menambah alamat baru, silahkan ulangi beberapa saat lagi.","error");
						submitbtn.show();
						submitbtn.parent().find("span").remove();
					}
				});
			});

			$("#tambahrekening form").on("submit",function(e){
				e.preventDefault();
				$(".submitbutton",this).parent().append("<span class='cl1'>Memproses...</span>");
				$(".submitbutton",this).hide();
				var submitbtn =	$(".submitbutton",this);

				$.post("<?php echo site_url("assync/tambahrekening"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal("Berhasil!","Berhasil menambah rekening","success").then((value) => {
							location.reload();
						});
					}else{
						swal("Gagal!","Gagal menambah rekening baru, silahkan ulangi beberapa saat lagi.","error");
						submitbtn.show();
						submitbtn.parent().find("span").remove();
					}
				});
			});

			$("#alamatprov").change(function(){
	      changeKab($(this).val(),"");
			});

			$("#alamatkab").change(function(){
	      changeKec($(this).val(),"");
			});

    });

		function copyLink() {
			$("#copylink").select();
			document.execCommand("copy");
			swal("Berhasil menyalin!","silahkan paste/tempel dan kirim alamat yg sudah disalin ke teman Anda","success");
		}

		// FORM CHANGING
		function changeProv(proval,callback){
			$("#alamatprov").val(proval).trigger("change");
			if(callback) callback();
		}
		function changeKec(kabval,valu,callback){
			$("#alamatkec").html("<option value=''>Loading...</option>").trigger("change");
			$.post("<?php echo site_url("assync/getkec"); ?>",{"id":kabval},function(msg){
				var data = eval("("+msg+")");
				$("#alamatkec").html(data.html).promise().done(function(){
					$("#alamatkec").val(valu);
				});
			});
			if(callback) callback();
		}
		function changeKab(proval,valu,callback){
			$("#alamatkab").html("<option value=''>Loading...</option>").trigger("change");
			$("#alamatkec").html("<option value=''>Kecamatan</option>").trigger("change");

			$.post("<?php echo site_url("assync/getkab"); ?>",{"id":proval},function(msg){
				var data = eval("("+msg+")");
				$("#alamatkab").html(data.html).promise().done(function(){
					$("#alamatkab").val(valu);
				})
			});
			if(callback) callback();
		}

		// REKENING
		function tambahRekening(){
			$('.wrap-modal2').removeClass("show-modal2");
			$('#tambahrekening').addClass("show-modal2");
		}
		function editRekening(rek){
			$.post("<?php echo site_url("assync/getRekening"); ?>",{"rek":rek},function(msg){
				var data = eval("("+msg+")");

				if(data.success == true){
					$("#rekeningid").val(rek);
					$("#rekeningidbank").val(data.idbank).trigger("change");
					$("#rekeningatasnama").val(data.atasnama);
					$("#rekeningnorek").val(data.norek);
					$("#rekeningkcp").val(data.kcp);

					$('.wrap-modal2').removeClass("show-modal2");
					$('#tambahrekening').addClass("show-modal2");
				}else{
					swal("Error!","terjadi kesalahan silahkan ulangi beberapa saat lagi.","error");
				}
			});
		}
		function hapusRekening(rek){
			swal({
				title: "Anda yakin?",
				text: "menghapus rekening ini dari akun Anda?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/hapusRekening"); ?>",{"rek":rek},function(msg){
						var data = eval("("+msg+")");

						if(data.success == true){
							swal("Berhasil!","Berhasil menghapus rekening","success").then((value) => {
								location.reload();
							});
						}else{
							swal("Error!","terjadi kesalahan silahkan ulangi beberapa saat lagi.","error");
						}
					});
				}
			});
		}
		function batalTopup(rek){
			swal({
				title: "Anda yakin?",
				text: "membatalkan topup saldo ini?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/bataltopup"); ?>",{"id":rek},function(msg){
						var data = eval("("+msg+")");

						if(data.success == true){
							swal("Berhasil!","Berhasil membatalkan topup saldo","success").then((value) => {
								location.reload();
							});
						}else{
							swal("Error!","terjadi kesalahan silahkan ulangi beberapa saat lagi.","error");
						}
					});
				}
			});
		}

		// ALAMAT
		function tambahAlamat(){
			$("#alamatid").val(0);
			$("#alamatnama").val("");
			$("#alamatnohp").val("");
			$("#alamatstatus").val(0).trigger("change");
			$("#alamatalamat").val("");
			$("#alamatkodepos").val("");
			$("#alamatjudul").val("");
			$("#alamatprov").val("").trigger("change");
			$('.wrap-modal2').removeClass("show-modal2");
			$('#tambahalamat').addClass("show-modal2");
		}
		function editAlamat(rek){
			$.post("<?php echo site_url("assync/getAlamat"); ?>",{"rek":rek},function(msg){
				var data = eval("("+msg+")");

				if(data.success == true){
					changeProv(data.prov),
					changeKab(data.prov,data.kab),
					changeKec(data.kab,data.idkec);
					$("#alamatid").val(rek);
					$("#alamatnama").val(data.nama);
					$("#alamatnohp").val(data.nohp);
					$("#alamatstatus").val(data.status).trigger("change");
					$("#alamatalamat").val(data.alamat);
					$("#alamatkodepos").val(data.kodepos);
					$("#alamatjudul").val(data.judul);
					$('.wrap-modal2').removeClass("show-modal2");
					$('#tambahalamat').addClass("show-modal2");
				}else{
					swal("Error!","terjadi kesalahan silahkan ulangi beberapa saat lagi.","error");
				}
			});
		}
		function hapusAlamat(rek){
			swal({
				title: "Anda yakin?",
				text: "menghapus alamat ini dari akun Anda?",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.post("<?php echo site_url("assync/hapusAlamat"); ?>",{"rek":rek},function(msg){
						var data = eval("("+msg+")");

						if(data.success == true){
							swal("Berhasil!","Berhasil menghapus alamat","success").then((value) => {
								location.reload();
							});
						}else{
							swal("Error!","terjadi kesalahan silahkan ulangi beberapa saat lagi.","error");
						}
					});
				}
			});
		}

		// SALDO
		function topupSaldo(){
			$('#topupsaldo').addClass('show-modal2');
		}
		function tarikSaldo(){
			$('#tariksaldo').addClass('show-modal2');
		}
		function historySaldo(page){
			$("#loadhistorysaldo").html("Loading...");
			$("#loadhistorysaldo").load("<?php echo site_url("assync/getHistoryTarik"); ?>?page="+page);
		}
		function getopupSaldo(page){
			$("#loadhistorysaldo").html("Loading...");
			$("#loadhistorysaldo").load("<?php echo site_url("assync/getHistoryTopup"); ?>?page="+page);
		}
		function simpanProfil(){
			$("#profil a").hide();
			$("#profilload").show();
			$.post("<?php echo site_url("assync/updateprofil"); ?>",$("#profil").serialize(),function(msg){
				var data = eval("("+msg+")");
				$("#profil a").show();
				$("#profilload").hide();
				if(data.success == true){
					swal("Berhasil!","Berhasil menyimpan informasi pengguna","success");
				}else{
					swal("Gagal!","Gagal menyimpan informasi pengguna","error");
				}
			});
		}
		function simpanPassword(){
			$("#gantipassword a").hide();
			$("#passwload").show();
			$.post("<?php echo site_url("assync/updatepass"); ?>",$("#gantipassword").serialize(),function(msg){
				var data = eval("("+msg+")");
				$("#gantipassword a").show();
				$("#passwload").hide();
				if(data.success == true){
					$("#gantipassword input").val("");
					swal("Berhasil!","Berhasil menyimpan password baru","success");
				}else{
					swal("Gagal!","Gagal menyimpan informasi password","error");
				}
			});
		}
  </script>


    <!-- Modal3-Topup Saldo -->
	<div class="wrap-modal2 js-modal2 p-t-60 p-b-20" id="topupsaldo">
		<form method="POST" action="<?=site_url("manage/topupsaldo")?>">
			<div class="overlay-modal2 js-hide-modal2"></div>
			<div class="container">
				<div class="container-modal2 bg0 p-t-60 p-b-30 p-lr-20-lg how-pos3-parent">
					<button type="button" class="how-pos3 hov3 trans-04 js-hide-modal2">
						<img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
					</button>

					<div class="row m-lr-0">
						<div class="col-md-12 p-b-20">
							<div class="p-l-25 p-r-30 p-lr-0-lg">
								<h4 class="color1"><b>Top Up Saldo</b></h4>
							</div>
						</div>
						<div class="col-md-12 p-b-10">
							<div class="m-lr-20 p-t-15 p-b-15 p-l-25 p-r-30">
								<div class="form-group row">
									<div class="col-sm-4">
										<label class="mtext-102 control-label" style="padding-top: 10px;">Jumlah</label>
									</div>
									<div class="col-md-8 m-b-12 how-pos4-parent">
										<input class="form-control stext-111 cl2 plh3 size-116" type="text" id="jumlahtopup" name="jumlah" placeholder="Rp" required>
									</div>
									<div class="col-6 col-md-3 m-t-10">
										<button type="button" class="btn btn-secondary btn-block" onclick="$('#jumlahtopup').val(50000)">50.000</button>
									</div>
									<div class="col-6 col-md-3 m-t-10">
										<button type="button" class="btn btn-secondary btn-block" onclick="$('#jumlahtopup').val(100000)">100.000</button>
									</div>
									<div class="col-6 col-md-3 m-t-10">
										<button type="button" class="btn btn-secondary btn-block" onclick="$('#jumlahtopup').val(150000)">150.000</button>
									</div>
									<div class="col-6 col-md-3 m-t-10">
										<button type="button" class="btn btn-secondary btn-block" onclick="$('#jumlahtopup').val(200000)">200.000</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 m-lr-10 p-l-25 p-r-30 p-lr-0-lg">
							<button type="submit" class="submitbutton flex-c-m stext-101 cl0 size-107 bg-1 hovbtn2 p-lr-15 trans-04 m-b-10">
								Topup Saldo
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>

    <!-- Modal3-Tarik Saldo -->
	<div class="wrap-modal2 js-modal2 p-t-60 p-b-20" id="tariksaldo">
		<form>
			<div class="overlay-modal2 js-hide-modal2"></div>
			<div class="container">
				<div class="container-modal2 bg0 p-t-60 p-b-30 p-lr-20-lg how-pos3-parent">
					<button type="button" class="how-pos3 hov3 trans-04 js-hide-modal2">
						<img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
					</button>

					<div class="row m-lr-0">
						<div class="col-md-12 p-b-20">
							<div class="p-l-25 p-r-30 p-lr-0-lg">
								<h4 class="color1"><b>Penarikan Saldo</b></h4>
							</div>
						</div>
						<div class="col-md-12 p-b-10">
							<div class="m-lr-20 p-t-15 p-b-15 p-l-25 p-r-30">
							<div class="form-group row">
								<div class="col-sm-4">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Jumlah</label>
								</div>
								<div class="col-md-8 m-b-12 how-pos4-parent">
								<input class="form-control stext-111 cl2 plh3 size-116" type="text" name="jumlah" placeholder="Rp" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-4">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Rekening Tujuan</label>
								</div>
								<div class="col-md-8">
									<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
									<select class="js-select2" id="rekeningchange" name="idrek" required >
									<option value="" id='defaultrek'>Pilih Rekening</option>
										<?php
											$this->db->where("usrid",$_SESSION["usrid"]);
											$db = $this->db->get("rekening");
											foreach($db->result() as $res){
												echo "<option value='".$res->id."'>".$res->norek." - ".$res->atasnama."</option>";
											}
										?>
										<option value="0">+ Tambah Rekening Baru</option>
									</select>
									<div class="dropDownSelect2"></div>
									</div>
								</div>
								</div>
							<div class="form-group row">
								<div class="col-sm-4">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Catatan</label>
								</div>
								<div class="col-md-8 m-b-12 how-pos4-parent">
								<input class="form-control stext-111 cl2 plh3 size-116" type="text" name="keterangan" placeholder="Catatan">
								</div>
							</div>
							</div>
						</div>
						<div class="col-md-12 m-lr-10 p-l-25 p-r-30 p-lr-0-lg">
							<button type="submit" class="submitbutton flex-c-m stext-101 cl0 size-107 bg-1 hovbtn2 p-lr-15 trans-04 m-b-10">
								Tarik Saldo
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
    </div>

    <!-- Modal3-Tambah Rekening -->
	<div class="wrap-modal2 js-modal2 p-t-60 p-b-20" id="tambahrekening">
		<form class="form-horizontal">
			<input type="hidden" name="id" id="rekeningid" value="0" />
        <div class="overlay-modal2 js-hide-modal2"></div>
        <div class="container">
            <div class="container-modal2 bg0 p-t-60 p-b-30 p-lr-20-lg how-pos3-parent">
                <button type="button" class="how-pos3 hov3 trans-04 js-hide-modal2">
                    <img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-12 p-b-20">
                        <div class="p-l-25 p-r-30 p-lr-0-lg m-lr-20">
                            <h4 class="color1"><b>Informasi Rekening Bank</b></h4>
                        </div>
                    </div>
                    <div class="col-md-12 p-b-20">
                      <div class="m-lr-20 p-t-15 p-b-15 p-l-25 p-r-30">
												<div class="row">
													<div class="col-md-12">
														<label class="mtext-102 control-label" style="padding-top: 10px;">Bank</label>
														<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
															<select class="js-select2" id="rekeningidbank" name="idbank" required >
																<option value="">Pilih Bank</option>
																<?php
																	$db = $this->db->get("rekeningbank");
																	foreach($db->result() as $res){
																		echo "<option value='".$res->id."'>".$res->nama."</option>";
																	}
																?>
															</select>
															<div class="dropDownSelect2"></div>
														</div>
													</div>
												</div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">No Rekening</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="rekeningnorek" type="text" name="norek" placeholder="" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">Atas Nama</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="rekeningatasnama" type="text" name="atasnama" placeholder="" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">Kantor Cabang</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="rekeningkcp" type="text" name="kcp" placeholder="" required>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="p-l-25 p-r-30 p-lr-0-lg m-lr-30">
                        <button type="submit" class="submitbutton stext-101 cl0 size-107 bg-1 hovbtn2 p-lr-30 p-tb-10 trans-04 m-b-10">
                            Simpan Rekening
                        </button>
                    </div>
                </div>
            </div>
        </div>
			</form>
    </div>

    <!-- Modal3-Tambah Rekening -->
	<div class="wrap-modal2 js-modal2 p-t-60 p-b-20" id="tambahalamat">
		<form class="form-horizontal">
			<input type="hidden" name="id" id="alamatid" value="0" />
        <div class="overlay-modal2 js-hide-modal2"></div>
        <div class="container">
            <div class="container-modal2 bg0 p-t-60 p-b-30 p-lr-20-lg how-pos3-parent">
                <button type="button" class="how-pos3 hov3 trans-04 js-hide-modal2">
                    <img src="<?php echo base_url("assets/images/icons/icon-close.png"); ?>" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-12 p-b-20">
                        <div class="p-l-25 p-r-30 p-lr-0-lg m-lr-20">
                            <h4 class="color1"><b>Informasi Alamat</b></h4>
                        </div>
                    </div>
                    <div class="col-md-12 p-b-20">
                      <div class="m-lr-20 p-t-15 p-b-15 p-l-25 p-r-30">
						<div class="row">
							<div class="col-md-12">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Simpan sebagai? <small>cth: Alamat Rumah, Alamat Kantor, dll</small></label>
								<input class="form-control stext-111 cl2 plh3 size-116" id="alamatjudul" type="text" name="judul" placeholder="" required>
							</div>
						</div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">Nama Penerima</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="alamatnama" type="text" name="nama" placeholder="" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">No Handphone</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="alamatnohp" type="text" name="nohp" placeholder="" required>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">Alamat Lengkap</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="alamatalamat" type="text" name="alamat" placeholder="" required>
                          </div>
                        </div>
						<div class="row">
							<div class="col-md-12">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Provinsi</label>
								<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
									<select class="js-select2" id="alamatprov" required >
										<option value="">Pilih Provinsi</option>
										<?php
											$db = $this->db->get("prov");
											foreach($db->result() as $res){
												echo "<option value='".$res->id."'>".$res->nama."</option>";
											}
										?>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Kabupaten</label>
								<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
									<select class="js-select2" id="alamatkab" required >
										<option value="">Pilih Kabupaten/Kota</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Kecamatan</label>
								<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
									<select class="js-select2" id="alamatkec" name="idkec" required >
										<option value="">Pilih Kecamatan</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="mtext-102 control-label" style="padding-top: 10px;">Kodepos</label>
                            <input class="form-control stext-111 cl2 plh3 size-116" id="alamatkodepos" type="text" name="kodepos" placeholder="" required>
                          </div>
                        </div>
						<div class="row m-t-20">
							<div class="col-md-12">
								<label class="mtext-102 control-label" style="padding-top: 10px;">Simpan Sebagai</label>
								<div class="m-b-12 how-pos4-parent rs1-select2 rs2-select2 bor8 p-lr-0 m-lr-0">
									<select class="js-select2" id="alamatstatus" name="status" required >
										<option value="0">Alamat</option>
										<option value="1">Alamat Utama</option>
									</select>
									<div class="dropDownSelect2"></div>
								</div>
							</div>
						</div>
                      </div>
                    </div>
                    <div class="m-lr-30 p-l-25 p-r-30 p-lr-0-lg">
                        <button type="submit" class="submitbutton stext-101 cl0 size-107 bg-1 hovbtn2 p-lr-30 p-tb-10 trans-04 m-b-10">
                            Simpan Alamat
                        </button>
                    </div>
                </div>
            </div>
        </div>
			</form>
    </div>
