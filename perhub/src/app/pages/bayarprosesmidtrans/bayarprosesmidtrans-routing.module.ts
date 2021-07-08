import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BayarprosesmidtransPage } from './bayarprosesmidtrans.page';

const routes: Routes = [
  {
    path: '',
    component: BayarprosesmidtransPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class BayarprosesmidtransPageRoutingModule {}
