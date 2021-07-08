import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { BayarprosesPageRoutingModule } from './bayarproses-routing.module';

import { BayarprosesPage } from './bayarproses.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    BayarprosesPageRoutingModule
  ],
  declarations: [BayarprosesPage]
})
export class BayarprosesPageModule {}
