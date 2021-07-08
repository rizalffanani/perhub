import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { GetokenPage } from './getoken.page';

const routes: Routes = [
  {
    path: '',
    component: GetokenPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class GetokenPageRoutingModule {}
