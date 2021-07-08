import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { LoadingController, NavController } from '@ionic/angular';

@Component({
  selector: 'app-cekoutalamat',
  templateUrl: './cekoutalamat.page.html',
  styleUrls: ['./cekoutalamat.page.scss'],
})
export class CekoutalamatPage implements OnInit {
  hasil = [];
  page = 1;
  maximumPages = 3;
  alamat: string;

  constructor(
    private getapi:GetapiService,
    private navCtrl: NavController,
    private loading: LoadingController
  ) {
   // this.statusBar.backgroundColorByHexString('#2980b9');
  }

  ionViewWillEnter(){
    this.loadUsers();
    if(localStorage.getItem("alamat")){
      this.alamat = localStorage.getItem("alamat");
    }else{
      this.alamat = "utama";
    }
    console.log(this.alamat);
  }

  pilih(id){
    this.alamat = id;
    localStorage.setItem("alamat",id);
    this.navCtrl.navigateBack(['/cekout']);
  }
 
  async loadUsers(event?) {
    const loadings = await this.loading.create({
      message: 'Memuat...',
      spinner: 'circular'
    });
    await loadings.present();
    this.getapi.alamatLoad(this.page)
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

  ngOnInit() {
  }

}
