import { Component,Input, OnInit } from '@angular/core';
import { GetapiService } from '../services/getapi.service';
import { AlertService } from '../services/alert.service';
import { PostapiService } from '../services/postapi.service';
import { Subject} from 'rxjs';
@Component({
  selector: 'app-tab5',
  templateUrl: './tab5.page.html',
  styleUrls: ['./tab5.page.scss'],
})
export class Tab5Page implements OnInit {
  cards;length;
  tinder: any;
  number: any = 0;
  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    private postapi: PostapiService,
  ) {
    this.cards = [];
  }

  ngOnInit() {
    this.loadTinderCards();
  }

  loadTinderCards() {
    this.getapi.getTinder().subscribe((res)=>{
      if(res['success'] == true){
        this.cards = res['result'];
        this.length = res['result'].length;
      }else{
        this.alert.presentToast("gagal memuat kategori");
      }
    });
  };

  logChoice(choice) {
    this.postapi.swipe(choice).subscribe(res=>{
      if(res['success'] == false){
        this.alert.presentAlert("Server Sibuk","Gagal menyimpan profil, ulangi beberapa saat lagi...");
      }
    });
    this.number++;
    if (this.number==this.length) {
      this.loadTinderCards();
      this.number=0;
    }
    console.log(choice+" this.number="+this.number+".length"+this.length)
  };

}
