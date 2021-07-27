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

You can also add multiple flags at once:

```php
$this->update([
    'status' => addBitflag([self::READ, self::SEEN], $this->status)
]);
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

Remove multiple flags at once:

```php
$this->update([
    'status' => removeBitflag([self::READ, self::SEEN], $this->status)
]);
```

### Resolving bitmasks

To check if bitflags are included in a bitmask you may use the following query methods:

```php
public function scopeRead($query)
{
    return $this->whereBitflag('status', self::READ);
}
public function scopeUnread($query)
{
    return $this->whereBitflagNot('status', self::READ);
}
public function scopeSeenOrRead($query)
{
    return $this->whereBitflagIn('status', [self::READ, self::SEEN]);
}
public function scopeSeenAndRead($query)
{
    return $this->whereBitflags('status', [self::READ, self::SEEN]);
}
```
