import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class SubdomainService {
  getSubdomain(): string {
    const host = window.location.hostname; // Ex: app1.locaauto.com.br ou locaauto.com.br
    const parts = host.split('.');
    if (parts.length > 2) {
      return parts[0];
    }
    return '';
  }
}
