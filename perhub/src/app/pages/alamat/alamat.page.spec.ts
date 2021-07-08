import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AlamatPage } from './alamat.page';

describe('AlamatPage', () => {
  let component: AlamatPage;
  let fixture: ComponentFixture<AlamatPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AlamatPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AlamatPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
