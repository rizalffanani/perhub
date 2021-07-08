import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { tap} from 'rxjs/operators';
import { from} from 'rxjs';
import { Storage } from '@ionic/storage';
import { error } from '@angular/compiler/src/util';
import { NavController } from '@ionic/angular';
import { AlertService } from '../services/alert.service';

@Injectable({
  providedIn: 'root'
})
export class PostapiService {

  isLoggedIn = false;
  serverUP = false;
  token:any;
  dataResult = "error";
  API_URL = "https://localhost/perhubweb/mobileapi/";

  constructor(
    private http: HttpClient,
    private storage: Storage,
    private navCtrl: NavController,
    private alerts: AlertService
  ) { }

  tambahKeranjang(postdata) {
    return this.http.post(this.API_URL + 'tambahkeranjang',postdata).pipe();
  }

  bayarPesanan(postdata) {
    return this.http.post(this.API_URL + 'cekout',postdata).pipe();
  }
  hapusPesanan(postdata) {
    return this.http.post(this.API_URL + 'hapuspesanan',{"pid":postdata}).pipe();
  }

  hapusKeranjang(postdata) {
    return this.http.post(this.API_URL + 'hapuskeranjang',{"pid":postdata}).pipe();
  }

  simpanProfil(postdata) {
    return this.http.post(this.API_URL + 'simpanprofil',  postdata).pipe();
  }
  simpanPass(postdata) {
    return this.http.post(this.API_URL + 'simpanpassword',  postdata).pipe();
  }

  simpanAlamat(id,postdata) {
    return this.http.post(this.API_URL + 'tambahalamat',{"id":id, "data": postdata}).pipe();
  }
  simpanAlamatUtama(id) {
    return this.http.post(this.API_URL + 'tambahalamat/1',{"id":id}).pipe();
  }
  hapusAlamat(postdata) {
    return this.http.post(this.API_URL + 'hapusalamat',{"pid":postdata}).pipe();
  }

  simpanRekening(id,postdata) {
    return this.http.post(this.API_URL + 'tambahrekening',{"id":id, "data": postdata}).pipe();
  }
  hapusRekening(postdata) {
    return this.http.post(this.API_URL + 'hapusrekening',{"pid":postdata}).pipe();
  }

  sendChat(postdata) {
    return this.http.post(this.API_URL + 'kirimpesan',{"pesan": postdata}).pipe();
  }

  swipe(postdata) {
    return this.http.post(this.API_URL + 'swipe',  postdata).pipe();
  }
}