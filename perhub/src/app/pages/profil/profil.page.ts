import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, NavController } from '@ionic/angular';
import { faShippingFast,faBox } from '@fortawesome/free-solid-svg-icons';
import { FormBuilder, FormGroup } from '@angular/forms';
import { PostapiService } from 'src/app/services/postapi.service';

@Component({
  selector: 'app-profil',
  templateUrl: './profil.page.html',
  styleUrls: ['./profil.page.scss'],
})
export class ProfilPage implements OnInit {
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
      nama: [""],
      email: [""],
      kelamin: [""],
      nohp: [""]
    });
  }

  ngOnInit() {}

  async ionViewWillEnter(){
    let loading = await this.loadingCtrl.create({
      message: 'tunggu sebentar',
      spinner: 'circular'
    });
    await loading.present();

    this.getapi.profilLoad().subscribe(res=>{
      loading.dismiss();

      this.inputForm.controls['nama'].setValue(res['data']['nama']);
      this.inputForm.controls['kelamin'].setValue(res['data']['kelamin']);
      this.inputForm.controls['email'].setValue(res['data']['email']);
      this.inputForm.controls['nohp'].setValue(res['data']['nohp']);
    });
  }

  async simpan(){
    const loading = await this.loadingCtrl.create({
      spinner: 'circular',message: 'menyimpan...'
    });
    await loading.present();

    if(this.inputForm.valid){
      this.postapi.simpanProfil(this.inputForm.value).subscribe(res=>{
        loading.dismiss();
        if(res['success'] == true){
          this.navCtrl.back();
        }else{
          this.alert.presentAlert("Server Sibuk","Gagal menyimpan profil, ulangi beberapa saat lagi...");
        }
      });
    }else{
      loading.dismiss();
      this.alert.presentAlert("Lengkapi Formulir","Lengkapi formulir terlebih dahulu");
    }
  }
}
