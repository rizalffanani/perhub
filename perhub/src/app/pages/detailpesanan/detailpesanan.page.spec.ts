import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailpesananPage } from './detailpesanan.page';

describe('DetailpesananPage', () => {
  let component: DetailpesananPage;
  let fixture: ComponentFixture<DetailpesananPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailpesananPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailpesananPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
