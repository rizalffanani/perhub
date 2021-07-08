import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { GetokenPageRoutingModule } from './getoken-routing.module';

import { GetokenPage } from './getoken.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    GetokenPageRoutingModule
  ],
  declarations: [GetokenPage]
})
export class GetokenPageModule {}
