import { TestBed } from '@angular/core/testing';

import { PostapiService } from './postapi.service';

describe('PostapiService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: PostapiService = TestBed.get(PostapiService);
    expect(service).toBeTruthy();
  });
});
