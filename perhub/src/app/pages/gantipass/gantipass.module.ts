import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { GantipassPageRoutingModule } from './gantipass-routing.module';

import { GantipassPage } from './gantipass.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ReactiveFormsModule,
    GantipassPageRoutingModule
  ],
  declarations: [GantipassPage]
})
export class GantipassPageModule {}
