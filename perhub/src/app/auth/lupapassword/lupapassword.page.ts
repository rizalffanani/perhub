import { Component, OnInit } from '@angular/core';
import { ModalController, NavController, LoadingController } from '@ionic/angular';
import { AuthService } from '../auth.service';
import { AlertService } from 'src/app/services/alert.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-lupapassword',
  templateUrl: './lupapassword.page.html',
  styleUrls: ['./lupapassword.page.scss'],
})
export class LupapasswordPage implements OnInit {

  constructor(
    private modalController: ModalController,
    private authService: AuthService,
    private navCtrl: NavController,
    public loadingCtrl: LoadingController,
    private alertService: AlertService
  ) { }

  ngOnInit() {
  }
  
  async lupa(form: NgForm) {
    const loading = await this.loadingCtrl.create({message: "Tunggu sebentar..."});
    await loading.present();
    this.authService.lupa(form.value.email).subscribe(
      data => {
        loading.dismiss();
        if(data['success'] == true){
          this.alertService.presentToast("Berhasil mereset password, silahkan cek email Anda");
          this.navCtrl.navigateRoot('/login');
        }else{
          this.alertService.presentToast("Gagal mereset password, pastikan kembali email sudah sesuai");
        }
      },
      error => {
        loading.dismiss();
        console.log(error);
        this.alertService.presentToast(error);
      }
    );
  }

}
