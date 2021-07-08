import { Component, OnInit } from '@angular/core';
import { ModalController, NavController, LoadingController } from '@ionic/angular';
import { AuthService } from '../auth.service';
import { AlertService } from 'src/app/services/alert.service';
import { NgForm } from '@angular/forms';
import { Storage } from '@ionic/storage';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {
  
  constructor(
    private modalController: ModalController,
    private authService: AuthService,
    private navCtrl: NavController,
    private alertService: AlertService,
    public loadingCtrl: LoadingController,
    private storage: Storage
  ) { }
  ngOnInit() {
  }
  
  async login(form: NgForm) {
    const loading = await this.loadingCtrl.create({message: "Tunggu sebentar..."});
    await loading.present();
    this.authService.login(form.value.email, form.value.password).subscribe(
      data => {
        loading.dismiss();
        if(data['success'] == true){
          this.alertService.presentToast("Selamat datang kembali "+data['nama']);
          this.navCtrl.navigateRoot('/');
        }else{
          this.alertService.presentToast(data["message"]);
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
