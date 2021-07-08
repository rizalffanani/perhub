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
export class GetapiService {

  isLoggedIn = false;
  serverUP = false;
  token:any;
  dataResult = "error";
  APP_URL = "https://localhost/perhubweb/";
  API_URL = "https://localhost/perhubweb/mobileapi/";

  constructor(
    private http: HttpClient,
    private storage: Storage,
    private navCtrl: NavController,
    private alerts: AlertService
  ) { }

  cekOngkir(dari,berat,tujuan,kurir,services){
    return this.http.get(this.API_URL + 'ceksongkir?dari='+dari+'&berat='+berat+'&tujuan='+tujuan+'&kurir='+kurir+'&services='+services).pipe();
  }
  apiUrl(){
    return this.API_URL;
  }

  getSlider() {
    return this.http.get(this.API_URL + 'slider').pipe();
  }

  dropBank() {
    return this.http.get(this.API_URL + 'getbank').pipe();
  }

  wasapRotator() {
    return this.http.get(this.API_URL + 'getwhatsapp').pipe();
  }

  dropProv() {
    return this.http.get(this.API_URL + 'getprov').pipe();
  }
  dropKab(prov) {
    return this.http.get(this.API_URL + 'getkab/'+prov).pipe();
  }
  dropKec(kab) {
    return this.http.get(this.API_URL + 'getkec/'+kab).pipe();
  }

  getProduk() {
    return this.http.get(this.API_URL + 'produkterbaru').pipe();
  }
  getProdukKategori(id) {
    return this.http.get(this.API_URL + 'produk?catid=' + id).pipe();
  }

  getChatNotif() {
    return this.http.get(this.API_URL + 'chatnotif').pipe();
  }
  getChat() {
    return this.http.get(this.API_URL + 'chat').pipe();
  }

  getBayar() {
    return this.http.get(this.API_URL + 'bayarpesanan').pipe();
  }
  getBayarDetail(id) {
    return this.http.get(this.API_URL + 'pembayaran/'+id).pipe();
  }

  getKategori() {
    return this.http.get(this.API_URL + 'kategori').pipe();
  }

  getTinder() {
    return this.http.get(this.API_URL + 'tinder').pipe();
  }

  getKeranjang() {
    return this.http.get(this.API_URL + 'keranjang').pipe();
  }

  alamatLoad(id){
    return this.http.get(this.API_URL + 'alamat/?page=' + id).pipe();
  }
  alamatSingle(id,berat){
    return this.http.get(this.API_URL + 'getalamat/' + id + '/' + berat).pipe();
  }

  rekeningLoad(id){
    return this.http.get(this.API_URL + 'rekening/?page=' + id).pipe();
  }
  rekeningSingle(id){
    return this.http.get(this.API_URL + 'getrekening/' + id).pipe();
  }

  lacakPaket(id){
    return this.http.get(this.API_URL + 'lacakiriman/?trx=' + id).pipe();
  }

  profilLoad(){
    return this.http.get(this.API_URL + 'profil');
  }

  pesananLoad(id){
    return this.http.get(this.API_URL + 'pesanan/?page=' + id).pipe();
  }
  pesananSingle(id){
    return this.http.get(this.API_URL + 'pesanansingle/' + id).pipe();
  }

  getProdukSingle(id) {
    return this.http.get(this.API_URL + 'produksingle?pid=' + id).pipe();
  }
  getSize(id,proid) {
    return this.http.get(this.API_URL + 'size?pid=' + id + '&proid=' + proid).pipe();
  }
}