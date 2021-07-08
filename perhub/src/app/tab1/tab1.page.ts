import { Component, OnInit } from '@angular/core';
import { GetapiService } from '../services/getapi.service';
import { AlertService } from '../services/alert.service';
import { AuthService } from '../auth/auth.service';
import { LoadingController, NavController, ModalController } from '@ionic/angular';
import { faSearch } from '@fortawesome/free-solid-svg-icons';
import { ModalchatPage } from '../pages/modalchat/modalchat.page';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss']
})
export class Tab1Page implements OnInit{
  slider;
  slideOpts= {
    autoplay: true,
    pager: true,
    slidesPerview: 2,
    spaceBetween: -20
  };
  cari = faSearch;
  kategori: any;
  produk;
  notif:any = 0;
  login: boolean;

  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    private auth: AuthService,
    private loading: LoadingController,
    private navCtrl: NavController,
    public modalController: ModalController
  ) {
    this.auth.getToken();
  }

  ngOnInit(){
    if(this.auth.tokenSet == true){
      this.getKatSlide();
    }else{
      this.auth.getToken();
      this.getKatSlide();
    }
  }

  ionViewWillEnter(){  
    this.login = this.auth.isLoggedIn;  
    if(this.auth.tokenSet == true){
      this.getPro();
      this.getapi.getChatNotif().subscribe(data=>{
        if(data['success'] == true){
          this.notif = data['notif'];
        }else{
          this.notif = 0;
        }
      });
    }else{
      this.auth.getToken().then(data=>{
        this.getPro();
      });
    }
  }

  loadProduk(id){
    this.navCtrl.navigateForward('produks/'+id);
  }

  getKatSlide(){
    this.getapi.getSlider().subscribe((res)=>{
      if(res['success'] == true){
        this.slider = res['result'];
      }else{
        this.alert.presentToast("gagal memuat promo");
        this.navCtrl.navigateRoot(["/getoken"]);
      }
    });

    this.getapi.getKategori().subscribe((res)=>{
      if(res['success'] == true){
        this.kategori = res['result'];
      }else{
        this.alert.presentToast("gagal memuat kategori");
      }
    });
  }
  async getPro(){
    const loadings = await this.loading.create({
      message: 'Memuat produk...',
      spinner: 'circular'
    });
    await loadings.present();
    this.getapi.getProduk().subscribe((res)=>{
      loadings.dismiss();
      if(res['success'] == true){
        this.produk = res['result'];
      }else{
        this.alert.presentToast("gagal memuat produk");
      }
    });
  }
  async presentModal() {
    const modal = await this.modalController.create({
      component: ModalchatPage,
      cssClass: 'my-custom-class'
    });
    return await modal.present();
  }

}
