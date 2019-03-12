Drupal Gov 2017 - Drupal 8 and Microservices
============================================

## Anatomy of this project

* **api** - Demo API for central storage
* **site 1** - Demo Site 1
* **site 2** - Demo Site 2
* **proto** - Builds proto definitions for grpc
* **slides** - Slides for this presentation

## Usage

**Start environments**

```bash
make start
```

You will notice the following tabs open in your browser:

* http://localhost:8081 (Site 1)
* http://localhost:8082 (Site 2)
* http://localhost:9000 (Slides)

**Seed some demo articles**

```bash
make seed
```