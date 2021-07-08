import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BayarpesananPage } from './bayarpesanan.page';

describe('BayarpesananPage', () => {
  let component: BayarpesananPage;
  let fixture: ComponentFixture<BayarpesananPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BayarpesananPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BayarpesananPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
