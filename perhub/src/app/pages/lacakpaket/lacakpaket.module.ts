import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { LacakpaketPageRoutingModule } from './lacakpaket-routing.module';

import { LacakpaketPage } from './lacakpaket.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    LacakpaketPageRoutingModule
  ],
  declarations: [LacakpaketPage]
})
export class LacakpaketPageModule {}
