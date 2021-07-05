# Brew Competition Online Entry & Management Docker Image

Docker container to serve BCOE&M.

## Tags

### `cgspeck/bcoem:php`

Based on `php-apache` image, for serving BCOE&M behind a reverse proxy with another service doing SSL termination etc.

Good for development use.

### `cgspeck/bcoem:swag`

Based on `linuxserver/swag` image, for serving BCOE&M with automatic certificate creation and renewal thanks to Lets' Encrypt.

## Environment Variables

| Name       | PHP image? | SWAG image? | Remark                                         |
| ---------- | ---------- | ----------- | ---------------------------------------------- |
| ENABLE_SSL | yes        | no          | Set to `true` or `false` to enable/disable SSL |
