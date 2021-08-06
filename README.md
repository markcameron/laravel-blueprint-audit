<p align="center"><a href="https://see.asseco.com" target="_blank"><img src="https://github.com/asseco-voice/art/blob/main/evil_logo.png" width="500"></a></p>

# Blueprint audit

Purpose of this repository is to provide additional methods for migrations.

## Installation

Require the package with ``composer require asseco-voice/laravel-blueprint-audit``.
Service provider will be registered automatically.

## Usage

Call ``$table->audit()`` within your migration to get these attributes:

```php
$this->timestamp('created_at')->nullable();
$this->string('created_by')->nullable();
$this->string('creator_type')->nullable();

$this->timestamp('updated_at')->nullable();
$this->string('updated_by')->nullable();
$this->string('updater_type')->nullable();
```

or call ``$table->softDeleteAudit()`` to additionally get also:

```php
$this->timestamp('deleted_at')->nullable();
$this->string('deleted_by')->nullable();
$this->string('deleter_type')->nullable();
```

If you're using first one, add ``Audit`` trait on your model, and for
second one add ``SoftDeleteAudit`` trait to enable these attributes being
populated automatically. 

``_type`` field is there to support if you have more than one type of entities
which can perform actions on resources (i.e. `service` or `user`).

You can modify how the IDs and types are being extracted by publishing the config
with ``php artisan vendor:publish --tag=asseco-blueprint-audit`` and implementing 
your own extractor class. Be sure your extended class implements ``Extractor``
interface.
