import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TambahalamatPage } from './tambahalamat.page';

describe('TambahalamatPage', () => {
  let component: TambahalamatPage;
  let fixture: ComponentFixture<TambahalamatPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TambahalamatPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TambahalamatPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
