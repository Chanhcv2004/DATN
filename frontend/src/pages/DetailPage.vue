<template>
  <section class="product-detail-section">
    <div class="container">
      <div class="product-detail-container">
        <div class="product-images">
          <div class="main-image">
            <img v-if="selectedImage" :src="'../src/assets/images/' + selectedImage" alt="Ảnh sản phẩm"
              class="product-img">
          </div>
          <div class="variant-images">
            <div class="variant" :class="{ active: selectedImage === img.url }"
              v-for="(img, index) in dataProduct.images" :key="index" @click="selectedImage = img.url">
              <img :src="'../src/assets/images/' + img.url" :alt="'Variant ' + index">
            </div>
          </div>

        </div>
        <div class="product-info">
          <p class="product-category">Giày thể thao</p>
          <h2 class="product-title">{{ dataProduct.product_name }}</h2>
          <div class="product-price">
            <span class="current-price">{{ dataProduct.sale_price }}₫</span>
            <span class="old-price">{{ dataProduct.price_original }}₫</span>
          </div>
          <p class="product-description">
            {{ dataProduct.description }}
          </p>
          <div class="totalStock-selection">
            <h3 class="totaStock-title">Tổng số lượng còn: </h3>
            <span>{{ totalStock }}</span>
          </div>

          <div class="size-selection">
            <h3 class="size-title">Chọn kích thước</h3>
            <div class="size-options">
              <button class="size-option" v-for="(variant_item, index) in dataProduct.variants" :key="index">{{
                variant_item.size }}</button>
            </div>
          </div>
          <div class="quantity-selection">
            <h3 class="quantity-title">Số lượng</h3>
            <div class="quantity-input">
              <button class="quantity-btn">-</button>
              <input type="number" value="1" min="1" max="10">
              <button class="quantity-btn">+</button>
            </div>
          </div>
          <button class="add-to-cart btn btn-primary">Thêm vào giỏ</button>
        </div>
      </div>
      <div class="comments-section">
        <h2 class="comments-title">Bình Luận</h2>
        <div class="comment-list">
          <div class="comment-item" v-for="(item_comment, index) in dataCommentByProduct" :key="index">
            <div class="comment-header">
              <span class="comment-author">{{ item_comment.name_user }}</span>
              <span class="comment-date">{{ item_comment.created_at }}</span>
            </div>
            <p class="comment-text">{{ item_comment.comment_content }}</p>
          </div>
        </div>
        <div class="comment-form">
          <div class="form-group">
            <label for="comment-text">Bình Luận</label>
            <textarea id="comment-text" name="comment-text" v-model="commentForm.comment" placeholder="Nhập bình luận của bạn"
              required></textarea>
          </div>
          <div class="bellErrorComment" v-if="!flagComment">Vui Lòng Đăng Nhập Để Bình Luận</div>
          <button class="btn btn-primary" @click="sendComment">Gửi Bình Luận</button>
        </div>
      </div>
      <div class="related-products">
        <h2 class="related-products-title">Sản phẩm liên quan</h2>
        <div class="related-products-grid">
          <article class="product-card" v-for="(item_relatedProduct, index) in dataRelatedProduct" :key="index">
            <div class="card-banner">
              <span class="card-badge">Sale</span>
              <img :src="'../src/assets/images/' + item_relatedProduct.images[0].url" alt="Puma RS-X" class="product-img">
              <ul class="card-action-list">
                <li class="card-action-item">
                  <button class="card-action-btn" aria-labelledby="card-label-10">
                    <ion-icon name="cart-outline"></ion-icon>
                  </button>
                  <div class="card-action-tooltip" id="card-label-10">Thêm vào giỏ hàng</div>
                </li>
                <li class="card-action-item">
                  <button class="card-action-btn" aria-labelledby="card-label-11">
                    <ion-icon name="heart-outline"></ion-icon>
                  </button>
                  <div class="card-action-tooltip" id="card-label-11">Thêm vào yêu thích</div>
                </li>
                <li class="card-action-item">
                  <button class="card-action-btn" aria-labelledby="card-label-12">
                    <ion-icon name="eye-outline"></ion-icon>
                  </button>
                  <div class="card-action-tooltip" id="card-label-12">Xem chi tiết</div>
                </li>
              </ul>
            </div>
            <div class="card-content">
              <p class="card-category">{{ item_relatedProduct.category.category_name }}</p>
              <h3 class="card-title">{{ item_relatedProduct.product_name }}</h3>
              <div class="card-price">
                <span class="current-price">{{ item_relatedProduct.sale_price }}</span>
                <span class="old-price">{{ item_relatedProduct.price_original }}</span>
              </div>
              <button class="add-to-cart btn btn-primary">Thêm vào giỏ</button>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
  <div id="toast" v-if="toastMessage" v-html="toastContent"></div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, computed, reactive } from 'vue';
