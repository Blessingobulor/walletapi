This project is a Laravel-based API that allows users to manage multiple wallets, each with a unique type, minimum balance, and monthly interest rate. The system enables seamless money transfers between wallets while ensuring balance constraints are met.

**Database Design**
The system consists of the following key entities:

Users: Each user can own multiple wallets.
Wallets: Every wallet is associated with a user and a wallet type, containing details such as balance, minimum balance, and monthly interest rate.
Wallet Types: Defines the wallet's name, minimum balance, and monthly interest rate.
Transactions: Logs all money transfers between wallets.
API Endpoints
User Endpoints

GET /users – Retrieve all users in the system.
Wallet Endpoints
GET /wallets – Retrieve all wallets in the system.
GET /wallets/{id} – Get a wallet’s details, including its owner, type, and available balance.
POST /wallets/transfer – Transfer money from one wallet to another.

**Features**
Users can own multiple wallets.
Each wallet type has unique attributes like minimum balance and interest rates.
Wallets can send and receive money while maintaining minimum balance rules.
Transactions are logged for accountability.
This API is built using Laravel, following RESTful principles for efficient data management.
