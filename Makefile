# Nazwa aplikacji Docker
APP_NAME=bankapp
CONTAINER_NAME=bankapp-container

# Zmienna dla Dockera
DOCKER=docker

# Polecenie do budowania obrazu Docker
install:
	$(DOCKER) build -t $(APP_NAME) .

# Polecenie do uruchomienia kontenera z interaktywną powłoką (-it)
run:
	$(DOCKER) run -d -it --name $(CONTAINER_NAME) $(APP_NAME) || $(DOCKER) start $(CONTAINER_NAME)

# Polecenie do uruchomienia testów z użyciem docker exec
test: run
	$(DOCKER) exec $(CONTAINER_NAME) ./vendor/bin/phpunit tests

# Polecenie do zatrzymania i usunięcia kontenera
clean:
	$(DOCKER) stop $(CONTAINER_NAME) && $(DOCKER) rm $(CONTAINER_NAME)