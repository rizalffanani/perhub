import { Component, OnInit, ViewChild } from '@angular/core';
import { PostapiService } from 'src/app/services/postapi.service';
import { GetapiService } from 'src/app/services/getapi.service';
import { Router } from '@angular/router';
import { LoadingController, IonContent } from '@ionic/angular';
import { AlertService } from 'src/app/services/alert.service';

@Component({
  selector: 'app-chat',
  templateUrl: './chat.page.html',
  styleUrls: ['./chat.page.scss'],
})
export class ChatPage implements OnInit {
  @ViewChild(IonContent) content: IonContent;
  pesan: any;
  pesanform: any;

  constructor(
    private postapi: PostapiService,
    private getapi: GetapiService,
    private router: Router,
    private loading: LoadingController,
    private alert: AlertService
  ) { }

  @ViewChild(IonContent,{static:true}) myContent: IonContent;

  ngOnInit() {
  }

  ionViewWillEnter(){
    this.getPesan();
  }

  async getPesan(){
    const loadings = await this.loading.create({
      message: 'Memuat pesan...',
      spinner: 'crescent'
    });
    await loadings.present();
    this.getapi.getChat().subscribe((res)=>{
      loadings.dismiss();
      this.content.scrollToBottom();
      if(res['success'] == true){
        this.pesan = res['result'];
      }else{
        this.alert.presentToast("gagal memuat pesan");
      }
    });
  }

  async kirimPesan(){
    const loadings = await this.loading.create({
      message: 'Mengirim pesan...',
      spinner: 'crescent'
    });
    await loadings.present();
    this.postapi.sendChat(this.pesanform).subscribe((res)=>{
      loadings.dismiss();
      if(res['success'] == true){
        this.getPesan();
        this.pesanform = "";
      }else{
        this.alert.presentAlert("Server Penuh","gagal mengirim pesan");
      }
    });
  }

}
