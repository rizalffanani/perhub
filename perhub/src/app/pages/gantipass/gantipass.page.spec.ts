import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { GantipassPage } from './gantipass.page';

describe('GantipassPage', () => {
  let component: GantipassPage;
  let fixture: ComponentFixture<GantipassPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GantipassPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(GantipassPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
