import { Component } from '@angular/core';
import { AlertService } from '../services/alert.service';
import { Router } from '@angular/router';
import { LoadingController } from '@ionic/angular';
import { Storage } from '@ionic/storage';
import { GetapiService } from '../services/getapi.service';
import { catchError } from 'rxjs/operators';
import { PostapiService } from '../services/postapi.service';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss']
})
export class Tab3Page {
  page = 1;
  maximumPages: number = 1;
  items = [];

  constructor(
    private alert: AlertService,
    private getapi: GetapiService,
    private router: Router,
    private loading: LoadingController,
    private storage: Storage,
    private postapi: PostapiService
  ) { }

  ngOnInit() {
  }

  async ionViewWillEnter(){
    this.page = 1;
    this.items = [];
    const loadings = await this.loading.create({
      message: 'Loading...',
      spinner: 'crescent'
    });
    await loadings.present();

    this.storage.get('data').then(
      data => {
        loadings.dismiss();
        if(data['usrid'] != 0) {
          this.loadUsers();
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
        loadings.dismiss();
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

  loadMore(event) {
    this.page++;
    
    if (this.page > this.maximumPages){
      event.target.disabled = true;
      console.log("data dah habis bosku");
    }else{
      this.loadUsers(event);
    }
  }

  async loadUsers(event?){
    const loadings = await this.loading.create({
      message: 'memuat pesanan',
      spinner: 'circular'
    });
    if (!event) {
      await loadings.present();
    }

    this.getapi.pesananLoad(this.page).subscribe(res=>{
      if (!event) {
        loadings.dismiss();
      }
      if (event) {
        event.target.complete();
      }
      if(res['success']){
        this.items = this.items.concat(res['data']);
        this.maximumPages = res['maxPage'];
      }else{
        this.alert.presentToast("terjadi kesalahan saat menghubungi server");
      }
    });
  }

  async hapusPesanan(id){
    const loding = await this.loading.create({
      message: "menghapus pesanan",
      spinner: "circular"
    });
    this.alert.konfirmasi("Hapus pesanan","Anda yakin akan menghapus/membatalkan pesanan ini?").then(res=>{
      if(res['data'] == true){
        //this.alert.presentToast("Dihapus");
        this.page = 1;
        this.items = [];
        loding.present();
        this.postapi.hapusPesanan(id).subscribe(data=>{
          loding.dismiss();
          if(data['success']){
            this.alert.presentToast("Pesanan telah dihapus");
            this.loadUsers();
          }else{
            this.alert.presentAlert("Gagal menghapus","Gagal menghapus pesanan, cobalah beberapa saat lagi");
          }
        });
      }
    });
  }
}
