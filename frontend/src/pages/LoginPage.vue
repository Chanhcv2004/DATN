<template>
  <section class="auth-section section">
    <div class="container">
      <div class="auth-container">
        <div class="auth-form-container">
          <h2 class="auth-title">Đăng Nhập / Đăng Ký</h2>
          <div class="auth-tabs">
            <button class="auth-tab-btn" :class="{ active: activeTab === 'login' }" @click="switchTab('login')">Đăng Nhập</button>
            <button class="auth-tab-btn" :class="{ active: activeTab === 'register' }" @click="switchTab('register')">Đăng Ký</button>
          </div>
          <form class="auth-form" :class="{ active: activeTab === 'login' }" id="login-form" @submit.prevent="handleSubmit('login')">
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" class="form-input" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
              <label class="form-label">Mật khẩu</label>
              <input type="password" class="form-input" placeholder="Nhập mật khẩu" required>
            </div>
            <button type="submit" class="btn form-submit">Đăng Nhập</button>
            <a href="#" class="form-link">Quên mật khẩu?</a>
          </form>
          <form class="auth-form" :class="{ active: activeTab === 'register' }" id="register-form" @submit.prevent="handleSubmit('register')">
            <div class="form-group">
              <label class="form-label">Họ và tên</label>
              <input type="text" class="form-input" placeholder="Nhập họ và tên" required>
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" class="form-input" placeholder="Nhập email của bạn" required>
            </div>
            <div class="form-group">
              <label class="form-label">Mật khẩu</label>
              <input type="password" class="form-input" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="form-group">
              <label class="form-label">Xác nhận mật khẩu</label>
              <input type="password" class="form-input" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit" class="btn form-submit">Đăng Ký</button>
          </form>
        </div>
        <div class="auth-image"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref } from 'vue'

const activeTab = ref('login')

const switchTab = (tab) => {
  activeTab.value = tab
}

const handleSubmit = (formType) => {
  alert(formType === 'login' ? 'Đăng nhập thành công!' : 'Đăng ký thành công!')
}
</script>

<style scoped>
.auth-section {
  padding: 60px 0;
  background-color: #f5f5f5;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.auth-container {
  display: flex;
  background: white;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  overflow: hidden;
  max-width: 900px;
  margin: 0 auto;
}

.auth-form-container {
  flex: 1;
  padding: 40px;
}

.auth-image {
  flex: 1;
  background: url('./src/assets/images/insta-1.jpg') center/cover no-repeat;
  min-height: 400px;
}

.auth-title {
  font-size: 28px;
  font-weight: 600;
  text-align: center;
  margin-bottom: 20px;
  color: rgb(255, 110, 97);
}

.auth-tabs {
  display: flex;
  border-bottom: 2px solid #ddd;
  margin-bottom: 30px;
}

.auth-tab-btn {
  flex: 1;
  padding: 15px;
  background: none;
  border: none;
  font-size: 16px;
  font-weight: 500;
  color: #666;
  cursor: pointer;
  transition: color 0.3s ease;
}

.auth-tab-btn.active {
  color: rgb(255, 110, 97);
  border-bottom: 2px solid rgb(255, 110, 97);
}

.auth-form {
  display: none;
}

.auth-form.active {
  display: block;
}

.form-group {
  margin-bottom: 20px;
}

.form-label {
  display: block;
  font-size: 14px;
  font-weight: 500;
  color: rgb(255, 110, 97);
  margin-bottom: 8px;
}

.form-input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

.form-input:focus {
  outline: none;
  border-color: rgb(255, 110, 97);
}

.form-submit {
  width: 100%;
  padding: 14px;
  background: rgb(255, 110, 97);
  color: white;
  border: 1px solid transparent;
  border-radius: 6px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  transition: background 0.3s ease, color 0.3s ease, border 0.3s ease;
  display: flex;
  justify-content: center;
  align-items: center;
}

.form-submit:hover {
  color: rgb(255, 110, 97);
  background: none;
  border: 1px solid rgb(255, 110, 97);
}

.form-link {
  display: block;
  text-align: center;
  margin-top: 15px;
  color: rgb(255, 110, 97);
  font-size: 14px;
  text-decoration: none;
}

.form-link:hover {
  text-decoration: underline;
}

/* Responsive */
@media (max-width: 768px) {
  .auth-container {
    flex-direction: column;
  }

  .auth-image {
    display: none;
  }

  .auth-form-container {
    padding: 20px;
  }

  .auth-title {
    font-size: 24px;
  }
}
</style>