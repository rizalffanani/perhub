import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CekoutPage } from './cekout.page';

describe('CekoutPage', () => {
  let component: CekoutPage;
  let fixture: ComponentFixture<CekoutPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CekoutPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CekoutPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
