import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { LacakpaketPage } from './lacakpaket.page';

describe('LacakpaketPage', () => {
  let component: LacakpaketPage;
  let fixture: ComponentFixture<LacakpaketPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ LacakpaketPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(LacakpaketPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
