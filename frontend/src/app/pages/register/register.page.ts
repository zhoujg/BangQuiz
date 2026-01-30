import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { ApiService } from '../../services/api.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss']
})
export class RegisterPage {
  name: string = '';
  email: string = '';
  password: string = '';
  passwordConfirmation: string = '';
  errorMessage: string = '';
  isLoading: boolean = false;

  constructor(
    private router: Router,
    private apiService: ApiService
  ) {}

  register() {
    if (!this.name || !this.email || !this.password || !this.passwordConfirmation) {
      this.errorMessage = '请填写所有字段';
      return;
    }

    if (this.password !== this.passwordConfirmation) {
      this.errorMessage = '两次密码输入不一致';
      return;
    }

    if (this.password.length < 8) {
      this.errorMessage = '密码至少需要8个字符';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    this.apiService.register(this.name, this.email, this.password).subscribe({
      next: (response) => {
        // 保存token
        localStorage.setItem('auth_token', response.token);
        localStorage.setItem('user', JSON.stringify(response.user));
        
        // 跳转到首页
        this.router.navigate(['/home']);
      },
      error: (error) => {
        this.isLoading = false;
        this.errorMessage = error.error?.message || '注册失败，请稍后重试';
      }
    });
  }

  goToLogin() {
    this.router.navigate(['/login']);
  }
}
