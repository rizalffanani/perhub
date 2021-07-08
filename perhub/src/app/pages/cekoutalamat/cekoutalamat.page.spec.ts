import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CekoutalamatPage } from './cekoutalamat.page';

describe('CekoutalamatPage', () => {
  let component: CekoutalamatPage;
  let fixture: ComponentFixture<CekoutalamatPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CekoutalamatPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CekoutalamatPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
