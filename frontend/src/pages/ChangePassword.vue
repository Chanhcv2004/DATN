<template>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <img src="../assets/images/avatar-1.jpg" class="avatar" alt="Avatar" />
                <h2 class="username">{{ personalInfo.name }}</h2>
                <p class="email">{{ personalInfo.email }}</p>
            </div>
            <nav class="menu">
                <div class="menu-title">Tài khoản</div>
                <ul class="menu-list">
                    <li class="menu-item">Thông tin cá nhân</li>
                    <li class="menu-item active">Đổi mật khẩu</li>
                    <li class="menu-item">Đăng xuất</li>
                </ul>
                <div class="menu-title">Đơn hàng</div>
                <ul class="menu-list">
                    <li class="menu-item">Lịch sử</li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main">
            <h1 class="title">ĐỔI MẬT KHẨU</h1>
            <form class="form" @submit.prevent="updateChangePassword">
                <div class="form-group">
                    <input type="password" v-model="changePassword.currentPassword" placeholder="Mật khẩu hiện tại"
                        class="form-input" />
                    <div v-if="errors.currentPassword" class="error-text">{{ errors.currentPassword }}</div>
                </div>
                <div class="form-group">
                    <input type="password" v-model="changePassword.newPassword" placeholder="Mật khẩu mới"
                        class="form-input" />
                    <div v-if="errors.newPassword" class="error-text">{{ errors.newPassword }}</div>
                </div>
                <div class="form-group">
                    <input type="password" v-model="changePassword.newPassword_confirmation"
                        placeholder="Xác nhận mật khẩu mới" class="form-input" />
                    <div v-if="errors.newPassword_confirmation" class="error-text">{{ errors.newPassword_confirmation }}
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Xác nhận</button>
                </div>
            </form>
        </main>
    </div>
    <div id="toast" v-if="toastMessage" v-html="toastContent"></div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

const personalInfo = ref({
    name: '',
    phone: '',
    email: '',
    address: ''
});

const errors = reactive({
    currentPassword: '',
    newPassword: '',
    newPassword_confirmation: ''
});

const changePassword = ref({
    currentPassword: '',
    newPassword: '',
    newPassword_confirmation: ''
});

const toastMessage = ref(false);
const toastContent = ref("");

const userLogin = JSON.parse(localStorage.getItem('user'));

const showToast = (type, icon, title, message) => {
  toastContent.value =
    `
            <div class="toast toast--${type}">
                    <div class="toast__icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">${title}</h3>
                        <p class="toast__msg">${message}</p>
                    </div>
                    <div class="toast__close" onclick="this.parentElement.remove()">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                </div>
            `;
  toastMessage.value = true;
}

const getPersonalInfo = async () => {
    try {
        const response = await axios.get('http://localhost:8000/api/getPersonal/' + userLogin.id);
        const personal = response.data.Personal;
        personalInfo.value.name = personal.name_user;
        personalInfo.value.phone = personal.phone;
        personalInfo.value.email = personal.email;
        personalInfo.value.address = personal.address;
    } catch (error) {
        const errors = error;
    }
}

const updateChangePassword = async () => {
    try {
        const response = await axios.post('http://localhost:8000/api/changePassword', {
            id: userLogin.id,
            currentPassword: changePassword.value.currentPassword,
            newPassword: changePassword.value.newPassword,
            newPassword_confirmation: changePassword.value.newPassword_confirmation,
        });
        showToast('success', 'fa-solid fa-check-circle', 'Thành công', response.data.message);
        setTimeout(() => {
            toastMessage.value = false;
            errors.currentPassword = '';
            errors.newPassword = '';
            errors.newPassword_confirmation = '';
        }, 3000)
        console.log('thành công:', response.data);
    } catch (error) {
        console.log(error);
        const serverErrors = error.response.data.errors;


        errors.currentPassword = error.response.data.message;
        

        errors.newPassword = serverErrors.newPassword[0];
        errors.newPassword_confirmation = serverErrors.newPassword[0];



    }
}
onMounted(() => {
    getPersonalInfo()
});
</script>

<style scoped>
.container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
}

/* Sidebar */
.sidebar {
    width: 350px;
    background-color: #ffffff;
    padding: 32px;
    box-shadow: 2px 0 6px rgba(0, 0, 0, 0.05);
}

.profile {
    text-align: center;
    margin-bottom: 32px;
}

.avatar {
    width: 80px;
    height: 80px;
    display: block;
    margin: 0 auto;
    border-radius: 9999px;
}

.username {
    margin-top: 12px;
    font-weight: 600;
}

.email {
    font-size: 2rem;
    color: #6b7280;
}

.menu-title {
    font-size: 2rem;
    font-weight: 600;
    color: #374151;
    margin-top: 12px;
}

.menu-list {
    list-style: none;
    padding-left: 16px;
    margin-top: 8px;
}

.menu-item {
    font-size: 1.9rem;
    color: #4b5563;
    margin: 6px 0;
    cursor: pointer;
}



.menu-item:hover {
    color: #2563eb;
}

.form-group {
    margin-bottom: 5px;
}

.error-text {
    color: red;
    font-size: 1.4rem;
    margin-top: 4px;
}

.menu-item.active {
    color: #ef4444;
    font-weight: 500;
}

/* Main */
.main {
    flex: 1;
    padding: 60px 40px;
}

.title {
    font-size: 2rem;
    font-weight: 600;
    color: #1e3a8a;
    margin-bottom: 32px;
}

.form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    max-width: 720px;
}

.form-input {
    padding: 14px 18px;
    width: 450px;
    font-size: 1.9rem;
    border: 1px solid black;
}

.form-actions {
    grid-column: span 2;
    display: flex;
    justify-content: flex-end;
}

.submit-btn {
    background-color: #f87171;
    color: white;
    padding: 12px 30px;
    font-size: 1.9rem;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    cursor: pointer;
}

.submit-btn:hover {
    background-color: #ef4444;
}
</style>
