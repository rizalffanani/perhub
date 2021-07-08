import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { EditrekeningPage } from './editrekening.page';

const routes: Routes = [
  {
    path: '',
    component: EditrekeningPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class EditrekeningPageRoutingModule {}
