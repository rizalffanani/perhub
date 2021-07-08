import { TestBed } from '@angular/core/testing';

import { GetapiService } from './getapi.service';

describe('GetapiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: GetapiService = TestBed.get(GetapiService);
    expect(service).toBeTruthy();
  });
});
