import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { RekeningPage } from './rekening.page';

const routes: Routes = [
  {
    path: '',
    component: RekeningPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class RekeningPageRoutingModule {}
