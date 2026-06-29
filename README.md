# Sardini Studio — Full-Stack Portfolio Application

**Sardini Studio** هو موقع بورتفوليو احترافي لمكتب سرديني للهندسة المعمارية والتصميم الداخلي، مبني بـ React + Laravel.

---

## هيكل المشروع

```
Bilal-Sardini/
├── src/              ← Frontend (React + Vite)
├── backend/          ← Backend API (Laravel 11)
└── README.md
```

---

## إعداد الـ Backend (Laravel)

### المتطلبات

- PHP 8.2+
- Composer
- MySQL 8+

### خطوات الإعداد

```bash
cd backend

# 1. تثبيت الحزم
COMPOSER_ALLOW_SUPERUSER=1 composer install

# 2. نسخ ملف البيئة
cp .env.example .env

# 3. توليد مفتاح التطبيق
php artisan key:generate
```

### إعداد `.env`

افتح `backend/.env` وعدّل هذه القيم:

```env
APP_NAME="Sardini Studio"
APP_URL=http://localhost:8000

DB_DATABASE=sardini_studio
DB_USERNAME=root
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=noreply@sardinistudio.com
MAIL_FROM_NAME="Sardini Studio"

ADMIN_EMAIL=admin@sardinistudio.com
ADMIN_INITIAL_PASSWORD=Sardini@2025!
OTP_EXPIRY_MINUTES=10
OTP_MAX_ATTEMPTS=5
OTP_COOLDOWN_MINUTES=15

FRONTEND_URL=http://localhost:5173
```

### إنشاء قاعدة البيانات

```bash
mysql -u root -p -e "CREATE DATABASE sardini_studio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### تشغيل Migrations والـ Seeders

```bash
cd backend

php artisan migrate
php artisan db:seed

# رابط التخزين (للصور)
php artisan storage:link
```

### تشغيل الـ Backend

```bash
php artisan serve --port=8000
```

---

## إعداد الـ Frontend (React)

```bash
# من مجلد المشروع الرئيسي
npm install

# إنشاء ملف البيئة
cp .env.example .env
```

**`/.env`:**
```env
VITE_API_URL=http://localhost:8000/api/v1
VITE_WHATSAPP_NUMBER=963991234567
```

```bash
npm run dev
```

سيعمل الـ frontend على: `http://localhost:5173`

---

## نظام المصادقة

يعتمد البيكند نظام مصادقة ثلاثي المراحل:

### 1. تسجيل الدخول
```
POST /api/v1/admin/auth/login
{
  "email": "admin@sardinistudio.com",
  "password": "Sardini@2025!"
}
```
← يرسل OTP مكون من 6 أرقام إلى بريد الأدمن

### 2. التحقق من OTP
```
POST /api/v1/admin/auth/verify-otp
{
  "email": "admin@sardinistudio.com",
  "otp": "123456"
}
```
← يرجع `token` (Bearer token صالح 7 أيام)

### 3. استخدام التوكن
في كل طلب محمي:
```
Authorization: Bearer {token}
```

### إعادة تعيين كلمة المرور
```
POST /api/v1/admin/auth/forgot-password
{ "email": "admin@sardinistudio.com" }

POST /api/v1/admin/auth/reset-password
{ "token": "...", "password": "NewPass@123", "password_confirmation": "NewPass@123" }
```

---

## API Endpoints

### Public (لا تتطلب مصادقة)

