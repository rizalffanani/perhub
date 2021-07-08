import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { NavController, LoadingController } from '@ionic/angular';
import { PostapiService } from 'src/app/services/postapi.service';

@Component({
  selector: 'app-editrekening',
  templateUrl: './editrekening.page.html',
  styleUrls: ['./editrekening.page.scss'],
})
export class EditrekeningPage implements OnInit {
	public inputForm: FormGroup;
  public submitAttempt: boolean = false;
  id;
  prov;
  kab;
  kec;
  jenis: string;
  ready: boolean = false;
  bank: any;

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
        atasnama: ["",Validators.compose([Validators.required])],
        idbank: ["",Validators.compose([Validators.required])],
        norek: ["",Validators.compose([Validators.required])],
        kcp: ["",Validators.compose([Validators.required])]
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
      this.getapi.rekeningSingle(this.id).subscribe(res=>{
        loading.dismiss();
        this.getapi.dropBank().subscribe(reso=>{
          if(reso['success'] == true){
            this.bank = reso['data'];
            console.log(this.bank);
            setTimeout(set=>{
              this.inputForm.controls['idbank'].setValue(res['idbank']);
            },500);
          }
        });
        this.inputForm.controls['atasnama'].setValue(res['atasnama']);
        this.inputForm.controls['norek'].setValue(res['norek']);
        this.inputForm.controls['kcp'].setValue(res['kcp']);
        setTimeout(set=>{
          this.ready = true;
        },2000);
      });
    }else{
      this.getapi.dropBank().subscribe(reso=>{
        if(reso['success'] == true){
          this.bank = reso['data'];
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
      this.postapi.simpanRekening(this.id,this.inputForm.value).subscribe(res=>{
        loading.dismiss();
        if(res['success'] == true){
          this.navCtrl.back();
        }else{
          this.alert.presentAlert("Server Sibuk","Gagal menyimpan rekening, ulangi beberapa saat lagi...");
        }
      });
    }else{
      loading.dismiss();
      this.alert.presentAlert("Lengkapi Formulir","Lengkapi formulir terlebih dahulu");
    }
  }

}
