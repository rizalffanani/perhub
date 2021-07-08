import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { RekeningPageRoutingModule } from './rekening-routing.module';

import { RekeningPage } from './rekening.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    RekeningPageRoutingModule
  ],
  declarations: [RekeningPage]
})
export class RekeningPageModule {}
