import { Component, OnInit, PipeTransform, Pipe, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { GetapiService } from 'src/app/services/getapi.service';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AlertService } from 'src/app/services/alert.service';
import { LoadingController, IonSlides } from '@ionic/angular';
import { Storage } from '@ionic/storage';
import { PostapiService } from 'src/app/services/postapi.service';
import { DomSanitizer, SafeHtml } from '@angular/platform-browser';

@Component({
  selector: 'app-produks',
  templateUrl: './produks.page.html',
  styleUrls: ['./produks.page.scss'],
})
export class ProduksPage implements OnInit{
	public inputForm: FormGroup;
  public submitAttempt: boolean = false;
  @ViewChild('slides') slides: IonSlides;
  title;
  id: any;
  slideOpts= {
    autoplay: true,
    pager: true,
    slidesPerview: 1,
    spaceBetween: 0
  };
  login = false;
  sliders: any= [];
  harga: any;
  warna: any;
  deskripsi: any;
  size: any;
  stok: any;
  stoknya = 0;
  maxStok = 0;
  variasi: any;
  sizes: any;
  warnas: any;
  variasea: any = 0;
  ulasan: any = [];
  totulasan: any= 0;
  nilai: any = 0;
  constructor(
    private activatedRoute: ActivatedRoute,
    private getapi: GetapiService,
    private alert: AlertService,
    private storage: Storage,
    private router: Router,
    private postapi: PostapiService,
    private loading: LoadingController,
    public formBuilder: FormBuilder,
    private domSanitizer: DomSanitizer
    ) {
      this.inputForm = formBuilder.group({
        idproduk: [this.id,Validators.compose([Validators.required])],
        warna: ["0",Validators.compose([Validators.required])],
        variasi: ["0",Validators.compose([Validators.required])],
        jumlah: [1,Validators.compose([Validators.required])],
        keterangan: [""],
      });
    }

  transform(html: string): SafeHtml {
    return this.domSanitizer.bypassSecurityTrustHtml(html);
  }

  ngOnInit() {
  }
  ionViewDidEnter(){
    this.updateSlides();
  }

  async getData(){
    const loadings = await this.loading.create({
      message: 'Memuat Produk...',
      spinner: 'crescent'
    });
    await loadings.present();

    this.id = this.activatedRoute.snapshot.paramMap.get('id');
    this.getapi.getProdukSingle(this.id).subscribe(data=>{
      this.title = data['nama'];
      this.sliders = data['foto'];
      this.stoknya = data['stok'];
      this.harga = data['harga'];
      this.warnas = data['warna'];
      this.variasea = data['variasiproduk'];
      this.deskripsi = data['deskripsi'];
      this.ulasan = data['ulasan'];
      this.totulasan = data['totulasan'];
      this.nilai = data['nilai'];
      loadings.dismiss();
    });
    this.inputForm.controls['idproduk'].setValue(this.id);
  }
  updateSlides(){
    console.log("fired");
    setTimeout(res=>{
      console.log(this.slides.length());
      this.slides.update().then(re=>{
        console.log("ion slide updated");
      });
    },1000);
  }

  async ionViewWillEnter(){ 
    this.getData();   
    this.storage.get('data').then(
      data => {
        if(data['usrid'] != 0) {
          this.login = true;
        } else {
          //this.router.navigate(['/login']);
          this.login = false;
        }
      },
      error => {
        //this.router.navigate(['/login']);
        this.login = false;
      }
    );

  }

  cekStok(stoks){
    this.stok = stoks;
    console.log("stok: "+stoks);
  }

  async beliproduk(){
    const loadings = await this.loading.create({
      message: 'Memproses pesanan...',
      spinner: 'crescent'
    });
    await loadings.present();

    if(this.inputForm.valid){
      this.postapi.tambahKeranjang(this.inputForm.value).subscribe(data=>{
        loadings.dismiss();
        if(data['success'] == true){
          this.alert.presentToast("Produk berhasil ditambahkan ke keranjang belanja");
          this.router.navigate(['/tabs/tab2']);
        }else{
          this.alert.presentAlert("Pesanan tidak dapat diproses","Cek kembali informasi produk Anda, pastikan jumlah tidak lebih dari stok yang tersedia");
        }
      });
    }else{
      loadings.dismiss();
      this.inputForm.touched;
      this.alert.presentToast("Lengkapi formatnya terlebih dahulu");
      console.log(this.inputForm.value);
    }
  }

  async getSize(){
    const loadings = await this.loading.create({
      message: 'Memuat size...',
      spinner: 'crescent'
    });
    await loadings.present();

    const val = this.inputForm.value;
    this.getapi.getSize(val.warna,this.id).subscribe(data=>{
      loadings.dismiss();
      if(data['success'] == true){
        this.sizes = data['size'];
      }else{
        this.alert.presentToast("Gagal mengambil data size produk");
      }
    });
  }

}
