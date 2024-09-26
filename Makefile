APP_NAME=bankapp
CONTAINER_NAME=bankapp-container
DOCKER=docker

install:
	$(DOCKER) build -t $(APP_NAME) .

run:
	$(DOCKER) run -d -it --name $(CONTAINER_NAME) $(APP_NAME) || $(DOCKER) start $(CONTAINER_NAME)

test: run
	$(DOCKER) exec $(CONTAINER_NAME) ./vendor/bin/phpunit tests

clean:
	$(DOCKER) stop $(CONTAINER_NAME) && $(DOCKER) rm $(CONTAINER_NAME)