# ComplaintHub

PHP & MySQL tabanlı, firma bazlı şikayet oluşturma ve yönetme sistemi.

## ✨ Özellikler
- Firma bazlı şikayet oluşturma
- Firma adına göre arama
- Sayfalama (Pagination)
- Kullanıcı e-posta maskeleme (public)
- Admin panel (giriş / silme)
- Güvenli şifreleme (password_hash)
- Otomatik tablo oluşturma (migration mantığı)

## 🛠 Kullanılan Teknolojiler
- PHP 8+
- MySQL
- PDO
- HTML / CSS
- Git & GitHub

## 🚀 Kurulum

### 1️⃣ Repoyu Klonla
```bash
git clone https://github.com/yigitiht1/ComplaintHub.git
cd ComplaintHub
```


### 2️⃣ Veritabanı Oluştur
```text
MySQL’e bağlanıp aşağıdaki komutu çalıştır:
CREATE DATABASE sikayetdb;
```

### 3️⃣ Config Dosyasını Ayarla
```text
cp config.example.php config.php

config.php içeriği:
return [
    "db_host" => "localhost",
    "db_name" => "sikayetdb",
    "db_user" => "root",
    "db_pass" => "YOUR_PASSWORD"
];
```

### 4️⃣ Projeyi Çalıştır
```bash
php -S localhost:8000

Tarayıcıdan aç:
http://localhost:8000
```

### 5️⃣ Admin Bilgileri
```text
Varsayılan bilgiler:
Kullanıcı adı: admin
Şifre: admin123

Güvenlik için ilk girişten sonra şifreyi değiştirmeniz önerilir.
