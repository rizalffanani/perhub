<div style="">
	<a class="float-right btn btn-primary" href="<?=site_url("ngadimin/editblog")?>"><i class="fas fa-plus-circle"></i> Postingan Baru</a>
	<h4 class="page-title">Postingan Blog</h4>
</div>


<div class="m-b-60">
	<div class="card">
		<div class="card-body" id="load">
			<i class="fas fa-spin fa-spinner"></i> Loading data...
		</div>
	</div>
</div>

<script type="text/javascript">

	$(function(){
		loadBlog(1);
		
		$(".tabs-item").on('click',function(){
			$(".tabs-item.active").removeClass("active");
			$(this).addClass("active");
		});
		
		$("#rekeningform").on("submit",function(e){
			e.preventDefault();
			swal.fire({
				text: "pastikan lagi data yang anda masukkan sudah sesuai",
				title: "Validasi data",
				type: "warning",
				showCancelButton: true,
				cancelButtonText: "Cek Lagi"
			}).then((vals)=>{
				if(vals.value){
					$.post("<?=site_url("api/updateblog")?>",$("#rekeningform").serialize(),function(msg){
						var data = eval("("+msg+")");
						if(data.success == true){
							loadBlog(1);
							$("#modal").modal("hide");
							swal.fire("Berhasil","data halaman sudah disimpan","success");
						}else{
							swal.fire("Gagal!","gagal menyimpan data, coba ulangi beberapa saat lagi","error");
						}
					});
				}
			});
		});
	});
	
	function loadBlog(page){
		$("#load").html('<i class="fas fa-spin fa-spinner"></i> Loading data...');
		$.post("<?=site_url("ngadimin/blog?load=hal&page=")?>"+page,{"cari":$("#cari").val()},function(msg){
			$("#load").html(msg);
		});
	}
	
	function hapus(pro){
		swal.fire({
			title: "Anda yakin menghapus?",
			text: "postingan yang sudah dihapus tidak dapat dikembalikan",
			type: "error",
  			showCancelButton: true,
  			cancelButtonColor: '#d33',
			cancelButtonText: "Batal",
			confirmButtonText: "Tetap Hapus"
		}).then((result)=>{
			if(result.value){
				$.post("<?php echo site_url('api/hapusblog'); ?>",{"id":pro},function(msg){
					var data = eval("("+msg+")");
					if(data.success == true){
						swal.fire("Berhasil!","Berhasil menghapus data","success").then((data) =>{
							location.reload();
						});
					}else{
						swal.fire("Gagal!","Gagal menghapus data, terjadi kesalahan sistem","error");
					}
				});
			}
		});
	}
</script>