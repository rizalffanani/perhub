import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LupapasswordPage } from './lupapassword.page';

describe('LupapasswordPage', () => {
  let component: LupapasswordPage;
  let fixture: ComponentFixture<LupapasswordPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LupapasswordPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LupapasswordPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
