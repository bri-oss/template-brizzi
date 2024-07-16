# Template-informasi-rekening-php

This is a simple template for Virtual Account SNAP BI using PHP.

module:
- [Virtual Account - Briva Online](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-online-snap-bi)
- [Virtual Account - Briva WS](https://developers.bri.co.id/en/snap-bi/apidocs-virtual-account-briva-ws-snap-bi)

## List of Content
- [Instalasi](#instalasi)
  - [Prerequisites](#prerequisites)
  - [How to Setup Project](#how-to-setup-project)
  - [Check Topup Status](#payment)
  - [Topup Deposit](#caution)
  - [Validate Card Number](#validate-card-number)
- [Caution](#caution)
- [Disclaimer](#disclaimer)

## Instalasi

### Prerequisites
- php
- composer

### How to Setup Project

```bash
1. copy .env file by typing 'cp .env.example .env' in the terminal
2. fill the .env file with the required values
3. run composer install to install all dependencies
```

### Check Topup Status
```bash
1. fill partnerId and channelId
2. run command `php src/va_online_inquiry.php serve`
```

### Validate Card Number
```bash
1. fill partnerId and channelId
2. run command `php src/va_online_inquiry.php serve`
```

## Caution

Please delete the .env file before pushing to github or bitbucket

## Disclaimer

Please note that this project is just a template on the use of BRI-API php sdk and may have bugs or errors.
