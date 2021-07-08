import {
    HttpRequest,
    HttpHandler,
    HttpEvent,
    HttpInterceptor,
    HttpResponse,
    HttpErrorResponse
  } from '@angular/common/http';
import { Observable, throwError, from } from 'rxjs';
import { map, catchError, switchMap } from 'rxjs/operators';
import { Router } from '@angular/router';
import { ToastController } from '@ionic/angular';
import { Injectable } from '@angular/core';
import { Storage } from '@ionic/storage';
import { AlertService } from 'src/app/services/alert.service';

@Injectable()
export class TokenInterceptor implements HttpInterceptor {

    constructor(private router: Router,
        private storage: Storage,
        private alertService: AlertService,
        public toastController: ToastController) {}

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

      return from(this.storage.get("token"))
      .pipe(
          switchMap(token => {
            if (token) {
              request = request.clone({
                headers: request.headers.set('Authorization', token)
              });
            }
          
            if (!request.headers.has('Content-Type')) {
                request = request.clone({
                    setHeaders: {
                      'content-type': 'application/json'
                    }
                });
            }
              
            request = request.clone({
                headers: request.headers.set('Accept', 'application/json')
            });
              
            return next.handle(request).pipe(
                map((event: HttpEvent<any>) => {
                    if (event instanceof HttpResponse) {
                      console.log('event--->>>', event);
                    }
                    return event;
                }),
                catchError((error: HttpErrorResponse) => {
                    if (error.status === 401) {
                      this.storage.remove("token");
                      this.alertService.presentToast('Login failed');
                      this.router.navigate(['landing']);
                    }else if (error.status === 404) {
                      this.alertService.presentToast("Versi aplikasi kadaluarsa, silahkan update aplikasi Anda ke versi yang terbaru");
                      this.storage.remove("token");
                      this.router.navigate(['landing']);
                    }else if(error.status >= 500){
                      this.alertService.presentToast("Server sedang dalam pengembangan, apabila telah berlansung lama hubungi Customer Service");
                    }
                    return throwError(error);
                })
            );
          }
        ))

    }

}