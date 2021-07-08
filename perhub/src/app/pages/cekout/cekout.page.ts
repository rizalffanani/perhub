import { Component, OnInit } from '@angular/core';
import { GetapiService } from 'src/app/services/getapi.service';
import { PostapiService } from 'src/app/services/postapi.service';
import { AlertService } from 'src/app/services/alert.service';
import { Router } from '@angular/router';
import { FormGroup, FormBuilder, FormArray } from '@angular/forms';
import { LoadingController } from '@ionic/angular';
import { count } from 'rxjs/operators';

@Component({
  selector: 'app-cekout',
  templateUrl: './cekout.page.html',
  styleUrls: ['./cekout.page.scss'],
})
export class CekoutPage implements OnInit {
	public inputForm: FormGroup;
	public submitAttempt: boolean = false;
  produk: any;
  alamat: string;
  alamatnama: any;
  alamatnohp: any;
  alamatjudul: any;
  alamatkodepos: any;
  idkec: any;
  alamatlengkap: any;
  harga = 0;
  total = 0;
  ongkir = 0;
  isoke = false;
  pilihongkir: any;
  pilihanongkir: any;
  idproduk: string = "";
  kuriroke: boolean;

  constructor(
    private loading: LoadingController,
    private getapi: GetapiService,
    private postapi: PostapiService,
    private alert: AlertService,
    public formBuilder: FormBuilder,
    private router: Router
  ) {
    this.inputForm = formBuilder.group({
      total: [0],
      pilihongkir: [],
      ongkir: [0],
      diskon: [0],
      saldo: [0],
      alamat: [],
      metode: [1],
      berat: [],
      kurir: [],
      paket: [],
      dari: [],
      tujuan: [],
      dropship: [""],
      dropshipnomer: [""],
      dropshipalamat: [""],
      idproduk: []
    });
    this.inputForm.controls['ongkir'].setValue(this.ongkir);
  }

  ngOnInit() {
  }

  async ionViewWillEnter(){
    this.inputForm.controls['pilihongkir'].setValue("");
    this.kuriroke = false;
    this.isoke = false;
    this.ongkir = 0;
    const loadings = await this.loading.create({
      message: 'Memuat detail pesanan...',
      spinner: 'circular'
    });
    await loadings.present();

    this.getapi.getBayar().subscribe(datar=>{
      if(datar['success'] == true){
        //loadings.message = "Sedang memuat perhitungan ongkos kirim";
        this.produk = datar['produk'];
        this.harga = datar['totalharga'];
        this.total = this.harga;
        this.inputForm.controls['berat'].setValue(datar['berat']);

        var i;
        for(i=0; i<this.produk.length; i++){
          if(this.idproduk){
            this.idproduk = this.idproduk + '|' + this.produk[i]['id'];
          }else{
            this.idproduk = this.produk[i]['id'];
          }
        }
        this.inputForm.controls['idproduk'].setValue(this.idproduk);

        if(localStorage.getItem("alamat")){
          this.alamat = localStorage.getItem("alamat");
        }else{
          this.alamat = "utama";
        } 
        this.loading.dismiss();

        this.getapi.alamatSingle(this.alamat,datar['berat']).subscribe(data => {
          this.alamatnama = data['nama'];
          this.alamatnohp = data['nohp'];
          this.alamatlengkap = data['alamat'];
          this.alamatjudul = data['judul'];
          this.alamatkodepos = data['kodepos'];
          this.idkec = data['idkec'];
          this.alamat = data['id'];
          localStorage.setItem("alamat",data['id']);
          this.inputForm.controls['alamat'].setValue(data['id']);
          this.inputForm.controls['dari'].setValue(data['dari']);
          this.inputForm.controls['tujuan'].setValue(data['idkec']);
          
          if(data['ongkir']){
            this.kuriroke = true;
            this.pilihanongkir = data['ongkir'];
            /*this.getapi.cekOngkir(data['dari'],this.inputForm.value.berat,data['idkec'],'jne','reg').subscribe(res=>{
              this.loading.dismiss();
              this.inputForm.controls['pilihongkir'].setValue("jne-REG-"+data['reg']);

              if(res['success'] == true){
                this.inputForm.controls['ongkir'].setValue(res['harga']);
                this.ongkir = res['harga'];
                this.total += res['harga'];
                this.isoke = true;
              }else{
                this.isoke = false;
                this.alert.presentToast("ongkos kirim dari ekspedisi tidak ditemukan");
              }
            });*/
          }else{
            this.kuriroke = true;
            this.ongkir = 0;
            this.isoke = false;
          }
        })
      }else{
        this.alert.presentAlert("Server Sibuk","Tunggu beberapa saat dan silahkan ulangi kembali");
      }
    });
  }

  async buatPesanan(){
    const loadings = await this.loading.create({
      message: 'Sistem akan memproses pesanan, mungkin akan membutuhkan waktu sedikit lebih lama, mohon menunggu...',
      spinner: 'circular'
    });
    await loadings.present();
    
    this.postapi.bayarPesanan(this.inputForm.value).subscribe(res=>{
      this.loading.dismiss();
      if(res['success']){
        this.router.navigate(['/bayarpesanan/'+res['inv']]);
      }else{
        this.alert.presentAlert("Gagal membuat pesanan","terjadi kesalahan saat memproses pesanan");
      }
    });
  }

  async cekOngkir(){
    var pilih = this.inputForm.value.pilihongkir.split("-");    
    this.inputForm.controls['kurir'].setValue(pilih[0]);
    this.inputForm.controls['paket'].setValue(pilih[1]);
    /*this.getapi.cekOngkir(this.inputForm.value.dari,this.inputForm.value.berat,this.inputForm.value.tujuan,pilih[0],pilih[1]).subscribe(res=>{
      if(res['success'] == true){*/
        this.inputForm.controls['ongkir'].setValue(pilih[2]);
        this.ongkir = parseFloat(pilih[2]);
        this.total = this.harga + parseFloat(pilih[2]);
        this.inputForm.controls['total'].setValue(this.total);
        this.isoke = true;
      /*}else{
        this.alert.presentToast("ongkos kirim dari ekspedisi tidak ditemukan");
      }
    });*/
  }

}
