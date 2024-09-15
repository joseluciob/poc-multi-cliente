import { Injectable } from '@angular/core';
import {
  HttpInterceptor,
  HttpRequest,
  HttpHandler,
  HttpEvent,
} from '@angular/common/http';
import { Observable } from 'rxjs';
import { SubdomainService } from '../services/subdomain.service';

@Injectable()
export class SubdomainInterceptor implements HttpInterceptor {

  constructor(private subdomainService: SubdomainService) {}

  intercept(
    req: HttpRequest<any>,
    next: HttpHandler
  ): Observable<HttpEvent<any>> {
    const subdomain = this.subdomainService.getSubdomain();

    const modifiedReq = req.clone({
      setHeaders: {
        'X-Application': subdomain,
      },
      body: {
        ...req.body,
        subdomain,
      },
    });

    return next.handle(modifiedReq);
  }
}