| Method | Endpoint | الوصف |
|--------|----------|-------|
| GET | `/api/v1/projects` | كل المشاريع (فلترة + باجينيشن) |
| GET | `/api/v1/projects/featured` | المشاريع المميزة |
| GET | `/api/v1/projects/categories` | تصنيفات المشاريع |
| GET | `/api/v1/projects/{slug}` | مشروع واحد |
| GET | `/api/v1/services` | كل الخدمات |
| GET | `/api/v1/services/{slug}` | خدمة واحدة |
| GET | `/api/v1/blog` | كل المقالات |
| GET | `/api/v1/blog/featured` | المقالات المميزة |
| GET | `/api/v1/blog/categories` | تصنيفات المدونة |
| GET | `/api/v1/blog/{slug}` | مقال واحد |
| GET | `/api/v1/testimonials` | آراء العملاء |
| GET | `/api/v1/partners` | الشركاء |
| GET | `/api/v1/faqs` | الأسئلة الشائعة |
| GET | `/api/v1/team` | فريق العمل |
| GET | `/api/v1/timeline` | المسيرة الزمنية |
| GET | `/api/v1/process-steps` | خطوات العمل |
| GET | `/api/v1/settings` | إعدادات الموقع |
| GET | `/api/v1/settings/group/{group}` | مجموعة إعدادات |
| GET | `/api/v1/pages/{slug}` | صفحة ثابتة |
| POST | `/api/v1/contact` | إرسال رسالة تواصل |
| POST | `/api/v1/consultations` | طلب استشارة |

### Admin (تتطلب `Authorization: Bearer {token}`)

جميع العناوين تبدأ بـ `/api/v1/admin/`

| الوحدة | Endpoints |
|--------|-----------|
| مشاريع | `GET/POST /projects` · `GET/POST/DELETE /projects/{id}` · `DELETE /projects/{id}/gallery/{index}` |
| مدونة | `GET/POST /blog` · `GET/POST/DELETE /blog/{id}` · `GET/POST /blog-categories` |
| خدمات | `apiResource /services` |
| شهادات | `apiResource /testimonials` |
| شركاء | `apiResource /partners` |
| FAQs | `apiResource /faqs` |
| فريق | `GET/POST /team` · `GET/POST/DELETE /team/{id}` |
| تايملاين | `GET/POST /timeline` · `PUT/DELETE /timeline/{id}` |
| خطوات | `apiResource /process-steps` |
| إعدادات | `GET /settings` · `PUT /settings` · `POST /settings/logo` |
| صفحات | `GET /pages` · `GET/PUT /pages/{slug}` |
| رسائل | `GET /messages` · `GET/PATCH/DELETE /messages/{id}` |
| استشارات | `GET /consultations` · `PATCH /consultations/{id}/status` |
| وسائط | `GET/POST /media` · `PATCH/DELETE /media/{id}` |

---

## Query Parameters

```
GET /api/v1/projects?category=residential&featured=1&per_page=6&page=2
GET /api/v1/blog?category=architecture-tips&featured=1&per_page=9
GET /api/v1/testimonials?per_page=12&page=1
```

---

## هيكل مجلد البيكند

```
backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ← كنترولرز الأدمن
│   │   │   └── Public/         ← كنترولرز عامة
│   │   ├── Middleware/
│   │   │   └── EnsureAdminMiddleware.php
│   │   ├── Requests/           ← Form Requests للتحقق
│   │   └── Resources/          ← API Resources
│   ├── Models/                 ← كل الموديلات
│   ├── Notifications/          ← OTP وإشعارات البريد
│   └── Services/               ← OtpService, MediaService, PasswordResetService
├── database/
│   ├── migrations/             ← 10 ملفات migration
│   └── seeders/                ← بيانات تجريبية ثنائية اللغة
├── routes/
│   └── api.php                 ← كل المسارات
├── config/
│   └── cors.php                ← إعداد CORS
└── bootstrap/
    └── app.php                 ← Middleware aliases + Rate limiters
```

---

## ملاحظات مهمة

- **USE_MOCK في الـ Frontend:** في `src/api/config.js` اجعل `USE_MOCK = false` للاتصال بالـ API الحقيقي
- **الصور:** تُخزن في `storage/app/public/` وتُعرض عبر `{APP_URL}/storage/...`
- **اللغة:** كل المحتوى ثنائي اللغة — الحقل العربي ينتهي بـ `_ar` والإنجليزي بـ `_en`
- **Soft Delete:** المشاريع والمقالات تستخدم SoftDeletes (محذوف = مخفي وليس ممسوحاً)
- **Rate Limiting:** تسجيل الدخول: 5 محاولات/دقيقة · التواصل: 3 رسائل/10 دقائق
