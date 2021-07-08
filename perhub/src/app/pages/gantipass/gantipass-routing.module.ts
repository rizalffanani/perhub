import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { GantipassPage } from './gantipass.page';

const routes: Routes = [
  {
    path: '',
    component: GantipassPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class GantipassPageRoutingModule {}
