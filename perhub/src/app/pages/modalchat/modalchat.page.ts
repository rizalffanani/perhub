import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';
import { AuthService } from 'src/app/auth/auth.service';
import { Router } from '@angular/router';
import { GetapiService } from 'src/app/services/getapi.service';
import { SocialSharing } from '@ionic-native/social-sharing/ngx';

@Component({
  selector: 'app-modalchat',
  templateUrl: './modalchat.page.html',
  styleUrls: ['./modalchat.page.scss'],
})
export class ModalchatPage implements OnInit {

  login: boolean;

  constructor(
    private auth: AuthService,
    public modalController: ModalController,
    private router: Router,
    private socialSharing: SocialSharing,
    private getapi: GetapiService
    ) { }

  ngOnInit() {
    this.login = this.auth.isLoggedIn;  
  }

  chat(){
    this.router.navigate(["/chat"]);
    this.modalController.dismiss();
  }
  logins(){
    this.router.navigate(["/login"]);
    this.modalController.dismiss();
  }
  wasap(){
    this.getapi.wasapRotator().subscribe(res =>{
      this.socialSharing.shareViaWhatsAppToReceiver(
        res["wasap"],
        "",
        null,
        null
      );
    });    
  }

  tutupModal(){
    this.modalController.dismiss();
  }

}
