# CRM

a project by yii2

## Installation

first clone the repo

```bash
git clone https://github.com/joy007-py/crm.git
```

Use composer to install project dependency.

```bash
composer install
```

change db config in /common/config/main-local.php if necessary

migrate database files

```bash
php yii migrate/up
```
now go to http://localhost/crm/admin/