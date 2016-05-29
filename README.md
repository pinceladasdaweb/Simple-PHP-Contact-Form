# Simple PHP Contact Form

A Simple Contact Form developed in PHP with HTML5 Form validation. Has a fallback in JavaScript for browsers that do not support HTML5 form validation.

## Demo

View [demo here](http://www.pinceladasdaweb.com.br/blog/uploads/contact-form/).

## Download

You can download the latest version or checkout all the releases [here](https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form/releases).

## Requirements

* PHP >=5.3

## How to use?

Open the config.php [`config.php`](contact-form/config/config.php) file and fill with your informations.

```php
<?php

return [
    'subject' => [
        'prefix' => '[Contact Form]'
    ],
    'emails' => [
        'to'   => '', // Email to receive emails via the form.
        'from' => '' // A valid email where the domain should be the same when the form is hosted.
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

![IE](https://raw.githubusercontent.com/alrra/browser-logos/master/internet-explorer/internet-explorer_48x48.png) | ![Chrome](https://raw.githubusercontent.com/alrra/browser-logos/master/chrome/chrome_48x48.png) | ![Firefox](https://raw.githubusercontent.com/alrra/browser-logos/master/firefox/firefox_48x48.png) | ![Opera](https://raw.githubusercontent.com/alrra/browser-logos/master/opera/opera_48x48.png) | ![Safari](https://raw.githubusercontent.com/alrra/browser-logos/master/safari/safari_48x48.png)
--- | --- | --- | --- | --- |
IE 8+ ✔ | Latest ✔ | Latest ✔ | Latest ✔ | Latest ✔ |

## Contributing

Check [CONTRIBUTING.md](CONTRIBUTING.md) for more information.

## History

Check [Releases](https://github.com/pinceladasdaweb/Simple-PHP-Contact-Form/releases) for detailed changelog.

## License

[MIT](LICENSE)