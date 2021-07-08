import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, Platform, NavController } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';
import { InAppBrowser, InAppBrowserOptions } from '@ionic-native/in-app-browser/ngx';

@Component({
  selector: 'app-bayarproses',
  templateUrl: './bayarproses.page.html',
  styleUrls: ['./bayarproses.page.scss'],
})
export class BayarprosesPage implements OnInit {
  id: string;
  options : InAppBrowserOptions = {
      location : 'yes',//Or 'no' 
      hidden : 'no', //Or  'yes'
      clearcache : 'yes',
      hideurlbar: 'yes',
      hidenavigationbuttons: 'yes',
      clearsessioncache : 'yes',
      zoom : 'no',//Android only ,shows browser zoom controls 
      hardwareback : 'yes',
      mediaPlaybackRequiresUserAction : 'no',
      shouldPauseOnSuspend : 'no', //Android only 
      closebuttoncaption : 'Close', //iOS only
      disallowoverscroll : 'no', //iOS only 
      toolbar : 'yes', //iOS only 
      enableViewportScale : 'no', //iOS only 
      allowInlineMediaPlayback : 'no',//iOS only 
      presentationstyle : 'pagesheet',//iOS only 
      fullscreen : 'yes',//Windows only    
  };

  constructor(
    private getapi: GetapiService,
    private alert: AlertService,
    private loadingCtrl: LoadingController,
    private activatedRoute: ActivatedRoute,
    private iab: InAppBrowser
  ) { }

  ngOnInit() {
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    let target = "_blank";
    let urlIpaymu = this.getapi.APP_URL + "assync/bayaripaymu/" + this.id +"?mobile=true";
    
    const browser = this.iab.create(urlIpaymu,target,this.options);
    browser.on('loadstop').subscribe(event => {
      //console.log(event);
      if (event.url.substr(event.url.lastIndexOf('/') + 1) === 'ipaymusuccess') {
        browser.close();
      }
    });
  }

}
