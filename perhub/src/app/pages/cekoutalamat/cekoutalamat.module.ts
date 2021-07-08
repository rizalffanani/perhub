import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { IonicModule } from '@ionic/angular';

import { CekoutalamatPage } from './cekoutalamat.page';

const routes: Routes = [
  {
    path: '',
    component: CekoutalamatPage
  }
];

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RouterModule.forChild(routes)
  ],
  declarations: [CekoutalamatPage]
})
export class CekoutalamatPageModule {}
