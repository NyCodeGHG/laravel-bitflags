# Laravel Bitflags

Store and receive bitflags from a single database column.

## Installation

```bash
composer require aw-studio/bitflags
```

## Usage

Imagine you want to store multiple status flags in a single `status` column of your `Email` model.
This can be achieved using bitwise operations to create a representative `bitmask`.
Bitflags must all be powers of to (1,2,4,8,16 …)

```php
class Email extends Model
{
    // Email status flags
    public const SENT = 1;
    public const RECEIVED = 2;
    public const SEEN = 4;
    public const READ = 8;

    protected $fillable = ['status'];
}
```

In order to store and receive `bitmask` from your database make shure to properly cast the column:

```php
public $casts = [
    'status' => Bitflags::class
];
```

### Adding a flag to a bitmask

Adding a `bitflag` to a maks can be achieved using the `addBitflag()` helper:

```php
public function markRead()
{
    $this->update([
        'status' => addBitflag(self::READ, $this->status)
    ]);
}
```

### Removing a flag from a bitmask

Adding a `bitflag` to a maks can be achieved using the `removeBitflag()` helper:

```php
public function markRead()
{
    $this->update([
        'status' => removeBitflag(self::READ, $this->status)
    ]);
}
```
