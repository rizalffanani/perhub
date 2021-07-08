import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { LacakpaketPage } from './lacakpaket.page';

const routes: Routes = [
  {
    path: '',
    component: LacakpaketPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class LacakpaketPageRoutingModule {}
