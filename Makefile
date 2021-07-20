.PHONY: docker

docker:
	docker-compose \
		-f docker-compose.dev.yml \
		build
	docker-compose \
		-f docker-compose.dev.yml \
		up

swag-db:
	docker-compose \
		-f docker-compose.swag2.db.yml \
		--env-file .swag.env \
		up \
		--build
