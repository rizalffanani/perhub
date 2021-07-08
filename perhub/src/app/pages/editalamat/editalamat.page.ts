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
  selector: 'app-editalamat',
  templateUrl: './editalamat.page.html',
  styleUrls: ['./editalamat.page.scss'],
})
export class EditalamatPage implements OnInit {
	public inputForm: FormGroup;
  public submitAttempt: boolean = false;
  id;
  prov;
  kab;
  kec;
  jenis: string;
  ready: boolean = false;

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
  }

  async ionViewWillEnter(){
    let loading = await this.loading.create({
      message: 'tunggu sebentar',
      spinner: 'circular'
    });
    await loading.present();

    if(this.id > 0){
      this.getapi.alamatSingle(this.id,1000).subscribe(res=>{
        loading.dismiss();

        this.getapi.dropProv().subscribe(resi=>{
          if(resi['success'] == true){
            this.prov = resi['data'];
            console.log(this.prov);
            setTimeout(set=>{
              this.inputForm.controls['idprov'].setValue(res['idprov']);
            },500);
          }
        });
        this.getapi.dropKab(res['idprov']).subscribe(resa=>{
          if(resa['success'] == true){
            this.kab = resa['data'];
            console.log(this.kab);
            setTimeout(set=>{
              this.inputForm.controls['idkab'].setValue(res['idkab']);
            },500);
          }
        });
        this.getapi.dropKec(res['idkab']).subscribe(reso=>{
          if(reso['success'] == true){
            this.kec = reso['data'];
            console.log(this.kec);
            setTimeout(set=>{
              this.inputForm.controls['idkec'].setValue(res['idkec']);
            },500);
          }
        });
        this.inputForm.controls['judul'].setValue(res['judul']);
        this.inputForm.controls['alamat'].setValue(res['alamat']);
        this.inputForm.controls['kodepos'].setValue(res['kodepos']);
        this.inputForm.controls['nama'].setValue(res['nama']);
        this.inputForm.controls['nohp'].setValue(res['nohp']);
        setTimeout(set=>{
          this.ready = true;
        },2000);
      });
    }else{
      this.getapi.dropProv().subscribe(resi=>{
        if(resi['success'] == true){
          this.prov = resi['data'];
          this.ready = true;
        }
      });

      loading.dismiss();
    }
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
    if(this.ready == true){
      this.getapi.dropKab(this.inputForm.value.idprov).subscribe(res=>{
        if(res['success'] == true){
          this.kab = res['data'];
          console.log(this.kab);
          setTimeout(set=>{
            this.inputForm.controls['idkab'].setValue("");
          },500);
        }
      });
    }
  }

  getkec(){
    if(this.ready == true){
      this.getapi.dropKec(this.inputForm.value.idkab).subscribe(res=>{
        if(res['success'] == true){
          this.kec = res['data'];
          console.log(this.kec);
          setTimeout(set=>{
            this.inputForm.controls['idkec'].setValue("");
          },500);
        }
      });
    }
  }

}
