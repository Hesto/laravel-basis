# During development
# Hesto Laravel Basis

- `basis:env`
- `basis:dependencies`
- `basis:register`
- `basis:install`

# Requirements
- fresh laravel 5.3 project
- database must exists before

# Usage

## Install once per computer
```
composer global require hesto/laravel-setup
```

## Every project

```
cd your_project_path
composer require hesto/laravel-basis
```

Add your new provider to the `providers` array of `config/app.php`:
```php
  'providers' => [
      // ...
      Hesto\LaravelBasis\BasisServiceProvider::class,
      // ...
  ],
```

Use `laravel-setup {guard}`. Example:
```
laravel-setup admin
```

## Quick

```
composer require hesto/laravel-basis
e config/app.php
Hesto\LaravelBasis\BasisServiceProvider::class,
laravel-setup admin
```


