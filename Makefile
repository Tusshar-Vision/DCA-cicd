# Define variables
NGINX_CONTAINER_ID=a943af5dc41d
NGINX_IMAGE_NAME=dca-proxy
VISIONIAS_IMAGE_NAME=dca-visionias
NGINX_DOCKERFILE=Dockerfile.nginx

# Default target
.PHONY: all
all: build

# Execute bash in the nginx container
.PHONY: exec-nginx
exec-nginx:
	docker exec -it $(NGINX_CONTAINER_ID) bash

# Remove all Docker images forcefully
.PHONY: remove-all-images
remove-all-images:
	docker rmi -f $(shell docker images -a -q)

# Remove all Docker containers forcefully
.PHONY: remove-all-containers
remove-all-containers:
	docker rm -f $(shell docker ps -a -q)

# Build the nginx Docker image
.PHONY: build-nginx
build-nginx:
	docker build -t $(NGINX_IMAGE_NAME) -f $(NGINX_DOCKERFILE) .

# Build the visionias Docker image
.PHONY: build-visionias
build-visionias:
	docker build -t $(VISIONIAS_IMAGE_NAME) .

# Remove all containers and images, and then build the nginx and visionias images
.PHONY: rebuild-all
rebuild-all: remove-all-containers remove-all-images build

# Build all Docker images
.PHONY: build
build: build-nginx build-visionias

# Run the nginx container
.PHONY: run-nginx
run-nginx:
	docker run -it --name dca-proxy --network dca-network --link dce-visionias -p 80:80 $(NGINX_IMAGE_NAME)

.PHONY: run-visionias
run-visionias:
	docker run -d --name dce-visionias --network dca-network $(VISIONIAS_IMAGE_NAME)

.PHONY: remove-nginx-image
remove-nginx-image:
	docker rmi -f $(NGINX_IMAGE_NAME)

.PHONY: remove-nginx
remove-nginx:
	docker rm -f $(NGINX_CONTAINER_ID)