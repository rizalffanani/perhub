import { Component, OnInit } from '@angular/core';
import { AuthService } from '../auth.service';
import { Storage } from '@ionic/storage';
import { Router } from '@angular/router';
import { LoadingController } from '@ionic/angular';

@Component({
  selector: 'app-getoken',
  templateUrl: './getoken.page.html',
  styleUrls: ['./getoken.page.scss'],
})
export class GetokenPage implements OnInit {

  constructor(
    private auth: AuthService,
    private storage: Storage,
    private router: Router,
    private loading: LoadingController
  ) { }

  ngOnInit() {
    this.cektoken();
  }

  async cektoken(){
    const loding = await this.loading.create({
      message: "Menyiapkan database...",
      spinner: 'crescent'
    });
    loding.present();

    this.auth.cekToken().subscribe(token => {
      if(token['success'] == true){
        console.log("getting token from server: success");
        this.storage.set('token', token['token']);
        this.storage.set('data', token);
        loding.dismiss();
        this.router.navigate(['/']);
      }else{
        console.log("getting token from server: failed");
        loding.dismiss();
        this.router.navigate(['/']);
      }
    });
  }

}
