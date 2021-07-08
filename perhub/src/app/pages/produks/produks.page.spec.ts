import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ProduksPage } from './produks.page';

describe('ProduksPage', () => {
  let component: ProduksPage;
  let fixture: ComponentFixture<ProduksPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ProduksPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ProduksPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
