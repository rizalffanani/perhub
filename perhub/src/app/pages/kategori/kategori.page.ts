import { Component, OnInit } from '@angular/core';
import { Storage } from '@ionic/storage';
import { Router, ActivatedRoute } from '@angular/router';
import { LoadingController } from '@ionic/angular';
import { AlertService } from 'src/app/services/alert.service';
import { GetapiService } from 'src/app/services/getapi.service';

@Component({
  selector: 'app-kategori',
  templateUrl: './kategori.page.html',
  styleUrls: ['./kategori.page.scss'],
})
export class KategoriPage implements OnInit {
  produk: [];
  id: any;
  kategori: any;
  kosong: boolean = false;

  constructor(
    private storage: Storage,
    private router: Router,
    private loading: LoadingController,
    private alert: AlertService,
    private getapi: GetapiService,
    private activatedRoute: ActivatedRoute
  ) { }

  ngOnInit() {
  }

  async ionViewWillEnter(){
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    this.getPro(this.id);
  }

  async getPro(id){
    const loadings = await this.loading.create({
      message: 'Memuat produk...',
      spinner: 'crescent'
    });
    await loadings.present();
    this.getapi.getProdukKategori(id).subscribe((res)=>{
      loadings.dismiss();
      if(res['success'] == true){
        this.produk = res['result'];
        this.kategori = res['kategori'];
      }else{
        if(res['sesihabis'] == false){
          this.kosong = true;
          this.kategori = res['kategori'];
        }else{
          this.alert.presentToast("gagal memuat produk");
        }
      } 
    },
    error=>{
      loadings.dismiss();
    });
  }

}
