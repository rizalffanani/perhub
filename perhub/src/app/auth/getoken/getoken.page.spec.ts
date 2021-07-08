import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { GetokenPage } from './getoken.page';

describe('GetokenPage', () => {
  let component: GetokenPage;
  let fixture: ComponentFixture<GetokenPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GetokenPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(GetokenPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
