import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, NavController, ActionSheetController } from '@ionic/angular';
import { PostapiService } from 'src/app/services/postapi.service';

@Component({
  selector: 'app-rekening',
  templateUrl: './rekening.page.html',
  styleUrls: ['./rekening.page.scss'],
})
export class RekeningPage implements OnInit {
  hasil = [];
  page = 1;
  maximumPages = 3;
  alamat: string;

  constructor(
    private getapi: GetapiService,
    private navCtrl: NavController,
    private loading: LoadingController,
    private acs: ActionSheetController,
    private postapi: PostapiService,
    private alert: AlertService
  ) {
   // this.statusBar.backgroundColorByHexString('#2980b9');
  }

  ionViewWillEnter(){
    this.loadUsers();
  }
 
  async loadUsers(event?) {
    const loadings = await this.loading.create({
      message: 'Memuat...',
      spinner: 'circular'
    });
    await loadings.present();
    this.getapi.rekeningLoad(this.page)
      .subscribe(res => {
        loadings.dismiss();
        if(res){
          if(this.page == 1){
            this.hasil = res["data"];
          }else{
            this.hasil = this.hasil.concat(res["data"]);
          }
        }
        this.maximumPages = res["maxPage"];
        //this.page = res["page"];
        if (event) {
          event.target.complete();
        }
      });
  }
 
  loadMore(event) {
    this.page++;
    
    if (this.page > this.maximumPages){
      event.target.disabled = true;
      console.log("disabled TRUE BOSKU");
    }else{
      this.loadUsers(event);
    }
  }

  pilihaksi(id){
    this.acs.create({
      buttons: [
        {
          text: "Edit Rekening",
          icon: 'create',
          handler: () => {
            this.navCtrl.navigateForward(["/editrekening/"+id]);
          }
        },
        {
          text: "Hapus Rekening",
          icon: 'trash',
          handler: () => {
            this.hapus(id);
          }
        },
        {
          text: "Batal",
          role: 'cancel',
          icon: 'close-circle'
        }
      ]
    }).then(ac => ac.present())
  }
  hapus(id){
    this.alert.konfirmasi("Menghapus Rekening","Yakin akan menghapus data ini?").then(res=>{
      if(res['data']){
        this.postapi.hapusRekening(id).subscribe(res=>{
          if(res['success']){
            this.hasil = [];
            this.page = 1;
            this.loadUsers();
          }else{
            this.alert.presentAlert("Gagal menghapus","gagal menghapus data, cobalah beberapa saat lagi")
          }
        });
      }
    })
  }

  ngOnInit() {
  }

}
