<template>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="profile">
                <img src="../assets/images/product-6.jpg" class="avatar" alt="Avatar" />
                <h2 class="username">{{ personalInfo.name }}</h2>
                <p class="email">{{ personalInfo.email }}</p>
            </div>
            <nav class="menu">
                <div class="menu-title">Tài khoản</div>
                <ul class="menu-list">
                    <li class="menu-item active">Thông tin cá nhân</li>
                    <li class="menu-item">Đổi mật khẩu</li>
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
            <h1 class="title">THÔNG TIN CÁ NHÂN</h1>
            <form class="form" @submit.prevent="updatePersonal">
                <div class="form-group">
                    <input type="text" v-model="personalInfo.name" placeholder="Triệu Quân Sự" class="form-input" />
                <div v-if="errors.name" class="error-text">{{ errors.name[0] }}</div>
                </div>
                <div class="form-group">
                    <input type="text" v-model="personalInfo.phone" placeholder="Nhập số điện thoại" class="form-input" />
                    <div v-if="errors.phone" class="error-text">{{ errors.phone[0] }}</div>
                </div>
                <div class="form-group">
                    <input type="email" v-model="personalInfo.email" disabled placeholder="Gmail" class="form-input" />
                </div>
                <div class="form-group">
                    <input type="text" v-model="personalInfo.address" placeholder="Nhập địa chỉ: 1113/Q.12/TP. HCM" class="form-input" />
                    <div v-if="errors.address" class="error-text">{{ errors.address[0] }}</div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Cập nhật</button>
                </div>
            </form>
        </main>
    </div>
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
    name: '',
    phone: '',
    address: ''
});
const userLogin = JSON.parse(localStorage.getItem('user'));
console.log(userLogin.id);

const getPersonalInfo = async () => {
    try {
        const response = await axios.get ('http://localhost:8000/api/getPersonal/' + userLogin.id);
        const personal = response.data.Personal;
        personalInfo.value.name = personal.name_user;
        personalInfo.value.phone = personal.phone;
        personalInfo.value.email = personal.email;
        personalInfo.value.address = personal.address;
    } catch (error) {
        const errors = error;
    }
}
const updatePersonal = async () => {
    try {
        const response = await axios.post('http://localhost:8000/api/updatePersonal', {
        id: userLogin.id,
        name: personalInfo.value.name,
        phone: personalInfo.value.phone,
        address: personalInfo.value.address,
    });
    console.log('thành công', response.data);
    getPersonalInfo();
    } catch (error) {
        if (error.response && error.response.status === 422) {
            // Laravel validation error
            const serverErrors = error.response.data.errors;
            errors.name = serverErrors.name;
            errors.phone = serverErrors.phone;
            errors.address = serverErrors.address;
        } else {
            console.log('Lỗi khác:', error);
        }
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
    text-align: right;
    display: flex;
    justify-content: flex-end;
}

.form-group {
    margin-bottom: 5px;
}

.error-text {
    color: red;
    font-size: 1.4rem;
    margin-top: 4px;
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
