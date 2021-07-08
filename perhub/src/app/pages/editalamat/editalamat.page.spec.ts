import { CUSTOM_ELEMENTS_SCHEMA } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { EditalamatPage } from './editalamat.page';

describe('EditalamatPage', () => {
  let component: EditalamatPage;
  let fixture: ComponentFixture<EditalamatPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditalamatPage ],
      schemas: [CUSTOM_ELEMENTS_SCHEMA],
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(EditalamatPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
