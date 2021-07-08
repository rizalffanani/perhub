import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, Platform, NavController } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-bayarpesanan',
  templateUrl: './bayarpesanan.page.html',
  styleUrls: ['./bayarpesanan.page.scss'],
})
export class BayarpesananPage implements OnInit {
  id: string;
  total: any;
  rekening: any = [];
  jenis: any = 0;
  channel: any;
  kode: any;
  nama: any;
  idbayar: any;
  tipe: any;
  payment_transfer: any = 0;
  payment_ipaymu: any = 0;
  payment_midtrans: any = 0;
  midtrans_cek: any = null;

  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    private loadingCtrl: LoadingController,
    private activatedRoute: ActivatedRoute,
    private platform: Platform,
    private navCtrl: NavController
  ) { }

  ngOnInit() {
    this.platform.backButton.subscribeWithPriority(0,() => {
        // do nothing here
        //this.alert.presentToast("Terpijet");
        this.navCtrl.navigateBack("/tabs/tab3");
    });
  }

  async ionViewWillEnter(){
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    let loading = await this.loadingCtrl.create({
      message: 'tunggu sebentar',
      spinner: 'circular'
    });
    await loading.present();

    this.getapi.getBayarDetail(this.id).subscribe(res=>{
      loading.dismiss();
      if(res['data']){
        //this.jenis = (res['data']['ipaymu_tipe'] == "") ? 2 : 1;
        this.total = this.formUang(res['data']['total']);
        this.rekening = res['data']['rekening'];
        this.channel = res['data']['ipaymu_channel'];
        this.kode = res['data']['ipaymu_kode'];
        this.nama = res['data']['ipaymu_nama'];
        this.tipe = res['data']['ipaymu_tipe'];
        this.idbayar = res['data']['id'];
        this.payment_transfer = res['data']['payment_transfer'];
        this.payment_ipaymu = res['data']['payment_ipaymu'];
        this.payment_midtrans = res['data']['payment_midtrans'];
        this.midtrans_cek = res['data']['midtrans_cek'];
      }
    });
  }
  formUang(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return parts.join(".");
  }

  ubahPembayaran(){
    this.midtrans_cek = null;
  }

  otomatis(){
    this.jenis = 1;
  }
  manual(){
    this.jenis = 2;
  }

}
