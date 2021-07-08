import { Component, ViewChild } from '@angular/core';

import { Platform, AlertController, IonRouterOutlet } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss']
})
export class AppComponent {
  @ViewChild(IonRouterOutlet,{static:false}) routerOutlet: IonRouterOutlet;
  
  constructor(
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar,
    private router: Router,
    private alertCtrl: AlertController
  ) {
    this.initializeApp();
    
    this.platform.backButton.subscribe(() => {
      if (this.routerOutlet && this.routerOutlet.canGoBack()) {
        this.routerOutlet.pop();
      } else if (this.router.url === '/') {
        navigator['app'].exitApp()
      } else {
        this.presentAlertConfirm()
      }
    });
  }
  
  async presentAlertConfirm() {
    const alert = await this.alertCtrl.create({
      header: 'Keluar Aplikasi',
      message: 'Anda akan keluar dari aplikasi?',
      buttons: [
        {
          text: 'Batal',
          handler: () => {
            console.log('Confirm Cancel');
          }
        }, {
          text: 'Oke',
          handler: () => {
            console.log('Confirm Okay');
            navigator['app'].exitApp()
          }
        }
      ]
    });

    await alert.present();
  }

  initializeApp() {
    this.platform.ready().then(() => {
      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }
}
