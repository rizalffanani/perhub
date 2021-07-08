
  <!-- breadcrumb -->
  <div class="container">
    <div class="bread-crumb flex-w p-l-15 p-r-15 p-t-30 p-lr-0-lg">
      <a href="<?php echo site_url(); ?>" class="stext-109 cl8 hov-cl1 trans-04">
        Home
        <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
      </a>

      <span class="stext-109 cl4">
        Ulasan Produk
      </span>
    </div>
  </div>


  <!-- Shoping Cart -->
    <div class="container">
      <div class="row m-lr-0 m-b-50">
        <div class="col-md-12 m-lr-auto">
          <div class="p-t-30 m-lr-0-xl p-lr-0-sm">
            <h4 class="mtext-109 cl2 p-b-30">
              Ulasan Produk Pesanan
            </h4>
          </div>
        </div>

        <?php
          $order = $this->func->getTransaksi($orderid,"semua","orderid");
          $this->db->where("idtransaksi",$order->id);
          $db = $this->db->get("review");

          if($db->num_rows() > 0){
        ?>
          <div class="m-b-60 p-lr-0-sm w-full row m-lr-0">
            <?php
              foreach($db->result() as $r){
                $produk = $this->func->getProduk($r->idproduk,"semua");
            ?>
              <div class="col-md-6 m-b-10">
                <div class="bor10 p-lr-40 p-t-30 p-b-25 m-lr-0-xl p-lr-15-sm">
                  <div class="p-tb-10 row m-lr-0">
                    <div class="col-3" style="min-height:80px;">
                      <img style="max-width:100%;max-height:80px;" src="<?php echo $this->func->getFoto($produk->id,"utama"); ?>" />
                    </div>
                    <div class="col-9">
                      <b class="pointer" onclick="location.href='<?php echo site_url('produk/'.$produk->url); ?>'"><?php echo $produk->nama; ?></b><br/>
                      <span class="fs-18 cl11 pointer m-lr-auto" style="font-size:150%;">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star <?php if($r->nilai < 2){ echo "text-secondary"; } ?>"></i>
                        <i class="fa fa-star <?php if($r->nilai < 3){ echo "text-secondary"; } ?>"></i>
                        <i class="fa fa-star <?php if($r->nilai < 4){ echo "text-secondary"; } ?>"></i>
                        <i class="fa fa-star <?php if($r->nilai < 5){ echo "text-secondary"; } ?>"></i>
                      </span>
                      <small style="display:block;margin-top:-5px;">
                        <?php
                          switch($r->nilai){
                            case 1: echo "(produk sangat buruk)";
                            break;
                            case 2: echo "(produk kurang baik)";
                            break;
                            case 3: echo "(produk standar)";
                            break;
                            case 4: echo "(produk baik)";
                            break;
                            case 5: echo "(produk sangat baik)";
                            break;
                          }
                          echo "<br/>";
                          echo $this->func->ubahTgl("d M Y H:i",$r->tgl);
                        ?>
                      </small>
                    </div>
                  </div>
                  <?php if($r->keterangan != ""){ ?>
                  <div class="row">
                    <div class="col-12 p-b-5">
                      <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" readonly><?php echo $r->keterangan; ?></textarea>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            <?php
              }
            ?>
          </div>
        <?php
          }else{
            if($_SESSION["usrid"] != $order->usrid){
        ?>
          <div class="m-b-60 p-lr-0-sm w-full">
            <h5 class="p-lr-14 cl1">Pembeli belum memberikan ulasan untuk pesanan ini</h5>
          </div>
        <?php
            }else{
        ?>
        <div class="m-b-60 p-lr-0-sm w-full">
          <form class="row m-lr-0" id="addreview">
            <?php
                $this->db->where("idtransaksi",$order->id);
                $db = $this->db->get("transaksiproduk");
                $no = 1;
                foreach($db->result() as $t){
                  $produk = $this->func->getProduk($t->idproduk,"semua");
            ?>
              <div class="col-md-6 m-b-10">
                <div class="bor10 p-lr-40 p-t-30 m-lr-0-xl p-lr-15-sm">
                  <input type="hidden" name="orderid[]" value="<?php echo $order->orderid; ?>" />
                  <input type="hidden" name="produk[]" value="<?php echo $t->idproduk; ?>" />
                  <div class="p-tb-10 row m-lr-0">
                    <div class="col-3" style="min-height:80px;">
                      <img style="max-width:100%;max-height:80px;" src="<?php echo $this->func->getFoto($produk->id,"utama"); ?>" />
                    </div>
                    <div class="col-9">
                      <b><?php echo $produk->nama; ?></b>
                    </div>
                  </div>
        					<div class="flex-w flex-m p-t-10 p-b-10" id="ulasan_<?=$t->id?>">
        						<span class="wrap-rating fs-18 cl11 pointer m-lr-auto" style="font-size:300%;">
        							<i class="item-rating pointer fa fa-star text-secondary nilai_1" onclick="nilai(<?=$t->id?>,1);$('#nilai_<?php echo $no; ?>').val(1);"></i>
        							<i class="item-rating pointer fa fa-star text-secondary nilai_2" onclick="nilai(<?=$t->id?>,2);$('#nilai_<?php echo $no; ?>').val(2);"></i>
        							<i class="item-rating pointer fa fa-star text-secondary nilai_3" onclick="nilai(<?=$t->id?>,3);$('#nilai_<?php echo $no; ?>').val(3);"></i>
        							<i class="item-rating pointer fa fa-star text-secondary nilai_4" onclick="nilai(<?=$t->id?>,4);$('#nilai_<?php echo $no; ?>').val(4);"></i>
        							<i class="item-rating pointer fa fa-star text-secondary nilai_5" onclick="nilai(<?=$t->id?>,5);$('#nilai_<?php echo $no; ?>').val(5);"></i>
        							<input type="hidden" class="nilai" id="nilai_<?php echo $no; ?>" name="nilai[]" value="0">
        						</span>
        					</div>
                  <div class="row p-b-25">
        						<div class="col-12 p-b-5">
        							<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="keterangan[]" placeholder="Beritahu penjual dan pengguna lain tentang kondisi produk ini"></textarea>
        						</div>
                  </div>
                </div>
              </div>
            <?php
                  $no++;
                }
            ?>
            <div class="bor10 w-full p-lr-40 p-t-30 m-lr-15 m-t-30 p-lr-15-sm">
              <div class="col-12 p-lr-20 m-b-30">
                <button type="submit" class="submit stext-101 cl0 size-107 bg1 hov-btn1 p-tb-10 p-lr-25 trans-04 m-tb-5">KIRIM ULASAN</button>
                <a href="javascript:history.back()" class="submit stext-101 cl0 size-107 bg5 hov-btn1 p-tb-10 p-lr-25 trans-04 m-tb-5">LAIN KALI</a>
                <h5 class="col1 loaders dis-none"><i class="fa fa-spin fa-circle-o-notch"></i> mengirim ulasan</h5>
              </div>
            </div>
          </form>
        </div>
        <?php
            }
          }
        ?>

      </div>
    </div>

    <script type="text/javascript">
      $(function(){
        $("#addreview").on("submit",function(e){
          e.preventDefault();
          $(".submit").hide();
          $(".loaders").show();

          var nonempty = $('.nilai').filter(function() {
            return this.value == '0';
          });

          if (nonempty.length == 0) {
            $.post("<?php echo site_url("assync/tambahulasan"); ?>",$(this).serialize(),function(msg){
              var data = eval("("+msg+")");
              if(data.success == true){
                swal("Berhasil!","berhasil mengirim ulasan","success").then((value)=>{
                  location.reload();
                });
              }else{
                swal("Gagal!","terjadi kendala pada saat mengirim ulasan, cobalah beberapa saat lagi","error");
                $(".submit").show();
                $(".loaders").hide();
              }
            });
          }else{
            swal("Gagal!","Semua produk harus diberi nilai","error").then((value)=>{
              $(".submit").show();
              $(".loaders").hide();
            })
          }
        });
      });

      function nilai(trx,num){
        for(i=1; i<=num; i++){
          $("#ulasan_"+trx+" .nilai_"+i).removeClass("text-secondary");
        }
        var nam = num+1;
        for(i=nam; i<=5; i++){
          $("#ulasan_"+trx+" .nilai_"+i).addClass("text-secondary");
        }
      }
    </script>
