## HOW WORKS

When requested, receive a PNG image containing four random alphanumeric characters.

`Like: 67a8, 7ffb, ca1f, 4375, 5f32, 22dc, 6603, ef2f....`

```php

The captcha phrase is stored in a token, and crpted in a session `$_SESSION['captchaKey']`

The captcha sent will be compared to the generated image token to determine if they are identical.
```
## LIBRARIES
### Needs PHP GD LIBRARY

https://www.php.net/manual/en/image.installation.php
