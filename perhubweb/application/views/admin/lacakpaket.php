
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Lacak Paket Pengiriman
			</span>
		</div>
	</div>


	<!-- Shoping Cart -->
    <div class="container p-t-50 p-b-50" style="background: #f8f9fa1c;">
			<div class="row">
        <div class="col-md-10 m-lr-auto m-b-30">
          <div class="bg0 bor10 p-lr-40 p-t-20 p-b-20 m-lr-0-xl p-lr-15-sm">
          	<h4 class="mtext-109 cl1 p-b-10">
              Order ID <span class="cl2"><?php echo $orderid; ?></span>
            </h4>
            <div class="row">
              <div class="col-md-6 p-b-10 p-t-10">
                <p class="m-b-20">
                  Kurir Pengiriman:<br/>
                  <b class='badge badge-secondary' style="font-size:100%;"><?php echo strtoupper(strtolower($this->func->getKurir($transaksi->kurir,"nama","rajaongkir")." - ".$transaksi->paket)); ?></b>
                </p>
                <p class="m-b-10">
                  No Resi Pengiriman:<br/>
                  <b class="cl1" style="font-size:120%;"><?php echo strtoupper(strtolower($transaksi->resi)); ?></b>
                </p>
              </div>
              <div class="col-md-6 p-b-10 p-t-10">
                <p class="m-b-10">
                  Waktu Pengiriman:<br/>
                  <i class="cl1"><?php echo $this->func->ubahTgl("d M Y H:i",$transaksi->kirim); ?> WIB</i>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

  		<div class="row">
        <div class="col-md-10 m-lr-auto m-b-30">
          <div class="bg0 bor10 p-lr-40 p-tb-40 m-lr-0-xl p-lr-15-sm">
          	<h4 class="mtext-109 cl1 p-b-20">
              status pengiriman
            </h4>
            <div class="of-hidden" id="load">
              <i class="fa fa-spin fa-globe"></i> &nbsp;menghubungi ekspedisi, mohon tunggu sebentar...
            </div>
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
    $(function(){
      $("#load").load("<?php echo site_url("assync/lacakiriman?orderid=".$orderid); ?>");
    });
  </script>
