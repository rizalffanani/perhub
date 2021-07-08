import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, CanActivate, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../auth/auth.service';
import { Storage } from '@ionic/storage';

@Injectable({
  providedIn: 'root'
})
export class TokenGuard implements CanActivate {
  constructor(
    private router: Router,
    private storage: Storage,
    private auth: AuthService,
    private authService: AuthService) {}

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean> | Promise<boolean> | boolean {
    
    return this.storage.get('token').then(
      data => {
        if(data != null) {
          return true;
        } else {
          this.router.navigate(["/getoken"]);
        }
      },
      error => {
        this.router.navigate(["/getoken"]);
        return false;
      }
    );
  }
}
