import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { NavController, LoadingController } from '@ionic/angular';
import { AlertService } from 'src/app/services/alert.service';
import { NgForm } from '@angular/forms';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.page.html',
  styleUrls: ['./signup.page.scss'],
})
export class SignupPage implements OnInit {

  constructor(
    private authService: AuthService,
    private navCtrl: NavController,
    public loadingCtrl: LoadingController,
    private alertService: AlertService
  ) { }
  ngOnInit() {
  }

  async register(form: NgForm) {
    const loading = await this.loadingCtrl.create({message: "Tunggu sebentar..."});
    await loading.present();
    this.authService.register(form.value.nama, form.value.email, form.value.password, form.value.nohp).subscribe(
      data => {
        loading.dismiss();
        if(data["success"] == true){
          this.alertService.presentToast("berhasil mendaftar, kami telah mengirimkan link verifikasi ke email dan silahkan verifikasi akun Anda terlebih dahulu");
          this.navCtrl.navigateRoot('/login');
        }else{
          this.alertService.presentToast(data['message']);
        }
      },
      error => {
        loading.dismiss();
        console.log(error);
        this.alertService.presentToast(error);
      },
      () => {
        
      }
    );
  }
}
