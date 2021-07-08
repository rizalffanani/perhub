<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$saldo = $this->func->getSaldo($_SESSION["usrid"],"saldo","usrid");
?>	
<div class="seksen-shadow"></div>
<div class="seksen">
	<div class="wrapper">
		<div class="divider"></div>
		<div class="subtitle">
			<i class="fa fa-wallet"></i> <b>SALDO WARGA</b>
			<div class="line"></div>
		</div>
		<div class="divider"></div>
		<div class="kolom4">
			<div class="well saldobig green">
				Saldo Warga<br/>
				<b>Rp. <?php echo $this->func->formUang($saldo); ?></b>
			</div>
			<div class="penarikan">
				<b>Tarik Dana</b>
				<form id="penarikan" method="POST" action="">
					<ul class="form-parent">
						<li>
							<div class="inner-addon left-addon">
								<span class="fa fa-credit-card"></span>
								<select id="dari" name="idrek" class="form-bordered" required>
									<option value="">Rekening tujuan</option>
								</select>
							</div>
						</li>
						<li>
							<div class="inner-addon left-addon">
								<span class="fa">Rp</span>
								<input type="number" id="jumlah" name="jumlah" class="form-bordered" value="<?php echo $saldo; ?>" placeholder="Jumlah penarikan" required />
							</div>
						</li>
						<li>
							<div class="inner-addon left-addon">
								<span class="fa fa-edit"></span>
								<input type="text" name="keterangan" class="form-bordered" placeholder="Keterangan (opsional)" />
							</div>
						</li>
						<li>
							<button id="submit" type="submit" class="btn btn-green"><i class="fa fa-check"></i> Tarik Dana</button>
						</li>
					</ul>
				</form>
			</div>
		</div>
		<div class="kolom8">
			<div class="saldo-history">
				<b>Riwayat Saldo Warga</b>
				<div class="divider"></div>
				<div class="saldo-scroll">
					<table class="table table-bordered">
						<?php
							$this->db->where("usrid",$_SESSION["usrid"]);
							$this->db->order_by("id","DESC");
							$db = $this->db->get("saldohistory");
							if($db->num_rows() > 0){
								foreach($db->result() as $res){
									if($res->darike == 1){
										$byr = $this->func->getPengiriman($res->sambung,"semua");
										$array = array(
											"[invoice]"	=> "<b>".$this->func->getBayar($byr->idbayar,"invoice")."</b>"
										);
										$teks = strtr($this->func->getSaldodarike($res->darike,"keterangan"),$array);
										$status = $res->tgl." : Selesai";
									}elseif($res->darike == 2){
										$saldotarik = $this->func->getSaldotarik($res->sambung,"semua");
										$rekening = $this->func->getRekening($saldotarik->idrek,"semua");
										$bank = $this->func->getBank($rekening->idbank,"semua");
										$array = array(
											"[total]"	=> $this->func->formUang($res->jumlah),
											"[rekening]"=> "(".$bank->nama." - ".$rekening->norek." a/n ".$rekening->atasnama
										);
										$teks = strtr($this->func->getSaldodarike($res->darike,"keterangan"),$array);
										$status = $res->tgl." : Diproses";
										$status = ($saldotarik->status > 1) ? $status."<br/>".$saldotarik->selesai." : Selesai" : $status;
									}else{
										$teks = "error";
									}
									$class = ($res->jenis == 1) ? "green" : "red";
									echo "
										<tr>
											<td>".$teks."<br/><small>".$status."</small></td>
											<td><small>jumlah</small><br/><b class='".$class."'>Rp ".$this->func->formUang($res->jumlah)."</b></td>
											<td><small>saldo akhir</small><br/><b class='default'>Rp ".$this->func->formUang($res->saldoakhir)."</b></td>
										</tr>
										";
								}
							}
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function loadRekening(id){
		$("#dari").load("<?php echo site_url("assync/getrekeningdrop/".$_SESSION["usrid"]."/tujuan"); ?>",function(){
			if(id != 0){
				$("#dari").val(id);
			}
		});
	}
	
	$(function(){
		loadRekening(0);
		$("#dari").change(function(){
			if($(this).val() == "tambah"){
				modal("modal");
			}
		});
		
		$("#jumlah").keyup(function(e){
			//e.preventDefault();
			if($(this).val() < 10000){
				alert("saldo penarikan minimal Rp. 10.000");
				$(this).val(10000);
			}else if($(this).val() > <?php echo $saldo; ?>){
				alert("saldo tidak cukup");
				$(this).val(<?php echo $saldo; ?>);
			}
		});
		$("#jumlah").change(function(e){
			//e.preventDefault();
			if($(this).val() < 10000){
				alert("saldo penarikan minimal Rp. 10.000");
				$(this).val(10000);
			}else if($(this).val() > <?php echo $saldo; ?>){
				alert("saldo tidak cukup");
				$(this).val(<?php echo $saldo; ?>);
			}
		});
		
		$(".closer").click(function(){
			$("#dari").val("");
		});
		
		$("#tambahrek").submit(function(e){
			e.preventDefault();
			var noreksub = $("#noreksubmit").html();
			$("#noreksubmit").html("<i class='fa fa-circle-notch fa-spin'></i> menyimpan");
			$("#noreksubmit").prop("disabled",true);
			$.post("<?php echo site_url("assync/tambahrekening"); ?>",$(this).serialize(),function(msg){
				var data = eval("("+msg+")");
				if(data.success == true){
					loadRekening(data.id);
					modal('hide');
					$("#noreksubmit").prop("disabled",false);
					$("#noreksubmit").html(noreksub);
					
				}else{
					alert("ERROR! gagal menyimpan.");
				}
			});
		});
	});
</script>


<div id="modal" class="modal">
	<div class="modal-content modal-kecil">
		<span class="close closer">TUTUP</span>
		<div class="subtitle">
			<b>Tambah Rekening</b>
			<div class="line"></div>
		</div>
		<div>
			<form id="tambahrek" method="post" action="<?php echo site_url("assync/tambahrekening"); ?>">
				<ul class="form-parent">
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-university"></span>
							<select name="idbank" class="form-bordered" required >
								<option value="">Pilih Bank</option>
								<?php
									$db = $this->db->get("rekeningbank");
									foreach($db->result() as $re){
										echo "<option value='".$re->id."'>BANK ".$re->nama."</option>";	
									}
								?>
							</select>
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-address-card"></span>
							<input type="text" name="atasnama" class="form-bordered" placeholder="atasnama rekening" reqquired />
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-book"></span>
							<input type="text" name="norek" class="form-bordered" placeholder="nomor rekening" reqquired />
						</div>
					</li>
					<li>
						<div class="inner-addon left-addon">
							<span class="fa fa-building"></span>
							<input type="text" name="kcp" class="form-bordered" placeholder="kantor cabang" reqquired />
						</div>
					</li>
					<li>
						<button id="noreksubmit" type="submit" class="btn btn-green"><i class="fa fa-check"></i> Simpan</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</div>