import { useRoute } from 'vue-router';

const route = useRoute();
const productId = route.params.id;

// Khởi tạo đối tượng chứa toàn bộ dữ liệu trả về
const dataProduct = ref({});
const selectedImage = ref('');
const commentForm = reactive({
  comment: ''
});
const flagComment = ref(true);
const toastMessage = ref(false);
const toastContent = ref("");
const userLogin = JSON.parse(localStorage.getItem('user'));
const dataCommentByProduct = ref({});
const dataRelatedProduct = ref({});

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

const getDataProducted = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/getDetailProduct/' + productId);
    dataProduct.value = response.data;
    if (dataProduct.value.images?.length) {
      selectedImage.value = dataProduct.value.images[0].url;
    }
    getRelatedProduct();
    console.log('Dữ liệu toàn bộ:', dataProduct.value);
  } catch (error) {
    console.error('Lỗi khi lấy sản phẩm:', error);
  }
}

const getCommentByProducted = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/getCommentByIdProduct/' + productId);
    console.log(response.data);
    dataCommentByProduct.value = response.data;
  } catch(error) {
    console.log(error)
;  }
}

const getRelatedProduct = async () => {
  try {
    const category_id = dataProduct.value.category_id;
    const response = await axios.get('http://127.0.0.1:8000/api/getRelatedProduct/' + category_id);
    console.log('Dữ liệu pro', response.data);
    dataRelatedProduct.value = response.data;
  }catch(error) {
    console.log(error);
  }
}

const totalStock = computed(() => {
  if (!dataProduct.value.variants) return 0;
  return dataProduct.value.variants.reduce((sum, variant) => {
    return sum + variant.stock_quantity;
  }, 0);
});

console.log(userLogin.id);
const sendComment = async () => {
  try {
    if (userLogin || userLogin.id && productId) {
      flagComment.value = true;
      const response = await axios.post(`http://127.0.0.1:8000/api/sendcomment/${ productId }/${ userLogin.id }`, { comment_content: commentForm.comment });
      showToast('success', 'fa-solid fa-check-circle', 'Thành công', 'Đã gửi bình luận');
      setTimeout(() => {
        toastMessage.value = false;
      }, 3000);
    } else {
      flagComment.value = false;
    }
  } catch (error) {
    if (error.response?.status === 422) {
      const errors = error.response.data.errors;
      console.log("Đây là lỗi:", errors);

      const firstError = Object.values(errors)[0][0];
      showToast('error', 'fas fa-exclamation-circle', 'Thất bại', firstError);
    } else {
      showToast('error', 'fas fa-exclamation-circle', 'Lỗi', 'Gửi bình luận thất bại');
    }
  }
  
}


onMounted(() => {
  getDataProducted();
  getCommentByProducted();
});
</script>


<style scoped>
.container {
  padding-inline: 15px;
  max-width: 1280px;
  margin-inline: auto;
}

.product-detail-section {
  padding-block: var(--section-padding);
}

.product-detail-container {
  display: grid;
  grid-template-columns: 1fr;
  gap: 30px;
}

.product-images {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.main-image {
  position: relative;
  height: 400px;
  border-radius: 10px;
  overflow: hidden;
  background: var(--cultured);
}

.main-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition-2);
}

.main-image:hover img {
  transform: scale(1.1);
}

.variant-images {
  display: flex;
  gap: 10px;
  overflow-x: auto;
  padding-bottom: 10px;
}

.bellErrorComment {
  color: red;
  font-size: 12px;
  margin-bottom: 5px;
}

.variant {
  width: 80px;
  height: 80px;
  border-radius: 5px;
  overflow: hidden;
  cursor: pointer;
  border: 2px solid transparent;
  transition: var(--transition-1);
}

