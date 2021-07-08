import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { LoadingController, NavController, ActionSheetController } from '@ionic/angular';
import { PostapiService } from 'src/app/services/postapi.service';
import { AlertService } from 'src/app/services/alert.service';

@Component({
  selector: 'app-alamat',
  templateUrl: './alamat.page.html',
  styleUrls: ['./alamat.page.scss'],
})
export class AlamatPage implements OnInit {
  hasil = [];
  page = 1;
  maximumPages = 3;
  alamat: string;

  constructor(
    private getapi:GetapiService,
    private navCtrl: NavController,
    private loading: LoadingController,
    private acs: ActionSheetController,
    private postapi: PostapiService,
    private alert: AlertService
  ) {
   // this.statusBar.backgroundColorByHexString('#2980b9');
  }

  ionViewWillEnter(){
    this.loadUsers();
  }
 
  async loadUsers(event?) {
    const loadings = await this.loading.create({
      message: 'Memuat...',
      spinner: 'circular'
    });
    await loadings.present();
    this.getapi.alamatLoad(this.page)
      .subscribe(res => {
        loadings.dismiss();
        if(res){
          if(this.page == 1){
            this.hasil = res["data"];
          }else{
            this.hasil = this.hasil.concat(res["data"]);
          }
        }
        this.maximumPages = res["maxPage"];
        //this.page = res["page"];
        if (event) {
          event.target.complete();
        }
      });
  }
 
  loadMore(event) {
    this.page++;
    
    if (this.page > this.maximumPages){
      event.target.disabled = true;
      console.log("disabled TRUE BOSKU");
    }else{
      this.loadUsers(event);
    }
  }

  ngOnInit() {
  }

  pilihaksi(id){
    this.acs.create({
      buttons: [
        {
          text: "Jadikan Alamat Utama",
          icon: 'home',
          handler: () => {
            this.utama(id);
          }
        },
        {
          text: "Edit Alamat",
          icon: 'create',
          handler: () => {
            this.navCtrl.navigateForward(["/editalamat/"+id]);
          }
        },
        {
          text: "Hapus Alamat",
          icon: 'trash',
          handler: () => {
            this.hapus(id);
          }
        },
        {
          text: "Batal",
          role: 'cancel',
          icon: 'close-circle'
        }
      ]
    }).then(ac => ac.present())
  }
  hapus(id){
    this.alert.konfirmasi("Menghapus Alamat","Yakin akan menghapus data ini?").then(res=>{
      if(res['data']){
        this.postapi.hapusAlamat(id).subscribe(res=>{
          if(res['success']){
            this.hasil = [];
            this.page = 1;
            this.loadUsers();
          }else{
            this.alert.presentAlert("Gagal menghapus","gagal menghapus data, cobalah beberapa saat lagi")
          }
        });
      }
    })
  }
  utama(id){
    this.alert.konfirmasi("Mengubah Alamat","Yakin akan mengubah data ini?").then(res=>{
      if(res['data']){
        this.postapi.simpanAlamatUtama(id).subscribe(res=>{
          if(res['success']){
            this.hasil = [];
            this.page = 1;
            this.loadUsers();
          }else{
            this.alert.presentAlert("Gagal menyimpan","gagal mennyimpan data, cobalah beberapa saat lagi")
          }
        });
      }
    })
  }

}
