import { Injectable } from '@angular/core';
import { ToastController, AlertController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class AlertService {

  constructor(
    private toastController: ToastController,
    private alertCtrl: AlertController
  ) { }

  async presentToast(message: any) {
    const toast = await this.toastController.create({
      message: message,
      duration: 2000,
      position: 'bottom',
      color: 'dark'
    });
    toast.present();
  }

  async presentAlert(hider,pesan:any) {
    let alert = await this.alertCtrl.create({
      header: hider,
      message: pesan,
      buttons: ['Dismiss']
    });
    alert.present();
  }

  async konfirmasi(title, message) {
    let choice
    const alert = await this.alertCtrl.create({
        header: title,
        subHeader: message,
        buttons: [{
            text: 'Oke',
            handler: () => {
                alert.dismiss(true)
                return false
            }
        }, {
            text: 'Batal',
            handler: () => {
                alert.dismiss(false);
                return false;
            }
        }]
    });

    await alert.present();
    await alert.onDidDismiss().then((data) => {
        choice = data
    })
    return choice
  }
}
