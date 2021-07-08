import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { BayarprosesmidtransPageRoutingModule } from './bayarprosesmidtrans-routing.module';

import { BayarprosesmidtransPage } from './bayarprosesmidtrans.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    BayarprosesmidtransPageRoutingModule
  ],
  declarations: [BayarprosesmidtransPage]
})
export class BayarprosesmidtransPageModule {}
