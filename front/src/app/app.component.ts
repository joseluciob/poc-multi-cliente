import { Component, OnInit } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { SubdomainService } from './core/services/subdomain.service';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent implements OnInit {
  title = 'front';
  subdomain: string = ''; 

  constructor(private subdomainService: SubdomainService) {}

  ngOnInit(): void {
    const subdomain = this.subdomainService.getSubdomain();
    this.subdomain = subdomain; // Armazena o subdomínio na variável do componente
  }
}