.variant.active {
  border-color: var(--bittersweet);
}

.variant img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.product-info {
  padding: 20px;
  background: var(--cultured);
  border-radius: 10px;
}

.product-title {
  font-size: var(--fs-2);
  font-weight: var(--fw-600);
  margin-bottom: 15px;
}

.product-category {
  font-size: var(--fs-8);
  color: var(--onyx);
  text-transform: uppercase;
  margin-bottom: 10px;
}

.product-price {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.current-price {
  font-size: var(--fs-5);
  font-weight: var(--fw-700);
  color: var(--bittersweet);
}

.old-price {
  font-size: var(--fs-7);
  color: var(--gray-x-11-gray);
  text-decoration: line-through;
}

.product-description {
  font-size: var(--fs-7);
  color: var(--onyx);
  line-height: 1.6;
  margin-bottom: 20px;
}

.size-selection {
  margin-bottom: 20px;
}

.variant {
  border: 2px solid transparent;
  cursor: pointer;
}

.variant.active {
  border-color: #007bff;
  /* màu xanh khi được chọn */
}

.totalStock-selection {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.size-title {
  font-size: var(--fs-7);
  font-weight: var(--fw-600);
  margin-bottom: 10px;
}

.totalStock-title {
  font-size: var(--fs-7);
  font-weight: var(--fw-600);
  margin-bottom: 10px;
}

.size-options {
  display: flex;
  gap: 10px;
  flex-wrap: wrap;
}

.size-option {
  padding: 10px 15px;
  border: 1px solid var(--gainsboro);
  border-radius: 5px;
  font-size: var(--fs-7);
  cursor: pointer;
  transition: var(--transition-1);
}

.size-option:hover,
.size-option.active {
  background: var(--bittersweet);
  color: var(--white);
  border-color: var(--bittersweet);
}

.quantity-selection {
  margin-bottom: 20px;
}

.quantity-title {
  font-size: var(--fs-7);
  font-weight: var(--fw-600);
  margin-bottom: 10px;
}

.quantity-input {
  display: flex;
  align-items: center;
  gap: 10px;
  width: 120px;
}

.quantity-btn {
  width: 40px;
  height: 40px;
  background: var(--gainsboro);
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: var(--fs-7);
  transition: var(--transition-1);
}

.quantity-btn:hover {
  background: var(--bittersweet);
  color: var(--white);
}

.quantity-input input {
  padding: 10px;
  border: 1px solid var(--gainsboro);
  border-radius: 5px;
  text-align: center;
  font-size: var(--fs-7);
}

.add-to-cart {
  width: 100%;
  background: var(--bittersweet);
  color: var(--white);
  padding: 12px;
  border-radius: 5px;
  font-size: var(--fs-7);
  font-weight: var(--fw-500);
  transition: var(--transition-1);
}

.add-to-cart:hover {
  background: var(--salmon);
}

/* Comments Section */
.comments-section {
  margin-top: 40px;
  padding: 20px;
  background: var(--cultured);
  border-radius: 10px;
}

.comments-title {
  font-size: var(--fs-2);
  font-weight: var(--fw-600);
  margin-bottom: 20px;
}

.comment-form {
  margin-bottom: 30px;
}

.comment-form .form-group {
  margin-bottom: 20px;
}

.comment-form label {
  font-size: var(--fs-7);
  font-weight: var(--fw-600);
  color: var(--onyx);
  margin-bottom: 8px;
  display: block;
}

.comment-form input,
.comment-form textarea {
  padding: 12px;
  border: 1px solid var(--gainsboro);
  border-radius: 5px;
  font-size: var(--fs-7);
  color: var(--onyx);
  transition: var(--transition-1);
  width: 100%;
  box-sizing: border-box;
}

.comment-form textarea {
  resize: vertical;
  min-height: 100px;
}

.comment-form input:focus,
.comment-form textarea:focus {
  border-color: var(--bittersweet);
  outline: none;
}

.comment-form .btn {
  width: max-content;
  font-size: var(--fs-7);
}

.comment-list {
  display: flex;
  flex-direction: column;
  gap: 20px;
  margin-bottom: 10px;

   max-height: 300px;
  overflow-y: auto;
  padding-right: 10px;
}

.comment-item {
  padding: 15px;
  background: var(--white);
  border-radius: 5px;
  box-shadow: 0 2px 5px hsla(0, 0%, 0%, 0.1);
}

.comment-header {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
}

.comment-author {
  font-size: var(--fs-7);
  font-weight: var(--fw-600);
  color: var(--rich-black-fogra-29);
}

.comment-date {
  font-size: var(--fs-8);
  color: var(--gray-x-11-gray);
}

.comment-text {
  font-size: var(--fs-7);
  color: var(--onyx);
  line-height: 1.6;
}

.related-products {
  margin-top: 40px;
}

.related-products-title {
  font-size: var(--fs-2);
  font-weight: var(--fw-600);
  margin-bottom: 20px;
}

.related-products-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 30px;
}

.product-card {
  background: var(--white);
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 5px 15px hsla(0, 0%, 0%, 0.1);
  transition: var(--transition-2);
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px hsla(0, 0%, 0%, 0.15);
}

.card-banner {
  position: relative;
  height: 280px;
  overflow: hidden;
  background: var(--cultured);
}

.product-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition-2);
}

