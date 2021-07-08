import { Component, OnInit } from '@angular/core';
import { InAppBrowserOptions, InAppBrowser } from '@ionic-native/in-app-browser/ngx';
import { GetapiService } from 'src/app/services/getapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController } from '@ionic/angular';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-bayarprosesmidtrans',
  templateUrl: './bayarprosesmidtrans.page.html',
  styleUrls: ['./bayarprosesmidtrans.page.scss'],
})
export class BayarprosesmidtransPage implements OnInit {
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
    let urlMidtrans = this.getapi.APP_URL + "home/midtransmobile/" + this.id +"?mobile=true";
    
    const browser = this.iab.create(urlMidtrans,target,this.options);
    browser.on('loadstop').subscribe(event => {
      //console.log(event);
      if (event.url.substr(event.url.lastIndexOf('/') + 1) === 'ipaymusuccess') {
        browser.close();
      }
    });
  }
}
