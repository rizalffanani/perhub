<?php
	$page = (isset($_GET["page"]) AND $_GET["page"] != "") ? $_GET["page"] : 1;
	$orderby = (isset($_GET["orderby"]) AND $_GET["orderby"] != "") ? $_GET["orderby"] : "stok DESC, tglupdate DESC";
	$cari = (isset($_GET["cari"]) AND $_GET["cari"] != "") ? $_GET["cari"] : "";
	$perpage = 12;
?>
	<!-- Content page -->
	<section class="bgwhite p-t-55 p-b-65">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
					<div class="leftbar p-r-20 p-r-0-sm">
						<!--  -->
						<h4 class="m-text14 p-b-7">
							Kategori
						</h4>

						<ul class="p-b-54">
							<li class="p-t-4">
								<a href="<?=site_url("shop")?>" class="s-text13 active1">
									Semua Produk
								</a>
							</li>

							<?php 
								$idcat = $this->func->getKategori($url,"id","url");
								
								$this->db->where("parent",0);
								$db = $this->db->get("kategori");
								foreach($db->result() as $r){
									$select = ($r->id == $idcat) ? "font-weight-bold color1" : "";
							?>
							<li class="p-t-4">
								<a href="<?=site_url("kategori/".$r->url)?>" class="s-text13 <?=$select?>">
									<?=ucwords(strtolower($r->nama))?>
								</a>
							</li>
							<?php
								}
							?>
						</ul>

						<div class="search-product pos-relative bo4 of-hidden">
							<form action="" method="GET">
								<input class="s-text7 size6 p-l-23 p-r-50" type="text" name="cari" value="<?=$cari?>" placeholder="Cari Produk" required>

								<button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
									<i class="fs-12 fa fa-search" aria-hidden="true"></i>
								</button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
					<!-- 
					<div class="flex-sb-m flex-w p-b-35">
						<span class="s-text8 p-t-5 p-b-5">
							Showing 1–12 of 16 results
						</span>
					</div> -->

					<!-- Product -->
					<div class="row">
						<?php
							$this->db->select("SUM(stok),idproduk");
							$this->db->group_by("idproduk");
							$dbvar = $this->db->get("produkvariasi");
							$notin = array();
							foreach($dbvar->result() as $not){
								$notin[] = $not->idproduk;
							}

							$where = "(nama LIKE '%$cari%' OR harga LIKE '%$cari%' OR hargareseller LIKE '%$cari%' OR hargaagen LIKE '%$cari%' OR deskripsi LIKE '%$cari%') AND status = 1 AND idcat = ".$idcat;
							$this->db->where($where);
							if(count($notin) > 0){
								$this->db->where_not_in($notin);
							}
							$dbs = $this->db->get("produk");
							
							$this->db->where($where);
							if(count($notin) > 0){
								$this->db->where_not_in($notin);
							}
							$this->db->limit($perpage,($page-1)*$perpage);
							$this->db->order_by($orderby);
							$db = $this->db->get("produk");
							$totalproduk = 0;
							foreach($db->result() as $r){
								$level = isset($_SESSION["lvl"]) ? $_SESSION["lvl"] : 0;
								if($level == 5){
									$result = $r->hargadistri;
								}elseif($level == 4){
									$result = $r->hargaagensp;
								}elseif($level == 3){
									$result = $r->hargaagen;
								}elseif($level == 2){
									$result = $r->hargareseller;
								}else{
									$result = $r->harga;
								}
								$ulasan = $this->func->getReviewProduk($r->id);

								$this->db->where("idproduk",$r->id);
								$dbv = $this->db->get("produkvariasi");
								$totalstok = ($dbv->num_rows() > 0) ? 0 : $r->stok;
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

								if($totalstok > 0){
									$totalproduk += 1;
						?>
						<div class="col-6 col-md-6 col-lg-4 p-b-50" onclick="window.location.href='<?= site_url('produk/'.$r->url) ?>'">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-img wrap-pic-w of-hidden pos-relative block2-labelnew" style="background-image: url('<?=$this->func->getFoto($r->id,"utama")?>');">
									<!--<img src="<?=$this->func->getFoto($r->id,"utama")?>" alt="IMG-PRODUCT" style="object-fit:cover;">-->

									<div class="block2-overlay trans-0-4">
										<a href="#" class="block2-btn-addwishlist hov-pointer trans-0-4">
											<i class="icon-wishlist icon_heart_alt" aria-hidden="true"></i>
											<i class="icon-wishlist icon_heart dis-none" aria-hidden="true"></i>
										</a>

										<div class="block2-btn-addcart w-size1 trans-0-4">
											<!-- Button -->
											<button class="flex-c-m size1 bg-1 bo-rad-23 hov1 s-text1 trans-0-4">
												Details
											</button>
										</div>
									</div>
								</div>

								<div class="block2-txt p-t-20">
									<a href="<?= site_url('produk/'.$r->url) ?>" class="block2-name dis-block s-text3 p-b-5">
										<?=$r->nama?>
									</a>

									<span class="block2-price m-text6 p-r-5 color1">
										<?php 
											if($hargs > 0){
												echo "Rp. ".$this->func->formUang(min($harga))." - ".$this->func->formUang(max($harga));
											}else{
												echo "Rp. ".$this->func->formUang($result);
											}
										?>
									</span>
								</div>
								<div class="row">
									<div class='col-6'>
										<small><?=$ulasan['ulasan']?> Ulasan</small>
									</div>
									<div class='col-6 text-right'>
										<span class="badge badge-warning bdg-1"><i class='fa fa-star'></i> <?=$ulasan['nilai']?></span>
									</div>
								</div>
							</div>
						</div>
						<?php
								}
							}
							
							if($db->num_rows() == 0 OR $totalproduk == 0){
								echo "<div class='col-12 text-center m-tb-40'><h2><mark>Produk Kosong</mark></h2></div>";
							}
						?>
					</div>

					<!-- Pagination -->
					<div class="pagination flex-m flex-w p-t-26">
						<?php
							if($totalproduk > 0){
								echo $this->func->createPagination($dbs->num_rows(),$page,$perpage);
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script type="text/javascript">
		$(function(){
			
		});
		
		function refreshTabel(page){
			window.location.href="<?=site_url('kategori/'.$url)?>?page="+page;
		}
	</script>
