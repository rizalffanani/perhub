<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>	
<div class="seksen-shadow"></div>
<div class="seksen">
	<div class="wrapper">
		<div class="divider"></div>
		<div class="subtitle">
			<b>STATUS PESANAN</b>
			<div class="line"></div>
		</div>
		<div class="divider"></div>
		<div class="search-filter">
			<li class="active">
				<a href="javascript:void(0);" id="belumbayar">
					<span class="hidesmall">Menunggu</span> Konfirmasi
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="proses">
					<span class="hidesmall">Sedang Diproses</span>
					<span class="showsmall">Proses</span>
				</a>
			</li>
			<li>
				<a href="javascript:void(0);" id="selesai">
					<span class="hidesmall">Pesanan</span> Selesai
				</a>
			</li>
		</div>
		<div id="load" class="main-content">
			<i class="fa fa-spin fa-spinner"></i> &nbsp;sedang memuat...
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function(){
		$("#load").load("<?php echo site_url("assync/pesanan?status=belumbayar"); ?>");
		
		$(".search-filter li").each(function(){
			$(this).click(function(){
				$("#load").html('<i class="fa fa-spin fa-spinner"></i> &nbsp;sedang memuat...');
				$(".search-filter .active").removeClass("active");
				$(this).addClass("active");
				var id = $("a",this).attr("id");
				$("#load").load("<?php echo site_url("assync/pesanan?status="); ?>"+id);
			});
		});
	});
</script>