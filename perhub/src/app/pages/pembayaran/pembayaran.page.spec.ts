import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PembayaranPage } from './pembayaran.page';

describe('PembayaranPage', () => {
  let component: PembayaranPage;
  let fixture: ComponentFixture<PembayaranPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PembayaranPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PembayaranPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
