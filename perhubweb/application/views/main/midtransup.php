<div id="tokenGenerated"></div>


<?php $set = $this->func->getSetting("semua"); ?>
<script type="text/javascript" src="<?=$set->midtrans_snap?>" data-client-key="<?=$set->midtrans_client?>"></script>
<script type="text/javascript">
	$(function(){
		/*$.post("<?=site_url("home/midtranstoken")?>",{"invoice":<//?=$data->invoice?>},function(data,status){
			if(status == 'success'){
				$("#tokenGenerated").html(data);
			}else{
				swal("Sudah diproses","Pembayaran sudah diproses","success").then(res=>{
					window.location.href = "<?=site_url("manage/pesanan")?>";
				});
			}
		});*/

		$.ajax({
			type: "POST",
			url:  "<?=site_url("home/midtranstoken")?>",
			data: {"invoice":"<?=$data->invoice?>"},
			statusCode: {
				200: function(responseObject, textStatus, jqXHR) {
					$("#tokenGenerated").html(responseObject);
                    payMidtrans();
				},
				404: function(responseObject, textStatus, jqXHR) {
					swal("Sudah diproses","Pembayaran sudah diproses","success").then(res=>{
						window.location.href = "<?=site_url("home/midtransmobile/".$data->id."?revoke=true")?>";
					});
				},
				500: function(responseObject, textStatus, jqXHR) {
					swal("Sudah diproses","Pembayaran sudah diproses","success").then(res=>{
						window.location.href = "<?=site_url("home/midtransmobile/".$data->id."?revoke=true")?>";
					});
				}
			}
		});

	});

	function payMidtrans(){
		snap.pay($("#tokenGenerated").html(), {
			onSuccess: function(result){
				//confirm(result.transaction_id);
				var url = "<?=site_url("home/midtranspay")?>?order_id=<?=$data->invoice?>&status=success&mobile=true&transaction_id="+result.transaction_id;
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", url);
				//form.setAttribute("target", "_blank");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("name", "response");
				hiddenField.setAttribute("value", JSON.stringify(result));
				form.appendChild(hiddenField);

				document.body.appendChild(form);
				form.submit();
				console.log(result);
			},
			onPending: function(result){
				//confirm("Pending: "+result.transaction_id);
				/* You may add your own implementation here */
				//alert("wating your payment!"); 
				var url = "<?=site_url("home/midtranspay")?>?order_id=<?=$data->invoice?>&status=pending&mobile=true&transaction_id="+result.transaction_id;
				var form = document.createElement("form");
				form.setAttribute("method", "post");
				form.setAttribute("action", url);
				//form.setAttribute("target", "_blank");
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("name", "response");
				hiddenField.setAttribute("value", JSON.stringify(result));
				form.appendChild(hiddenField);

				document.body.appendChild(form);
				form.submit();
				console.log(result);
			},
			onError: function(result){
				window.location.href = "<?=site_url("home/ipaymusuccess")?>";
			},
			onClose: function(){
				window.location.href = "<?=site_url("home/ipaymusuccess")?>";
			}
		}); 
	}
</script>