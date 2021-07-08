<?php if($this->func->cekLogin() == 1){ ?>
	<a href="<?php echo site_url("home/signout"); ?>">
		<li class="btn btn-link"><span class="fa fa-sign-out"></span> Keluar</li>
	</a>
<?php }elseif($this->func->cekLogin() == 2){ ?>
	<li class="parent"><span class="fa fa-bell"></span> Notifikasi
		<ul class="child">
			<li class="submenu">
				<a href="<?php echo site_url("manage/kotakmasuk"); ?>"><span class="fa fa-comments"></span> Pesan</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/diskusi"); ?>"><span class="fa fa-exchange-alt"></span> Diskusi Produk</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/ulasan"); ?>"><span class="fa fa-star"></span> Review</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/layanan"); ?>"><span class="fa fa-users"></span> Cust. Service</a>
			</li>
			<li class="title">Pembelian</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/pesanan"); ?>"><span class="fa fa-history"></span> Status Pesanan</a>
			</li>
		</ul>
	</li>
	<?php if($_SESSION["idtoko"] > 0){ ?>
	<li class="parent"><span class="fa fa-shopping-bag"></span> Toko
		<ul class="child">
			<li class="submenu">
				<a href="<?php echo site_url("toko/".$this->func->getToko($_SESSION["idtoko"],"url")); ?>"><span class="fa fa-warehouse"></span> Toko Saya</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/tambahproduk"); ?>"><span class="fa fa-box"></span> Tambah Produk</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/penjualan"); ?>"><span class="fa fa-shopping-basket"></span> Penjualan</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/produk"); ?>"><span class="fa fa-boxes"></span> Daftar Produk</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/pengaturantoko"); ?>"><span class="fa fa-cogs"></span> Pengaturan</a>
			</li>
		</ul>
	</li>
	<?php } ?>
	<li class="parent"><span class="fa fa-user-circle"></span> Akun
		<ul class="child">
			<li class="saldo submenu">
				<a class="tsaldo" href="<?php echo site_url("manage/saldo"); ?>">
					<small>Saldo warga</small><br/>
					<b>Rp. <?php echo $this->func->formUang($this->func->getSaldo($_SESSION["usrid"],"saldo","usrid")); ?></b>
				</a>
			</li>
			<li class="submenu">
				<hr/>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("manage/profil"); ?>"><span class="fa fa-user"></span> Pengaturan</a>
			</li>
			<li class="submenu">
				<a href="<?php echo site_url("home/signout"); ?>"><span class="fa fa-sign-out-alt"></span> Keluar</a>
			</li>
		</ul>
	</li>
<?php }else{ ?>
	<a href="<?php echo site_url("home/signup"); ?>">
		<li class="btn btn-link"><span class="fa fa-send"></span> Daftar</li>
	</a>
	<a href="<?php echo site_url("home/signin"); ?>">
		<li class="btn btn-link"><span class="fa fa-sign-in-alt"></span> Masuk</li>
	</a>
<?php } ?>