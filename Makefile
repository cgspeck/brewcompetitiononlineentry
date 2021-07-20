.PHONY: docker docker-dev

data/mysql:
	mkdir -p data/mysql

docker: data/mysql
	-docker-compose \
		down
	docker-compose \
		build
	docker-compose \
		up

docker-dev: data/mysql
	-docker-compose \
		-f docker-compose.dev.yml \
		down
	docker-compose \
		-f docker-compose.dev.yml \
		build
	docker-compose \
		-f docker-compose.dev.yml \
		up
