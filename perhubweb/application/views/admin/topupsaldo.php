<?php
  if($saldo->num_rows() > 0){
      $namatoko = $this->func->getSetting("nama");
?>
  <div class="wrap-table-alamat">
    <table class="table-alamat table-responsive">
        <tr class="table_head">
            <th class="p-l-20 text-left">Tanggal</th>
            <th class="">Deskripsi</th>
            <th class="text-left">Status</th>
            <th class="">Jumlah</th>
            <th class="">Aksi</th>
        </tr>
        <?php
          foreach($saldo->result() as $res){
            $status = ($res->status == 1) ? "<span style='color:#27ae60'>berhasil</span>" : "<i style='color:#f39c12'>belum dibayar</i>";
            $status = ($res->status == 2) ? "<span style='color:#c0392b'>dibatalkan</span>" : $status;
            $jumlah = $this->func->formUang($res->total);
            $idbayar = $this->func->arrEnc(array("trxid"=>$res->trxid),"encode");
        ?>
        <tr class="table_row">
            <td class="p-l-20 text-left">
                <p><?php echo $this->func->ubahTgl("d M Y H:i",$res->tgl); ?></p>
            </td>
            <td>
              <?php if($res->ipaymu_tipe == ""){ ?>
                <p>TopUp Saldo <?=$namatoko?></p>
              <?php }else{ ?>
                <p>Channel <?=strtoupper(strtolower($res->ipaymu_channel)).": <b class='text-primary'>".$res->ipaymu_kode."</b>";?></p>
              <?php } ?>
            </td>
            <td class="text-left">
                <?php echo $status; ?>
            </td>
            <td>
                <p><?php echo $jumlah; ?></p>
            </td>
            <td>
                <?php if($res->status == 0){ ?>
                    <a href="<?=site_url("home/topupsaldo?inv=".$idbayar)?>" class="btn btn-sm btn-success" ><i class="fa fa-check-circle"></i> Bayar</a>&nbsp;
                    <a href="javascript:void(0)" onclick="batalTopup(<?=$res->id?>)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php
          }
        ?>
    </table>
  </div>
<?php
    echo $this->func->createPagination($rows,$page,$perpage,"getopupSaldo");
  }else{
    echo "<div class='w-full txt-center'><h5>BELUM ADA TRANSAKSI</h5></div>";
  }
?>
