
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-color1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Detail Pesanan
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
	<form class="p-b-85">
    <div class="container p-t-50 p-b-50" style="background: #f8f9fa1c;">
			<div class="row">
        <div class="col-md-7 m-lr-auto m-b-30">
          <div class="bg0 bor10 p-lr-40 p-t-20 p-b-20 m-lr-0-xl p-lr-15-sm">
          	<h4 class="mtext-109 color1 p-b-10">
              Order ID <span class="cl2"><?php echo $transaksi->orderid; ?></span>
            </h4>
            <div class="row">
              <div class="col-md-6 status-pesanan p-b-10 p-t-10">
                <p class="m-b-10">
                  Waktu Pemesanan:<br/>
                  <i><?php echo $this->func->ubahTgl("d M Y H:i",$transaksi->tgl); ?> WIB</i>
                </p>
                <p class="">
                  Waktu Pembayaran:<br/>
                  <i><?php echo $this->func->ubahTgl("d M Y H:i",$bayar->tgl); ?> WIB</i>
                </p>
              </div>
              <div class="col-md-6 p-b-10 p-t-10">
				<?php if($transaksi->status == 0){ ?>
					<!-- Belum Dibayar -->
					<p class="mtext-101 m-b-10 text-box-dibayar text-center">Belum Dibayar</p>
					<p class="m-b-5">segera lakukan pembayaran maks. 1x24jam untuk menghindari pembatalan otomatis.</p>
				<?php }elseif($transaksi->status == 1){ ?>
                  <!-- Dalam Pengiriman -->
                  <p class="mtext-101 m-b-10 text-box-dikirim text-center">Menunggu Konfirmasi</p>
					<p class="m-b-5">menunggu konfirmasi pesanan dari penjual.</p>
				<?php }elseif($transaksi->status == 2 AND $transaksi->resi != ""){ ?>
                  <!-- Dalam Pengiriman -->
                  <p class="mtext-101 m-b-10 text-box-dikirim text-center">Sedang Dikirim</p>
					<p class="m-b-5">pesanan Anda sudah dalam perjalanan, untuk melihat proses pengiriman silahkan cek info dibawah.</p>
				<?php }elseif($transaksi->status == 2){ ?>
                  <!-- Sedang Dikemas -->
                  <p class="mtext-101 m-b-10 text-box-dikemas text-center">Sedang Dikemas</p>
					<p class="m-b-5">pesanan sedang dikemas oleh penjual dan akan segera dikirim.</p>
				<?php }elseif($transaksi->status == 3){ ?>
                  <!-- Selesai -->
                  <p class="mtext-101 m-b-10 text-box-diterima text-center">Telah Diterima</p>
					<p class="m-b-5">pesanan telah diterima oleh pembeli.</p>
				<?php }elseif($transaksi->status == 4){ ?>
                  <!-- Selesai -->
                  <p class="mtext-101 m-b-10 text-box-diterima text-center" style="background:#c0392b;">Pesanan Dibatalkan</p>
					<p class="m-b-5">pesanan dibatalkan karena <?php echo $transaksi->keterangan; ?></p>
				<?php } ?>
              </div>
            </div>
          </div>
        </div>
			</div>

			<div class="row">
				<div class="col-md-7 m-lr-auto m-b-30">
					<div class="bg0 bor10 p-lr-40 p-t-30 p-b-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 color1 p-b-20">
							Informasi Pengiriman
							<?php
								$alamat = $this->func->getAlamat($transaksi->alamat,"semua");
								$kec = $this->func->getKec($alamat->idkec,"semua");
								$kab = $this->func->getKab($kec->idkab,"nama");
							?>
						</h4>

						<div class="p-b-13">
							<div class="row p-t-20 p-b-10">
								<div class="col-md-6">
									<h5 class="text-black p-b-10">KURIR & PAKET</h5>
									<p>
										<?php
											echo strtoupper($this->func->getKurir($transaksi->kurir,"nama","rajaongkir"))."<br/>".$this->func->getPaket($transaksi->paket,"nama","rajaongkir");
										?>
									</p>
								</div>
								<div class="col-md-6">
									<h5 class="text-black p-b-10">RESI PENGIRIMAN</h5>
									<p><b class="color1"><?php echo $transaksi->resi; ?></b></p>
								</div>
							</div>
							<hr/>
							<div class="row p-t-20">
								<div class="col-md-6">
									<h5 class="text-black p-b-10">Nama Penerima</h5>
									<p><?php echo strtoupper(strtolower($alamat->nama)); ?></p>
								</div>
								<div class="col-md-6">
									<h5 class="text-black p-b-10">No Telepon</h5>
									<p><?php echo $alamat->nohp; ?></p>
								</div>
							</div>
							<div class="row p-t-20">
								<div class="col-md-12">
									<h5 class="text-black p-b-10">Alamat Pengiriman</h5>
									<p>
										<?php echo strtoupper(strtolower($alamat->alamat)); ?><br>
										<?php echo $kec->nama.", ".$kab; ?><br>
										Kodepos <?php echo $alamat->kodepos; ?>
									</p>
								</div>
							</div>
						</div>
						<?php if($transaksi->resi != "" AND $transaksi->kurir != "cod" AND $transaksi->kurir != "toko"){ ?>
						<hr class="m-t-30"/>
						<a href="<?php echo site_url("manage/lacakpaket/".$transaksi->orderid); ?>" class="color1 txt-center w-full dis-block"><i class="fa fa-truck"></i> &nbsp;<b>CEK STATUS PENGIRIMAN</b></a>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 m-lr-auto m-b-30">
					<div class="bg0 bor10 p-lr-40 p-t-30 p-b-40 m-lr-0-xl">
						<h4 class="mtext-109 color1 p-b-30">
							Produk Pesanan
						</h4>
						<div class="m-l-25 m-r--38 m-lr-0-xl">
							<?php
									$this->db->where("idtransaksi",$transaksi->id);
									$db = $this->db->get("transaksiproduk");
									$total = 0;
									foreach($db->result() as $res){
										$total += $res->harga * $res->jumlah;
										$produk = $this->func->getProduk($res->idproduk,"semua");
										$variasee = $this->func->getVariasi($res->variasi,"semua");
										$variasi = ($res->variasi != 0) ? $this->func->getWarna($variasee->warna,"nama")." ".$produk->subvariasi." ".$this->func->getSize($variasee->size,"nama") : "";
										$variasi = ($res->variasi != 0) ? "<br/><small class='text-primary'>".$produk->variasi.": ".$variasi."</small>" : "";
							?>
							<div class="row p-b-30 p-r-10">
								<div class="col-md-2">
									<div class="how-itemcart1">
										<img src="<?php echo $this->func->getFoto($res->idproduk,"utama"); ?>" alt="IMG">
									</div>
								</div>
								<div class="col-md-6">
									<p class="mtext-102"><?php echo $produk->nama; ?></p>
									<?php echo $variasi; ?>
								</div>
								<div class="col-md-4 text-right p-r-40">
									<p>Rp <?php echo $this->func->formUang($res->harga); ?> <span style="font-size:11px">x<?php echo $res->jumlah; ?></span></p>
								</div>
							</div>
							<?php
									}
							?>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<p>Subtotal</p>
							</div>
							<div class="col-md-6">
								<p style="text-align: right">Rp <?php echo $this->func->formUang($total); ?></p>
							</div>
						</div>
						<?php
							$totaltext = "Total";
						?>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<p>Ongkos Kirim</p>
							</div>
							<div class="col-md-6">
								<p style="text-align: right">Rp <?php echo $this->func->formUang($transaksi->ongkir); $total += $transaksi->ongkir; ?></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-6">
								<h5 class="mtext-102 text-black"><?php echo $totaltext; ?></h5>
							</div>
							<div class="col-md-6">
								<h5 class="mtext-102 text-black text-right">Rp <?php echo $this->func->formUang($total); ?></h5>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</form>
