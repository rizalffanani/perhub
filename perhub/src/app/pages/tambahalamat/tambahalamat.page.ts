import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { PostapiService } from 'src/app/services/postapi.service';
import { LoadingController } from '@ionic/angular';
import { FormBuilder, Validators, FormGroup } from '@angular/forms';
import { Storage } from '@ionic/storage';
import { NavController } from '@ionic/angular';

@Component({
  selector: 'app-tambahalamat',
  templateUrl: './tambahalamat.page.html',
  styleUrls: ['./tambahalamat.page.scss'],
})
export class TambahalamatPage implements OnInit {
	public inputForm: FormGroup;
  public submitAttempt: boolean = false;
  id;
  prov;
  kab;
  kec;
  jenis: string;

  constructor(
    private activatedRoute: ActivatedRoute,
    private getapi: GetapiService,
    private alert: AlertService,
    private navCtrl: NavController,
    private postapi: PostapiService,
    private loading: LoadingController,
    public formBuilder: FormBuilder,
    ) {
      this.id = this.activatedRoute.snapshot.paramMap.get('id');
      if(this.id > 0){
        this.jenis = "Ubah";
      }else{
        this.jenis = "Tambah";
      }
      this.inputForm = formBuilder.group({
        idprov: ["",Validators.compose([Validators.required])],
        idkab: ["",Validators.compose([Validators.required])],
        idkec: ["",Validators.compose([Validators.required])],
        judul: ["",Validators.compose([Validators.required])],
        alamat: ["",Validators.compose([Validators.required])],
        kodepos: ["",Validators.compose([Validators.required])],
        nama: ["",Validators.compose([Validators.required])],
        nohp: ["",Validators.compose([Validators.required])],
      });
    }

  ngOnInit() {
    this.getapi.dropProv().subscribe(res=>{
      if(res['success'] == true){
        this.prov = res['data'];
        console.log(this.prov);
      }
    });
  }

  back(){
    this.navCtrl.back();
  }

  async simpan(){
    const loading = await this.loading.create({
      spinner: 'circular',message: 'menyimpan...'
    });
    await loading.present();

    if(this.inputForm.valid){
      this.postapi.simpanAlamat(this.id,this.inputForm.value).subscribe(res=>{
        loading.dismiss();
        if(res['success'] == true){
          this.navCtrl.back();
        }else{
          this.alert.presentAlert("Server Sibuk","Gagal menyimpan alamat, ulangi beberapa saat lagi...");
        }
      });
    }else{
      loading.dismiss();
      this.alert.presentAlert("Lengkapi Formulir","Lengkapi formulir terlebih dahulu");
    }
  }

  getkab(){
    this.getapi.dropKab(this.inputForm.value.idprov).subscribe(res=>{
      if(res['success'] == true){
        this.kab = res['data'];
        console.log(this.kab);
      }
    });
  }

  getkec(){
    this.getapi.dropKec(this.inputForm.value.idkab).subscribe(res=>{
      if(res['success'] == true){
        this.kec = res['data'];
        console.log(this.kec);
      }
    });
  }

}
