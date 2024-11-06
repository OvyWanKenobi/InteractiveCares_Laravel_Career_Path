
### Assignment 10 RESTFUL API

## USE THE FOLLOWING TO SET UP IN YOUR DEVICE:

```bash
git clone https://github.com/OvyWanKenobi/InteractiveCares_Laravel_Career_Path.git
```

```bash
cd InteractiveCares_Laravel_Career_Path/Laravel_Career_Path/Assignments/Assignment_10_RESTFUL_API
```

```bash
composer install
```

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

```bash
php artisan serve
```

## Use the following credentials to log in from any API PLATFORM:
API-endpoint: http://localhost:8000/api/v1/login
BODY {
email: ashiqur.ovy@gmail.com
password: 123456789
}

## For Registering, 
API-endpoint: http://localhost:8000/api/v1/register
BODY {
name: Ashiqur Rahman
email: ashiqur.ovy@gmail.com
password: 123456789
}

## For Seeing User's All URL (Need Authentication API Token from Login response)
API-endpoint: http://localhost:8000/api/v1/my-urls

## For Shortening LOng Url Link (Need Authentication API Token from Login response)
API-endpoint: http://localhost:8000/api/v1/url-shortener
BODY {
url: https://www.researchgate.net/publication/376600597_Polyps_Segmentation_for_AI-assisted_Colonoscopy_Examination/related
}

![image](https://github.com/user-attachments/assets/2f1b7ef7-f235-42a8-b745-906b0e3e2937)
![image](https://github.com/user-attachments/assets/bb9be5e5-6721-43ac-8a46-efb98c6376ca)
![image](https://github.com/user-attachments/assets/1d168be4-99c9-479c-835b-aba678d03899)
![image](https://github.com/user-attachments/assets/24ed62ca-d4cb-425d-8c63-91ce7d3a985f)


