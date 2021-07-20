# Brew Competition Online Entry & Management Docker Image

Docker container to serve BCOE&M.

Based on [`php-apache` image](https://hub.docker.com/_/php), for serving BCOE&M, e.g. for development or behind a reverse proxy with another service doing SSL termination etc.

## Docker Variables

| Name              | Remark                                                          |
| ----------------- | --------------------------------------------------------------- |
| DB_DATABASE       | MariaDB/Mysql database                                          |
| DB_HOST           | MariaDB/Mysql host                                              |
| DB_PASSWORD       | MariaDB/Mysql password                                          |
| DB_USER           | MariaDB/Mysql user                                              |
| ENABLE_SSL        | Set to `true` or `false` to enable/disable SSL                  |
| PORT              | Port to serve requests over                                     |
| SETUP_FREE_ACCESS | `true` or `false`, sets/unsets the `setup_free_access` variable |

## Usage with Docker-Compose

Docker-Compose a BCOE&M and [MariaDB](https://hub.docker.com/_/mariadb) database container.

In the parent folder, to mount the source code for development:

    make docker-dev

Or to use a static cluster:

    make docker

For example, if you wanted to start up the cluster with free-access:

    SETUP_FREE_ACCESS=true make docker-dev

After you go through the setup routine, press CTRL+C to stop the stack, then rerun the Make target without the environment variable to make the cluster start without 'free access' mode:

    make docker-dev
