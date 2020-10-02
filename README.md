# Simple PHP Contact Form

A Simple Contact Form developed in PHP with HTML5 Form validation. Has a fallback in JavaScript for browsers that do not support HTML5 form validation.

## Containerized with Alpine based container

Using techniques from https://github.com/hardware/rainloop

The container adds ssmtp so you can set up a working config in /etc/ssmtp/
for the outgoing mail.

## Download

You can download the latest version or checkout all the releases [here](https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form/releases).

## Requirements

* PHP >=5.4

## How to use?

Open the config.php [`config.php`](contact-form/config/config.php) file and fill with your informations.

```php
<?php

return [
    'subject' => [
        'prefix' => '[Contact Form]'
    ],
    'emails' => [
        'to'   => '', // Email address to receive emails via the form.
        'from' => '' // A valid email address - the domain should be the same as where the form is hosted.
    ],
    'messages' => [
        'error'   => 'There was an error sending, please try again later.',
        'success' => 'Your message has been sent successfully.'
    ],
    'fields' => [
        'name'     => 'Name',
        'email'    => 'Email',
        'phone'    => 'Phone',
        'subject'  => 'Subject',
        'message'  => 'Message',
        'btn-send' => 'Send'
    ]
];
```

## Browser Support

![IE](https://cdnjs.cloudflare.com/ajax/libs/browser-logos/46.0.0/archive/internet-explorer-tile_10-11/internet-explorer-tile_10-11_48x48.png) | ![Chrome](https://cdnjs.cloudflare.com/ajax/libs/browser-logos/46.0.0/archive/chrome_12-48/chrome_12-48_48x48.png) | ![Firefox](https://cdnjs.cloudflare.com/ajax/libs/browser-logos/46.0.0/archive/firefox_3.5-22/firefox_3.5-22_48x48.png) | ![Opera](https://cdnjs.cloudflare.com/ajax/libs/browser-logos/46.0.0/archive/opera_15-32/opera_15-32_48x48.png) | ![Safari](https://cdnjs.cloudflare.com/ajax/libs/browser-logos/46.0.0/archive/safari_1-7/safari_1-7_48x48.png)
--- | --- | --- | --- | --- |
IE 9+ ✔ | Latest ✔ | Latest ✔ | Latest ✔ | Latest ✔ |

## Contributing

Check [CONTRIBUTING.md](CONTRIBUTING.md) for more information.

## History

Check [Releases](https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form/releases) for detailed changelog.

## License

[MIT](LICENSE)
