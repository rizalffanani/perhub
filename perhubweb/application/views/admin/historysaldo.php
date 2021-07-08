<?php
  if($saldo->num_rows() > 0){
?>
  <div class="wrap-table-alamat">
    <table class="table-alamat table-responsive">
        <tr class="table_head">
            <th class="p-l-20 text-left">Tanggal</th>
            <th class="">Deskripsi</th>
            <th class="text-left">Status</th>
            <th class="">Jumlah</th>
            <th class="">Saldo Akhir</th>
        </tr>
        <?php
          foreach($saldo->result() as $res){
            $old = ($res->darike != 2) ? "[invoice]" : "[rekening]";
            switch($res->darike){
              case '1':
                $new = $this->func->getTransaksi($res->sambung,"orderid");
              break;
              case '2':
                $new = $this->func->getSaldotarik($res->sambung,"idrek");
                $new = $this->func->getRekening($new,"semua");
                $bank = $this->func->getBank($new->idbank,"nama");
                $new = $bank." a/n ".$new->atasnama." (".$new->norek.")";
              break;
              case '3':
                $new = $this->func->getBayar($res->sambung,"invoice");
              break;
              case '4':
                $new = $this->func->getTransaksi($res->sambung,"orderid");
              break;
              default:
                $new = "";
              break;
            }
            $status = ($res->darike == 2) ? $this->func->getSaldotarik($res->sambung,"status") : 1;
            $status = ($status == 1) ? "<span style='color:#27ae60'>Berhasil</span>" : "<span style='color:#c0392b'>Sedang Diproses</span>";
            $jumlah = $this->func->formUang($res->jumlah);
            $jumlah = ($res->darike != 2 AND $res->darike != 3) ? "<span style='color:#27ae60'>Rp ".$jumlah."</span>" : "<span style='color:#c0392b'>Rp ".$jumlah."</span>";
        ?>
        <tr class="table_row">
            <td class="p-l-20 text-left">
                <p><?php echo $this->func->ubahTgl("d M Y H:i",$res->tgl); ?></p>
            </td>
            <td style="width:36%;">
                <p><?php echo str_replace($old,$new,$this->func->getSaldodarike($res->darike,"keterangan")); ?></p>
            </td>
            <td class="text-left">
                <?php echo $status; ?>
            </td>
            <td>
                <p><?php echo $jumlah; ?></p>
            </td>
            <td>
                <p>Rp <?php echo $this->func->formUang($res->saldoakhir); ?></p>
            </td>
        </tr>
        <?php
          }
        ?>
    </table>
  </div>
<?php
    echo $this->func->createPagination($rows,$page,$perpage,"historySaldo");
  }else{
    echo "<div class='w-full txt-center'><h5>BELUM ADA TRANSAKSI</h5></div>";
  }
?>
