import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { GetapiService } from 'src/app/services/getapi.service';
import { LoadingController } from '@ionic/angular';

@Component({
  selector: 'app-lacakpaket',
  templateUrl: './lacakpaket.page.html',
  styleUrls: ['./lacakpaket.page.scss'],
})
export class LacakpaketPage implements OnInit {
  id:any;
  proses = [];
  status: any;
  tgl: any;
  penerima: any;
  sukses: any;
  resi: any;

  constructor(
    private activatedRoute: ActivatedRoute,
    private getapi: GetapiService,
    private loding: LoadingController
  ) {
    this.id = this.activatedRoute.snapshot.paramMap.get('id');
  }

  ngOnInit() {
    this.lacak();
  }

  async lacak(){
    const lod = await this.loding.create({
      message: "Tunggu sebentar...",
      spinner: "crescent"
    });
    lod.present();

    this.getapi.lacakPaket(this.id).subscribe(res=>{
      this.sukses = res['success'];
      lod.dismiss();

      if(res['success']){
        this.proses = res['proses'];
        this.status = res['status'];
        this.tgl = res['tgl'];
        this.resi = res['resi'];
        this.penerima = res['penerima'];
      }else{
        this.tgl = res['tgl'];
        this.resi = "-";
      }
    });
  }

}
