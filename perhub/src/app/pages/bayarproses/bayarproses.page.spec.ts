import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { BayarprosesPage } from './bayarproses.page';

describe('BayarprosesPage', () => {
  let component: BayarprosesPage;
  let fixture: ComponentFixture<BayarprosesPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BayarprosesPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(BayarprosesPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
