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
export class AuthService {

  isLoggedIn = false;
  serverUP = false;
  token:any;
  dataResult = "error";
  API_URL = "https://localhost/perhubweb/mobileapi/";
  tokenSet: boolean;

  constructor(
    private http: HttpClient,
    private storage: Storage,
    private navCtrl: NavController,
    private alerts: AlertService
  ) {
    this.getToken();
    this.cekLogin();
  }

  lupa(email: String) {
    return this.http.post(this.API_URL + 'lupa',
      {email: email}
    ).pipe(
      tap(token => {
        return token;
      }),
    );
  }

  login(email: String, password: String) {
    return this.http.post(this.API_URL + 'login',
      {email: email, password: password}
    ).pipe(
      tap(token => {
        if(token['success'] == true){
          this.storage.remove("token");
          this.storage.remove("data");
          this.storage.set('token', token['token']);
          this.storage.set('data', token);
          this.token = token;
          this.isLoggedIn = true;
        }else{
          this.isLoggedIn = false;
        }
        return token;
      }),
    );
  }

  updateDetail() {
    return this.http.get(this.API_URL + 'userdetail').pipe(
      tap(token => {
        this.storage.remove("data");
        //this.storage.set('token', token['token']);
        this.storage.set('data', token);
      }),
    );
  }

  register(nama: String, email: String, password: String, nohp: String) {
    return this.http.post(this.API_URL + 'register',
      {'nama': nama, 'email': email, 'password': password, 'nohp': nohp}
    )
  }

  logout() {
    return this.http.get(this.API_URL + 'logout')
    .pipe(
      tap(data => {
        if(data['success'] == true){
          this.storage.remove("data");
          this.storage.remove("token");
          this.isLoggedIn = false;
          delete this.token;
          this.alerts.presentToast("Anda sudah keluar, untuk mengakses informasi produk dan pesanan silahkan login kembali");
          return data;
        }else{
          this.alerts.presentToast("Gagal logout! ulangi beberapa saat lagi");
        }
      })
    )
  }

  user() {
    return this.http.get(this.API_URL + 'user')
    .pipe(
      tap(
        user => {
          if(user){
            return user;
          }else{
            this.storage.remove("token");
            this.navCtrl.navigateRoot('/');
          }
        }
      )
    )
  }

  getToken() {
    return this.storage.get('token').then(
      data => {
        this.token = data;
        if(this.token != null) {
          this.tokenSet=true;
        } else {
          this.tokenSet=false;
          this.cekToken();
        }
      },
      error => {
        this.token = null;
        this.tokenSet=false;
        this.cekToken();
      }
    );
  }
  cekLogin(){
    return this.storage.get('data').then(
      data => {
        if(data != null) {
          if(data['usrid'] != 0) {
            this.isLoggedIn=true;
          } else {
            this.isLoggedIn=false;
          }
        } else {
          this.isLoggedIn=false;
        }
      },
      error => {
        this.isLoggedIn=false;
      }
    );
  }

  cekToken() {
    console.log("getting token from server...");
    return this.http.get(this.API_URL + 'getsessiontoken');
    /*.subscribe(token => {
        if(token['success'] == true){
          console.log("getting token from server: success");
          this.storage.set('token', token['token']);
          this.storage.set('data', token);
          this.token = token;
          this.tokenSet = true;
        }else{
          console.log("getting token from server: failed");
          this.tokenSet = false;
        }
        return token;
      }
    )*/
  }
}