import { Component } from '@angular/core';
import { GetapiService } from '../services/getapi.service';
import { AlertService } from '../services/alert.service';
import { Storage } from '@ionic/storage';
import { Router } from '@angular/router';
import { LoadingController } from '@ionic/angular';
import { PostapiService } from '../services/postapi.service';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss']
})
export class Tab2Page {
  keranjang;
  items: any;
  
  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    private storage: Storage,
    private router: Router,
    private loading: LoadingController,
    private postapi: PostapiService
  ) {}

  ionViewWillEnter(){
    this.storage.get('data').then(
      data => {
        if(data['usrid'] != 0) {
          this.keranjangBelanja();
        } else {
          this.alert.konfirmasi("Login","Silahkan login atau mendaftar terlebih dahulu").then(data=>{
            if(data['data'] == true){
              this.router.navigate(['/login']);
            }else{
              this.router.navigate(['/']);
            }
          });
        }
      },
      error => {
        this.alert.konfirmasi("Login","Silahkan login atau mendaftar terlebih dahulu").then(data=>{
          if(data['data'] == true){
            this.router.navigate(['/login']);
          }else{
            this.router.navigate(['/']);
          }
        });
      }
    );
  }

  async keranjangBelanja(){
    const loadings = await this.loading.create({
      message: 'Loading...',
      spinner: 'crescent'
    });
    await loadings.present();

    this.getapi.getKeranjang().subscribe(data=>{
      setTimeout(()=>{ loadings.dismiss() },1000);
      if(data["success"] == true){
        this.items = data["result"];
      }else{
        this.items = 0;
        //this.alert.presentAlert("Error","Terjadi kendala saat memuat keranjang belanja, silahkan logout dari aplikasi dan login kembali");
      }
    });
  }

  hapusKeranjang(id){
    this.alert.konfirmasi("Yakin menghapus?","Produk akan dihapus dari keranjang belanja Anda").then(data=>{
      if(data.data == true){
        this.hapusSekarang(id);
      }
    });
  }

  async hapusSekarang(id){
    const loadings = await this.loading.create({
      message: 'Menghapus produk...',
      spinner: 'crescent'
    });
    await loadings.present();

    this.postapi.hapusKeranjang(id).subscribe(data=>{
      loadings.dismiss();
      this.ionViewWillEnter();
    })
  }

}
