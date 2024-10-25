
# BARTA APP -ASSIGNMENT 9

### KEY FEATURES EXPLORED :
* Converted all Query Builder to Eloquent ORM
* Used Factory to seed data to database
* Generate Fake ui-Avatar using name initials for each user created in seeding, with saving them in local storage
* Generate a ui-avatar using name initials for any new user registered, with saving them in local storage
* Service Pattern (Single responsibility)
* Add photo with post, with preview before posting . (saves in local storage/ publically unaccessible) 
* When any post are deleted, its images are also deleted from storage
* Update Profile Picture in edit-profile, with preview before updating. (overwrite the old profile picture in local storage)
* Search functionality using Post - Body and User - username, name, email. (not fulltext search)
* Any table fetched are related to its relations using Eager Loading , (not llazy loading)
* Seperate Form request for all Forms
* Edit Authenticated User's Post, comments, profile
* Pagination 
  * View Count (Pending)


USE THE FOLLOWING TO SET UP IN YOUR DEVICE:

```bash
git clone https://github.com/OvyWanKenobi/InteractiveCares_Laravel_Career_Path.git
```

```bash
cd InteractiveCares_Laravel_Career_Path/Laravel_Career_Path/Assignments/Assignment_9_Barta_App
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

## Use the following credentials to log in:
Email: ashiqur.ovy@gmail.com
Password: 123456789
