# JW3B\Helpful\Mail
## Methods

| Name | Description |
|------|-------------|
|[send](#mailsend)|Send an email.|




### Mail::send
**Description**

```php
public static send (string $to, string $from, string $subject, string $message, array $header)
```

Send an email.

**Parameters**

* `(string) $to`
: The recipient's email address.* `(string) $from`
: Senders email address.* `(string) $subject`
: The subject of the email.* `(string) $message`
: The email message.* `(array) $header`
: Additional headers.
**Return Values**

`bool`

> True if the email was sent successfully, false otherwise.


<hr />

