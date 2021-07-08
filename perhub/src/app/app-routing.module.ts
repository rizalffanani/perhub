import { NgModule } from '@angular/core';
import { PreloadAllModules, RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './guard/auth.guard';
import { TokenGuard } from './guard/token.guard';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./tabs/tabs.module').then(m => m.TabsPageModule),
    canActivate: [TokenGuard]
  },
  { path: 'login', loadChildren: './auth/login/login.module#LoginPageModule' },
  { path: 'signup', loadChildren: './auth/signup/signup.module#SignupPageModule' },
  { path: 'lupapassword', loadChildren: './auth/lupapassword/lupapassword.module#LupapasswordPageModule' },
  { path: 'kategori/:id', loadChildren: './pages/kategori/kategori.module#KategoriPageModule' },
  { path: 'produks/:id', loadChildren: './pages/produks/produks.module#ProduksPageModule' },
  { path: 'cekout', loadChildren: './pages/cekout/cekout.module#CekoutPageModule', canActivate: [AuthGuard] },
  { path: 'chat', loadChildren: './pages/chat/chat.module#ChatPageModule', canActivate: [AuthGuard] },
  { path: 'pembayaran', loadChildren: './pages/pembayaran/pembayaran.module#PembayaranPageModule', canActivate: [AuthGuard] },
  { path: 'detailpesanan/:id', loadChildren: './pages/detailpesanan/detailpesanan.module#DetailpesananPageModule', canActivate: [AuthGuard] },
  { path: 'alamat', loadChildren: './pages/alamat/alamat.module#AlamatPageModule', canActivate: [AuthGuard] },
  { path: 'cekoutalamat', loadChildren: './pages/cekoutalamat/cekoutalamat.module#CekoutalamatPageModule', canActivate: [AuthGuard] },
  { path: 'editalamat/:id', loadChildren: './pages/editalamat/editalamat.module#EditalamatPageModule', canActivate: [AuthGuard] },
  { path: 'tambahalamat/:id', loadChildren: './pages/tambahalamat/tambahalamat.module#TambahalamatPageModule', canActivate: [AuthGuard] },
  { path: 'bayarpesanan/:id', loadChildren: './pages/bayarpesanan/bayarpesanan.module#BayarpesananPageModule', canActivate: [AuthGuard] },
  {
    path: 'profil',
    loadChildren: () => import('./pages/profil/profil.module').then( m => m.ProfilPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'rekening',
    loadChildren: () => import('./pages/rekening/rekening.module').then( m => m.RekeningPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'gantipass',
    loadChildren: () => import('./pages/gantipass/gantipass.module').then( m => m.GantipassPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'editrekening/:id',
    loadChildren: () => import('./pages/editrekening/editrekening.module').then( m => m.EditrekeningPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'lacakpaket/:id',
    loadChildren: () => import('./pages/lacakpaket/lacakpaket.module').then( m => m.LacakpaketPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'getoken',
    loadChildren: () => import('./auth/getoken/getoken.module').then( m => m.GetokenPageModule)
  },
  {
    path: 'bayarproses/:id',
    loadChildren: () => import('./pages/bayarproses/bayarproses.module').then( m => m.BayarprosesPageModule),
    canActivate: [AuthGuard]
  },
  {
    path: 'saldo',
    loadChildren: () => import('./pages/saldo/saldo.module').then( m => m.SaldoPageModule)
  },
  {
    path: 'modalchat',
    loadChildren: () => import('./pages/modalchat/modalchat.module').then( m => m.ModalchatPageModule)
  },
  {
    path: 'bayarprosesmidtrans/:id',
    loadChildren: () => import('./pages/bayarprosesmidtrans/bayarprosesmidtrans.module').then( m => m.BayarprosesmidtransPageModule)
  },
  {
    path: 'tab5',
    loadChildren: () => import('./tab5/tab5.module').then( m => m.Tab5PageModule)
  }
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, { preloadingStrategy: PreloadAllModules })
  ],
  exports: [RouterModule]
})
export class AppRoutingModule {}
