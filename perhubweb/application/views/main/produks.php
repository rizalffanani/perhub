
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

      <?php
        $link = $this->func->arrEnc(array("category"=>$data->idcat),"encode");
		$set = $this->func->getSetting("semua");
		$kategori = $this->func->getKategori($data->idcat,"semua");
		$kategorinama = is_object($kategori) ? $kategori->nama : "";
		$textorder = $data->preorder == 0 ? "Tambah Ke Keranjang" : "Pre Order";
		
		$level = isset($_SESSION["lvl"]) ? $_SESSION["lvl"] : 0;
		if($level == 5){
			$result = $data->hargadistri;
		}elseif($level == 4){
			$result = $data->hargaagensp;
		}elseif($level == 3){
			$result = $data->hargaagen;
		}elseif($level == 2){
			$result = $data->hargareseller;
		}else{
			$result = $data->harga;
		}
		
		$this->db->where("idproduk",$data->id);
		$dbv = $this->db->get("produkvariasi");
		$totalstok = 0;
		$hargs = 0;
		foreach($dbv->result() as $rv){
			$totalstok += $rv->stok;
			if($level == 5){
				$harga[] = $rv->hargadistri;
			}elseif($level == 4){
				$harga[] = $rv->hargaagensp;
			}elseif($level == 3){
				$harga[] = $rv->hargaagen;
			}elseif($level == 2){
				$harga[] = $rv->hargareseller;
			}else{
				$harga[] = $rv->harga;
			}
			$hargs += $rv->harga;
		}
      ?>
			<a href="<?php echo site_url("search/?token=".$link); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo $kategorinama; ?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?php echo $data->nama; ?>
			</span>
		</div>
	</div>


	<!-- Product Detail -->
	<section class="sec-product-detail p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<div class="slick3 gallery-lb">
								<?php
									$this->db->where("idproduk",$data->id);
									$this->db->order_by("jenis","DESC");
									$db = $this->db->get("upload");
									foreach ($db->result() as $res){
								?>
								<div class="item-slick3" data-thumb="<?php echo base_url("cdn/uploads/".$res->nama); ?>">
									<div class="wrap-pic-w pos-relative">
										<img src="<?php echo base_url("cdn/uploads/".$res->nama); ?>" alt="IMG-PRODUCT">
										
										<!--
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 hov-btn3 trans-04" href="<?php echo base_url("uploads/products/".$res->nama); ?>">
											<i class="fa fa-expand"></i>
										</a>
										-->
									</div>
								</div>
                				<?php } ?>

							</div>
							<div class="wrap-slick3-dots"></div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 id="js-name-detail" class="mtext-105 cl2 p-b-14">
							<?php echo $data->nama; ?>
						</h4>

						<span id="hargacetak" class="mtext-106 color1">
							<?php 
								if($hargs > 0){
									echo "Rp. ".$this->func->formUang(min($harga))." - ".$this->func->formUang(max($harga));
								}else{
									echo "Rp. ".$this->func->formUang($result);
								}
							?>
						</span>
						
						<?php if($data->preorder != 0){ ?>
						<div class="m-t-20">
							<div style="display:inline-block;border:1px solid <?=$set->color1?>;padding:6px 10px;color:<?=$set->color1?>;font-weight:bold;">
								PRODUK PRE ORDER
							</div>
						</div>
						<?php } ?>

						<p class="mtext-102 cl2 p-t-14">
						  <span class="fs-18">
							<?php
							  $ulasan = $this->func->getBintang($data->id);
							  $star = $ulasan["star"];
							  for($i=1; $i<=5; $i++){
								$color = ($i <= $star) ? "text-warning" : "text-secondary";
								echo '<i class="fa fa-star '.$color.'"></i>';
							  }
							?>
						  </span> &nbsp;
						  <?php echo $ulasan["jml"]; ?> Ulasan
						</p>

						<!--  -->
						<?php if($this->func->cekLogin() == true){ ?>
						<?php if($data->preorder == 0){ ?>
						<!--<div class="p-t-10 p-b-10 p-l-10 p-r-20 m-b-16 m-t-16" style="border-radius:6px;background-color:#dcdde1;color:#c0392b;position:relative;align-items:middle;">
							<span onclick="$(this).parent().hide();" class="pointer" style="position:absolute;right:10px;"><i class="fa fa-times"></i></span>
							Sebelum membeli pastikan terlebih dahulu ketersediaan stok.
						</div>-->
						<?php } ?>
						<?php
							if($dbv->num_rows() == 0){ $totalstok = $data->stok; }
							if($data->preorder > 0){
								$this->db->where("idproduk",$data->id);
								$t = $this->db->get("preorder");
								$totalorder = 0;
								foreach($t->result() as $r){
									$totalorder += $r->jumlah;
								}
								$totalstok = $totalstok - $totalorder;
							}
							
							if($totalstok > 0){
						?>
						<form id="keranjang">
						  <input type="hidden" name="idproduk" value="<?php echo $data->id; ?>" />
						  <input type="hidden" id="variasi" name="variasi" value="0" />
						  <input type="hidden" id="harga" name="harga" value="<?=$result?>" />
							<div class="p-t-33">
								<div class="flex-w p-b-10">
									<?php
										if($dbv->num_rows() > 0){
											$warnaid = array();
											$sizeid = array();
											foreach($dbv->result() as $var){
												$this->db->where("variasi",$var->id);
												$dbf = $this->db->get("preorder");
												$totalpre = 0;
												foreach($dbf->result() as $rf){
													$totalpre += $rf->jumlah;
												}
							
												//$warna[] = $this->func->getWarna($var->warna,"nama");
												$warnaid[] = $var->warna;
												$variasi[$var->warna][] = $var->id;
												$sizeid[$var->warna][] = $var->size;
												$har[$var->warna][] = $var->harga;
												$harreseller[$var->warna][] = $var->hargareseller;
												$haragen[$var->warna][] = $var->hargaagen;
												$haragensp[$var->warna][] = $var->hargaagensp;
												$hardistri[$var->warna][] = $var->hargadistri;
												if(isset($stoks[$var->warna])){
													$stoks[$var->warna] += ($data->preorder == 0) ? $var->stok : $var->stok - $totalpre;
												}else{
													$stoks[$var->warna] = ($data->preorder == 0) ? $var->stok : $var->stok - $totalpre;
												}
												$stok[$var->warna][] = ($data->preorder == 0) ? $var->stok : $var->stok - $totalpre;
												//$size[$var->warna][] = $this->func->getSize($var->size,"nama");
											}
											$warnaid = array_unique($warnaid);
											$warnaid = array_values($warnaid);
											//$sizeid = array_unique($sizeid);
											//$sizeid = array_values($sizeid);
									?>
									<div class="size-203 flex-l-m respon6">
									<?=$data->variasi?>
									</div>
									<div class="size-204 flex-w flex-m bor8 m-b-10">
										<select class="stext-111 cl2 plh3 p-l-20 p-r-20 p-t-10 p-b-10 w-full" id="warna" required >
											<option value="">= Pilih <?=$data->variasi?> =</option>
											<?php
												for($i=0; $i<count($warnaid); $i++){
													if($stoks[$warnaid[$i]] > 0){
														echo "<option value='".$warnaid[$i]."'>".$this->func->getWarna($warnaid[$i],"nama")."</option>";
													}
												}
											?>
										</select>
									</div>
									<div class="size-203 flex-l-m respon6">
										<?=$data->subvariasi?>
									</div>
									<div class="size-204 flex-w flex-m bor8 m-b-10">
										<select class="stext-111 cl2 plh3 p-l-20 p-r-20 p-t-10 p-b-10 w-full" id="size" required >
											<option value="">= Pilih <?=$data->variasi?> dulu =</option>
										</select>
									</div>
									<?php
										}
									?>
									<div class="size-203 flex-l-m respon6">
										Jumlah
									</div>
									<div class="size-204 flex-w flex-m respon6-next m-b-10">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 fa fa-minus"></i>
											</div>
											
											<input class="mtext-104 cl3 text-center num-product" type="number" min="<?php echo $data->minorder; ?>" name="jumlah" value="<?php echo $data->minorder; ?>" id="jumlahorder" required>
											
											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 fa fa-plus"></i>
											</div>
										</div>
										<div id="stokrefresh"></div>
									</div>
									<div class="size-203 flex-l-m respon6">
										Catatan
									</div>
									<div class="size-204 flex-w flex-m bor8 m-b-10">
										<input class="stext-111 cl2 plh3 p-l-20 p-r-20 p-t-10 p-b-10" type="text" name="keterangan" value="">
									</div>

									<div class="size-203 flex-l-m respon6"></div>
									<div class="size-204 flex-w flex-m respon6-next m-t-20">
										<button type="submit" id="submit" class="flex-c-m size1 bg-1 bo-rad-23 hov1 s-text1 trans-0-4">
											<?=$textorder?>
										</button>
										<a href="https://wa.me/<?=$this->func->getRandomWasap()?>/?text=Halo,%20saya%20ingin%20membeli%20produk%20*<?=$data->nama?>*%20apakah%20masih%20tersedia?" class="flex-c-m size1 btn-success bo-rad-23 hov1 s-text1 trans-0-4 m-t-10">
											<i class="fa fa-whatsapp"></i> &nbsp;Beli via Whatsapp
										</a>
										<span id="proses" class="cl1" style="display:none;"><b><i class="fa fa-spin fa-spinner"></i> Memproses pesanan</b></span>
										<span id="gagal" class="cl1 m-t-20" style="display:none;"><i class="fa fa-exclamation-triangle"></i> Gagal memproses pesanan.</span>
									</div>
								</div>
							</div>
						</form>
						<?php }else{ ?>
						<div class="p-t-10 p-b-10 p-l-10 p-r-20 m-b-16 m-t-16" style="border-radius:6px;background-color:#dcdde1;color:#c0392b;position:relative;align-items:middle;">
							<?php if($data->preorder == 0){ ?>
								Maaf, Stok telah habis
							<?php }else{ ?>
								Maaf, Kuota Pre Order sudah penuh
							<?php } ?>
						</div>
						<?php } ?>
					<?php }else{ ?>
						<div class="size-204 flex-w flex-m respon6-next m-t-20 text-right">
							<a href="<?php echo site_url("home/signin"); ?>" class="flex-c-m size1 bg-1 bo-rad-23 hov1 s-text1 trans-0-4">
								beli produk
							</a>
							<a href="https://wa.me/<?=$this->func->getRandomWasap()?>/?text=Halo,%20saya%20ingin%20membeli%20produk%20*<?=$data->nama?>*%20apakah%20masih%20tersedia?" class="flex-c-m size1 btn-success bo-rad-23 hov1 s-text1 trans-0-4 m-t-10">
								<i class="fa fa-whatsapp"></i> &nbsp;Beli via Whatsapp
							</a>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>

			<div class="m-t-50 p-t-43 p-b-40 row">
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content col-md-8">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Deskripsi
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23">
						<p class="s-text8">
							<?=$data->deskripsi?>
						</p>
					</div>
				</div>
				<div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content col-md-4">
					<h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
						Ulasan Pembeli
						<i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
						<i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
					</h5>

					<div class="dropdown-content dis-none p-t-15 p-b-23 p-lr-14">
						<p class="s-text8">
							<?php
								$this->db->where("idproduk",$data->id);
								$this->db->limit(8);
								$this->db->order_by("nilai,id DESC");
								$re = $this->db->get("review");
								if($re->num_rows() > 0){
									foreach($re->result() as $rev){
										$staron = "<i class='fa fa-star text-warning'></i>";
										$staroff = "<i class='fa fa-star text-secondary'></i>";
										$star = "";
										for($i=1; $i<=5; $i++){
											$star .= ($i <= $rev->nilai) ? $staron : $staroff;
										}
										echo "
											<div class='ulasan row m-b-16'>
												<div class='col-8 title'>".$this->func->getProfil($rev->usrid,"nama","usrid")."</div>
												<div class='col-4 title'>".$this->func->ubahTgl("d/m/Y",$rev->tgl)."</div>
												<div class='col-12 m-t-4'>".$star."</div>
												<div class='col-12 m-t-10 keterangan'>
												".$rev->keterangan."
												</div>
											</div>
										";
									}
								}else{
									echo "<i>Belum ada ulasan.</i>";
								}
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- Related Products -->
	<section class="sec-relate-product p-t-45 p-b-105">
		<div class="container">
			<div class="p-b-45">
				<h3 class="ltext-106 cl5 txt-center">
					Produk Terkait
				</h3>
			</div>

			<!-- Slide2 -->
			<div class="wrap-slick2">
				<div class="slick2">
          <?php
            $this->db->where("idcat",$kategori->id);
            $this->db->where("id!=",$data->id);
            $this->db->limit(12);
            $this->db->order_by("id","RANDOM");
            $dbs = $this->db->get("produk");
            foreach($dbs->result() as $re){
				$level = isset($_SESSION["lvl"]) ? $_SESSION["lvl"] : 0;
				if($level == 5){
					$result = $re->hargadistri;
				}elseif($level == 4){
					$result = $re->hargaagensp;
				}elseif($level == 3){
					$result = $re->hargaagen;
				}elseif($level == 2){
					$result = $re->hargareseller;
				}else{
					$result = $re->harga;
				}
				$ulasan = $this->func->getReviewProduk($re->id);

				$this->db->where("idproduk",$re->id);
				$dbv = $this->db->get("produkvariasi");
				$totalstok = ($dbv->num_rows() > 0) ? 0 : $re->stok;
				$hargs = 0;
				$harga = array();
				foreach($dbv->result() as $rv){
					$totalstok += $rv->stok;
					if($level == 5){
						$harga[] = $rv->hargadistri;
					}elseif($level == 4){
						$harga[] = $rv->hargaagensp;
					}elseif($level == 3){
						$harga[] = $rv->hargaagen;
					}elseif($level == 2){
						$harga[] = $rv->hargareseller;
					}else{
						$harga[] = $rv->harga;
					}
					$hargs += $rv->harga;
				}
          ?>
					<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic img-product hov-img0 pointer" onclick="window.location.href='<?php echo site_url('produk/'.$re->url); ?>'" style="background-image: url('<?php echo $this->func->getFoto($re->id,'utama'); ?>');">
							</div>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href="<?php echo site_url('produk/'.$re->url); ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?php echo $re->nama; ?>
									</a>

									<span class="stext-105 color1">
										<?php 
											if($hargs > 0){
												echo "Rp. ".$this->func->formUang(min($harga))." - ".$this->func->formUang(max($harga));
											}else{
												echo "Rp. ".$this->func->formUang($result);
											}
										?>
									</span>
								</div>
							</div>
						</div>
					</div>
          <?php } ?>

				</div>
			</div>
		</div>
	</section>

  <script>
	$(function(){
		$("#keranjang").on("submit",function(e){
			e.preventDefault();
			$("#submit").hide();
			$("#proses").show();
			<?php if($data->preorder == 0){ ?>
				$.post("<?php echo site_url("assync/prosesbeli"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					$("#proses").hide();
					$("#submit").show();
					if(data.success == true){
						fbq('track', 'AddToCart', {content_ids:"<?=$data->id?>",content_type:"<?=$kategorinama?>",content_name:"<?=$data->nama?>",currency: "IDR", value: data.total});
						var nameProduct = $('#js-name-detail').html();
						swal(nameProduct, "berhasil ditambahkan ke keranjang", "success").then((value) => {
							window.location.href = "<?php echo site_url("home/keranjang"); ?>";
						});
					}else{
						swal("Gagal", "tidak dapat memproses pesanan \n "+data.msg, "error");
					}
				});
			<?php }else{ ?>
				$.post("<?php echo site_url("assync/prosespreorder"); ?>",$(this).serialize(),function(msg){
					var data = eval("("+msg+")");
					$("#proses").hide();
					$("#submit").show();
					if(data.success == true){
						fbq('track', 'AddToCart', {content_ids:"<?=$data->id?>",content_type:"<?=$kategori->nama?>",content_name:"<?=$data->nama?>",currency: "IDR", value: data.total});
						var nameProduct = $('#js-name-detail').html();
						swal(nameProduct, "berhasil mengikuti preorder", "success").then((value) => {
							window.location.href = "<?php echo site_url("home/invoicepreorder"); ?>?inv="+data.inv;
						});
					}else{
						swal("Gagal", "tidak dapat memproses pesanan", "error");
					}
				});
			<?php } ?>
		});

		$("#jumlahorder").change(function(){
			if(parseInt($(this).val()) < parseInt($(this).attr("min"))){
				$(this).val($(this).attr("min")).trigger("change");
			}
			
			if(parseInt($(this).val()) > parseInt($(this).attr("max"))){
				$(this).val($(this).attr("max")).trigger("change");
			}
		});

		$("#tambahdiskusi").on("submit",function(e){
			e.preventDefault();
			$("textarea",this).prop("readonly",true);
			$.post("<?php echo site_url("assync/tambahdiskusi"); ?>",$(this).serialize(),function(msg){
			var data = eval("("+msg+")");
			if(data.success == true){
						swal("Berhasil!", "pertanyaan Anda sudah disimpan", "success").then((value) => {
						  location.reload();
						});
			}else{

			}
		  });
		});
		
		$("#warna").on("change",function(){
			if($(this).val() != ""){
				$("#size").html($("#warna_"+$(this).val()).html());
			}else{
				$("#size").html("<option value=\"\">= Pilih <?=$data->variasi?> dulu =</option>");
			}
			$("#stokrefresh").html("");
		});
		$("#size").on("change",function(){
			$("#variasi").val($(this).find(":selected").data('variasi'));
			$("#jumlahorder").attr("max",$(this).find(":selected").data('stok'));
			$("#stokmaks").html($(this).find(":selected").data('stok'));
			$("#harga").val($(this).find(":selected").data('harga'));
			$("#hargacetak").html("Rp. "+formUang($(this).find(":selected").data('harga')));
			$("#stokrefresh").html("stok: "+$(this).find(":selected").data('stok'));
		});
	});
  </script>
  
  <div style="display:none;">
	<?php
		for($i=0; $i<count($warnaid); $i++){
			echo "
				<div id='warna_".$warnaid[$i]."'>
					<option value=''>= Pilih ".$data->subvariasi." =</option>
			";
			for($a=0; $a<count($sizeid[$warnaid[$i]]); $a++){
				if($stok[$warnaid[$i]][$a] > 0){
					if($level == 5){
						$result = $hardistri[$warnaid[$i]][$a];
					}elseif($level == 4){
						$result = $haragensp[$warnaid[$i]][$a];
					}elseif($level == 3){
						$result = $haragen[$warnaid[$i]][$a];
					}elseif($level == 2){
						$result = $harreseller[$warnaid[$i]][$a];
					}else{
						$result = $har[$warnaid[$i]][$a];
					}
					echo "<option value='".$sizeid[$warnaid[$i]][$a]."' data-stok='".$stok[$warnaid[$i]][$a]."' data-harga='".$result."' data-variasi='".$variasi[$warnaid[$i]][$a]."'>".$this->func->getSize($sizeid[$warnaid[$i]][$a],"nama")."</option>";
				}
			}
			echo "
				</div>
			";
		}
	?>
  </div>
