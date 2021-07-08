import { Component, OnInit } from '@angular/core';
import { AlertService } from '../services/alert.service';
import { AuthService } from '../auth/auth.service';
import { Router } from '@angular/router';
import { LoadingController } from '@ionic/angular';
import { Storage } from '@ionic/storage';

@Component({
  selector: 'app-tab4',
  templateUrl: './tab4.page.html',
  styleUrls: ['./tab4.page.scss'],
})
export class Tab4Page implements OnInit {
  res;
  nama: any;
  saldo: any = 0;
  level: any = "normal member";

  constructor(
    private alert: AlertService,
    private auth: AuthService,
    private router: Router,
    private loading: LoadingController,
    private storage: Storage
  ) { }

  ngOnInit() {
  }

  async ionViewWillEnter(){
    const loadings = await this.loading.create({
      message: 'Loading...',
      spinner: 'crescent'
    });
    await loadings.present();

    this.storage.get('data').then(
      data => {
        loadings.dismiss();
        if(data['usrid'] != 0) {
          this.updatedetail();
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

  logout(){
    this.alert.konfirmasi("Logout","Yakin akan keluar dari akun Anda?").then((res)=>{
      //console.log(res);
      if(res.data == true){
        this.yesLogout();
      }
    });
  }
  async yesLogout(){
    const loading = await this.loading.create({message: "Tunggu sebentar..."});
    loading.present();
    this.auth.logout().subscribe(data=>{
      loading.dismiss();
      if(data['success']){
        this.router.navigate(['/login']);
      }
    });
  }
  async updatedetail(){
    const loading = await this.loading.create({message: "Tunggu sebentar..."});
    loading.present();
    this.auth.updateDetail().subscribe(data=>{
      loading.dismiss();
      this.nama = data['nama'];
      this.saldo = data['saldo'];
      if(data['level'] == 2){
        this.level = "reseller";
      }else if(data['level'] == 3){
        this.level = "agen";
      }else if(data['level'] == 4){
        this.level = "agen premium";
      }else if(data['level'] == 5){
        this.level = "distributor"
      }
    });
  }

}