.product-card:hover .product-img {
  transform: scale(1.1);
}

.card-badge {
  position: absolute;
  top: 15px;
  left: 15px;
  background: var(--bittersweet);
  color: var(--white);
  padding: 5px 12px;
  border-radius: 20px;
  font-size: var(--fs-8);
  font-weight: var(--fw-500);
}

.card-action-list {
  position: absolute;
  top: 15px;
  right: 15px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  opacity: 0;
  transition: var(--transition-1);
}

.product-card:hover .card-action-list {
  opacity: 1;
}

.card-action-item {
  position: relative;
}

.card-action-btn {
  width: 40px;
  height: 40px;
  background: var(--white);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--rich-black-fogra-29);
  font-size: 18px;
  transition: var(--transition-1);
  border: none;
  cursor: pointer;
}

.card-action-btn:hover {
  background: var(--bittersweet);
  color: var(--white);
}

.card-action-tooltip {
  position: absolute;
  top: 50%;
  right: calc(100% + 10px);
  transform: translateY(-50%);
  background: var(--rich-black-fogra-29);
  color: var(--white);
  padding: 5px 10px;
  border-radius: 4px;
  font-size: var(--fs-8);
  white-space: nowrap;
  opacity: 0;
  transition: var(--transition-1);
  pointer-events: none;
}

.card-action-btn:hover+.card-action-tooltip {
  opacity: 1;
}

.card-content {
  padding: 20px;
}

.card-category {
  font-size: var(--fs-8);
  color: var(--onyx);
  text-transform: uppercase;
  margin-bottom: 8px;
  font-family: var(--ff-roboto);
}

.card-title {
  font-size: var(--fs-6);
  font-weight: var(--fw-600);
  color: var(--rich-black-fogra-29);
  margin-bottom: 12px;
  line-height: 1.3;
}

.card-price {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}

.current-price {
  font-size: var(--fs-5);
  font-weight: var(--fw-700);
  color: var(--bittersweet);
}

.old-price {
  font-size: var(--fs-7);
  color: var(--gray-x-11-gray);
  text-decoration: line-through;
}

/* Mobile Menu Toggle */
.menu-toggle {
  display: block;
  background: var(--bittersweet);
  color: var(--white);
  padding: 8px 12px;
  border-radius: 5px;
  font-size: 20px;
}

/* Responsive Design */
@media (min-width: 768px) {
  .product-detail-container {
    grid-template-columns: 1fr 1fr;
  }

  .related-products-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (min-width: 992px) {
  .product-detail-container {
    grid-template-columns: 1fr 1fr;
  }

  .related-products-grid {
    grid-template-columns: repeat(4, 1fr);
  }

  .menu-toggle {
    display: none;
  }

  .nav-menu {
    display: flex;
    gap: 30px;
  }

  .nav-link {
    color: var(--rich-black-fogra-29);
    font-weight: var(--fw-500);
    transition: var(--transition-1);
  }

  .nav-link:hover {
    color: var(--bittersweet);
  }
}

@media (min-width: 1200px) {
  .container {
    max-width: 1280px;
  }

  .main-image {
    height: 500px;
  }

  .variant {
    width: 100px;
    height: 100px;
  }
}
</style>
