import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ModalchatPage } from './modalchat.page';

describe('ModalchatPage', () => {
  let component: ModalchatPage;
  let fixture: ComponentFixture<ModalchatPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalchatPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ModalchatPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
