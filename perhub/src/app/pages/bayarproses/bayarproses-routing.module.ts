import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { BayarprosesPage } from './bayarproses.page';

const routes: Routes = [
  {
    path: '',
    component: BayarprosesPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class BayarprosesPageRoutingModule {}
