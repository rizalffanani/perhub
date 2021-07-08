import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { BayarprosesmidtransPage } from './bayarprosesmidtrans.page';

describe('BayarprosesmidtransPage', () => {
  let component: BayarprosesmidtransPage;
  let fixture: ComponentFixture<BayarprosesmidtransPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BayarprosesmidtransPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(BayarprosesmidtransPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
