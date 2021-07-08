
	<!-- Footer -->
	<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
		<div class="row p-b-90 container">
			<div class="col-md-3">
				<h4 class="s-text12 p-b-30">
					HUBUNGI KAMI
				</h4>

				<div>
					<?php $set = $this->func->getSetting("semua"); ?>
					<p>
						<?=$set->jamkerja?>
					</p>
					&nbsp;
					<table>
						<tr><td class='p-r-10'><i class="fa fa-phone color1"></i></td><td><?=$set->wasap?></td></tr>
						<tr><td class='p-r-10'><i class="fa fa-square color1"></i> </td><td><?=$set->lineid?></td></tr>
						<tr><td class='p-r-10'><i class="fa fa-envelope-open color1"></i> </td><td><?=$set->email?></td></tr>
						<tr><td class='p-r-10'><i class="fa fa-map-marker color1"></i> </td><td><?=$set->alamat?></td></tr>
					</table>
				</div>
			</div>

			<div class="col-md-3">
				<h4 class="s-text12 p-b-30">
					Kategori
				</h4>

				<ul>
					<?php
						$this->db->where("parent",0);
						$kategori = $this->db->get("kategori");
						foreach($kategori->result() as $r){
					?>
					<li class="p-b-9">
						<a href="<?=site_url("kategori/".$r->url)?>">
							<?=ucwords(strtolower($r->nama))?>
						</a>
					</li>
					<?php
						}
					?>
				</ul>
			</div>

			<div class="col-md-3">
				<h4 class="s-text12 p-b-30">
					bergabung menjadi mitra
				</h4>

				<ul>
					<a target="_blank" onclick="fbq('track','Contact')" href="https://wa.me/<?=$this->func->getRandomWasap()?>/?text=Halo,%20mohon%20infonya%20untuk%20menjadi%20reseller%20*<?=$this->func->getSetting("nama")?>*%20caranya%20bagaimana%20ya?%20dan%20syaratnya%20apa%20saja,%20terima%20kasih" class="btn btn-success btn-block"><i class="fa fa-whatsapp"></i> Hubungi Admin</a><p/>
					&nbsp;<p>Dapatkan harga khusus untuk mitra yang terdaftar.
				</ul>

				<h4 class="s-text12 p-b-30 p-t-30">
					Selalu  Terhubung
				</h4>

				<div class="flex-m p-t-10">
					<a onclick="fbq('track','Contact')" href="<?=$set->facebook?>" style="color: #2980b9;" class="fs-32 color1 p-r-20 fa fa-facebook-square"></a>
					<a onclick="fbq('track','Contact')" href="<?=$set->instagram?>" style="color: #dd2a7b;" class="fs-32 color1 p-r-20 fa fa-instagram"></a>
					<a onclick="fbq('track','Contact')" href="mailto:<?=$set->email?>" class="color1 fs-32 color1 p-r-20 fa fa-envelope"></a>
				</div>
			</div>

			<div class="col-md-3">
				<h4 class="s-text12 p-b-10">
					Pembayaran
				</h4>

				<div class="flex-m p-t-10">
					<img style="width:100%;" src="<?=base_url("assets/images/ipaymu.png")?>" />
				</div>

				<h4 class="s-text12 p-b-10 p-t-30">
					Pengiriman
				</h4>

				<div class="p-t-10">
					<?php
						$kurir = explode("|",$set->kurir);
						for($i=0; $i<count($kurir); $i++){
							$kur = $this->func->getKurir($kurir[$i],"halaman");
							echo '<img style="width:28%;margin:2%;" src="'.base_url("cdn/assets/img/kurir/".$kur.".png").'" />';
						}
					?>
				</div>
			</div>
		</div>

		<div class="t-center p-l-15 p-r-15">
			<div class="t-center s-text8 p-t-20">
				Copyright © <?= date('Y') ?> All rights reserved. | <?=strtoupper(strtolower($set->nama))?></a>
			</div>
		</div>
	</footer>



	<!-- Back to top
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
	</div> -->

	<?php if($this->func->cekLogin() == true){ ?>
	<script type="text/javascript">
		$(function(){
			$("#modalpesan").on('shown.bs.modal', function(){
				fbq("track","Contact");
				var seti = setInterval(()=>{ loadPesan(); },3000);
				$("#modalpesan").on('hidden.bs.modal', function(){
					clearInterval(seti);
				});
			});
			
			$("#kirimpesan").on("submit",function(e){
				e.preventDefault();
				$.post("<?=site_url("assync/kirimpesan")?>",$(this).serialize(),function(s){
					fbq("track","Contact");
					var data = eval("("+s+")");
					$("#kirimpesan input").val("");
					if(data.success == true){
						$("#pesan").html('<div class="isipesan"><i class="fa fa-spin fa-spinner"></i> memuat pesan...</div>');
						loadPesan();
					}else{
						swal("GAGAL!","terjadi kendala saat mengirim pesan, coba ulangi beberapa saat lagi","error");
					}
				});
			});
			
			//$("#modalpilihpesan").modal();
			
			function loadPesan(){
				$("#pesan").load("<?=site_url("assync/pesanmasuk")?>",function(){
					$("#pesan").animate({ scrollTop: $("#pesan").prop('scrollHeight')}, 1000);
				});
			}
		});
	</script>
	<div class="modal fade" id="modalpesan" tabindex="-1" role="dialog" style="background: rgba(0,0,0,.5);" style="bottom:0;right:0;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title"><i class="fa fa-comments"></i> Live Chat</h6>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pesan" id="pesan">
					<div class="pesanwrap center">
						<div class="isipesan"><i class="fa fa-spin fa-spinner"></i> memuat pesan...</div>
					</div>
				</div>
				<form id="kirimpesan" method="POST">
					<div class="modal-footer">
						<div class="formpesan row w-full m-lr-0">
							<input type="text" class="form-control col-9" placeholder="ketik pesan..." name="isipesan" required />
							<button type="submit" id="submit" class="btn btn-success col-3"><i class="fa fa-paper-plane"></i> KIRIM</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modalpilihpesan" tabindex="-1" role="dialog" style="background: rgba(0,0,0,.5);" style="bottom:0;right:0;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content p-all-20 text-center">
				<h3>Hubungi Admin</h3><br/>
				<a href="https://wa.me/<?=$this->func->getRandomWasap()?>" target="_blank" class="btn btn-lg btn-block btn-success colorw"><i class="fa fa-whatsapp"></i> &nbsp;Hubungi via Whatsapp</a>
				<button onclick="$('#modalpilihpesan').modal('hide');$('#modalpesan').modal()" class="btn btn-lg btn-block colorw bg-1 hovbtn2"><i class="fa fa-chat"></i> &nbsp;Live Chat</button>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	<a href="https://wa.me/<?=$this->func->getRandomWasap()?>" target="_blank" class="whatsapp-sticky"><i class="fa fa-whatsapp"></i></a>
	<?php }?>
	


<!--===============================================================================================-->
	<!--<script type="text/javascript" src="<?= base_url('assets/vendor/animsition/js/animsition.min.js') ?>"></script>-->
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/bootstrap/js/popper.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/select2/select2.min.js') ?>"></script>
	<script type="text/javascript">
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		});
	</script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/slick/slick.min.js') ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/slick-custom.js') ?>"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/countdowntime/countdowntime.js') ?>"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/lightbox2/js/lightbox.min.js') ?>"></script>
<!--===============================================================================================-->
	<script type="text/javascript" src="<?= base_url('assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
	<script type="text/javascript">
		function formUang(data){
			return data.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
		}
	</script>

<!--===============================================================================================-->
	<script src="<?= base_url('assets/js/main.js') ?>"></script>

<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '<?=$set->fb_pixel?>');
	fbq('track', 'PageView');
	</script>
	<noscript>
	<img height="1" width="1" style="display:none" 
		src="https://www.facebook.com/tr?id=<?=$set->fb_pixel?>&ev=PageView&noscript=1"/>
	</noscript>
<!-- End Facebook Pixel Code -->

</body>
</html>
