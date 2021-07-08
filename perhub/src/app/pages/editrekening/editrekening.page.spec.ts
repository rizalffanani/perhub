import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { EditrekeningPage } from './editrekening.page';

describe('EditrekeningPage', () => {
  let component: EditrekeningPage;
  let fixture: ComponentFixture<EditrekeningPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ EditrekeningPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(EditrekeningPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
