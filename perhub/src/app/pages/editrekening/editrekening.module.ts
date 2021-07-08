import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { EditrekeningPageRoutingModule } from './editrekening-routing.module';

import { EditrekeningPage } from './editrekening.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    ReactiveFormsModule,
    EditrekeningPageRoutingModule
  ],
  declarations: [EditrekeningPage]
})
export class EditrekeningPageModule {}
