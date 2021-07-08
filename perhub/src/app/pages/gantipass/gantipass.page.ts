import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, NavController } from '@ionic/angular';
import { FormGroup, FormBuilder } from '@angular/forms';
import { PostapiService } from 'src/app/services/postapi.service';

@Component({
  selector: 'app-gantipass',
  templateUrl: './gantipass.page.html',
  styleUrls: ['./gantipass.page.scss'],
})
export class GantipassPage implements OnInit {
	public inputForm: FormGroup;
	public submitAttempt: boolean = false;

  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    public formBuilder: FormBuilder,
    private loadingCtrl: LoadingController,
    private postapi: PostapiService,
    private navCtrl: NavController
  ) {
    this.inputForm = formBuilder.group({
      password: [""],
      pass: [""]
    });
  }

  ngOnInit() {}

  async simpan(){
    const loading = await this.loadingCtrl.create({
      spinner: 'circular',message: 'menyimpan...'
    });
    await loading.present();

    if(this.inputForm.valid){
      if(this.inputForm.value.password == this.inputForm.value.pass){
        this.postapi.simpanPass(this.inputForm.value).subscribe(res=>{
          loading.dismiss();
          if(res['success'] == true){
            this.alert.presentToast("Password baru telah disimpan");
            this.navCtrl.back();
          }else{
            this.alert.presentAlert("Server Sibuk","Gagal menyimpan profil, ulangi beberapa saat lagi...");
          }
        });
      }else{
        loading.dismiss();
        this.alert.presentAlert("Password berbeda","Password yang Anda masukkan harus sama persis");
      }
    }else{
      loading.dismiss();
      this.alert.presentAlert("Lengkapi Formulir","Lengkapi formulir terlebih dahulu");
    }
  }

}
