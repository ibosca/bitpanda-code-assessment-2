![Logo of the project](https://cdn.bitpanda.com/media/redesign/bitpanda-logo.svg)

# Bitpanda code assessment #2

Isaac Boscà's solution for Bitpanda code assesment #2.

## Getting Started

### Prerequisites

The following software is necessary to run the project:

- `PHP 8`
- `Composer 2`
- `Docker`

I provided a convenient way to get up and running the project database using `Docker`.
Not needed if there is another database ready on the system.

### Installation

Create a `.env` file from `.env.example`:

```bash
$ cp .env.example .env
```

Then run:

```bash
$ make install
```

### Running the app

```bash
$ make run
```
After running this command, the app will be available at `http://localhost:8000`.

## Tests

You can run the tests using the following command:

```bash
$ make test
```

## Get a taste

### Getting transactions from db source

`GET` http://localhost:8000/api/transactions?source=db

### Getting transactions from csv source

`GET` http://localhost:8000/api/transactions?source=csv


## Considerations

Main considerations has been already covered within the first Readme assessment.
For more details about the structure and architecture, please, refer to previous assessment Readme file. 

### Coupling Infrastructure to domain

Unlike the previous code, where we were decoupling our domain from infrastructure using dependency inversion, now we are "knowing" our infrastructure from our domain.
You can see this in TransactionRepositoryBySourceFactory, where instead of an interface, we are injecting directly the concrete implementations.

This happens because the data source is not an implementation detail anymore.
Since the end user has the chance to decide, these concrete implementations become to some extent, "part of our domain logic".

My opinion here is to keep it as infrastructure, and create an interface for both implementations.
This way we are still encapsulating the decision in the Factory, and after that, the code is working with a generic interface.
If at some point the source is always the database, we will be able to switch really easily. 


## Author

### Isaac Boscà

Website: [https://isaac.bosca.xyz/](https://isaac.bosca.xyz/)    
LinkedIn: [https://www.linkedin.com/in/isaac-bosca/](https://www.linkedin.com/in/isaac-bosca/)    

