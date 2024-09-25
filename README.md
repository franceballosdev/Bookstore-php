# Web Bookstore Project

This is a web-based bookstore project that allows users to browse and purchase books online. The project includes features such as an admin panel, user panels, wishlist functionality, order management, and integration with Stripe for online payments.

## Features

- Main Page: Search books by name, search books by category.

![](https://github.com/francomceballos/gifs/blob/f17ee2d973debedaef7188abc9104cd7374d04e7/Animation.gif)
- Admin Panel: Manage books, orders, users, and other aspects of the bookstore.

![](https://github.com/francomceballos/gifs/blob/cb4ef3972e47efb4077c8c0320b17538f7b0faac/Animation2.gif)
- User Panels: Allow users to register, login, browse books, add to wishlist, and make purchases.
- Wishlist: Users can add books to their wishlist for future reference.

![](https://github.com/francomceballos/gifs/blob/6bea4721830e54a867a6baaae1a78cce0126415a/Animation3.gif)

- Orders: Manage and track orders placed by users.
- Stripe Integration: Securely process payments using the Stripe payment gateway.
- Product delivery: All purchased books will be sent via Email



## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/web-bookstore.git
    ```

2. Set up the database:
    - Import the database schema from `database.sql`.
    - Update the database configuration in `config.php`.

3. Install dependencies:
    ```bash
    composer install
    ```

## Usage

1. Start the PHP server:
    ```bash
    php -S localhost:8000
    ```

2. Open your browser and go to `http://localhost:8000` to access the web bookstore.

## Admin Panel

- Access the admin panel at `http://localhost:8000/admin-panel`.
- Login with the admin credentials to manage the bookstore.

## User Panels

- Users can register and login to access the user functionalities.
- Browse books, add to wishlist, and place orders securely through the website.

## Stripe Integration

- Ensure that your Stripe API keys are correctly configured in the project.
- Users can make secure payments using their credit or debit cards.

## Contributing

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Make your changes.
4. Commit your changes (`git commit -am 'Add new feature'`).
5. Push to the branch (`git push origin feature/your-feature`).
6. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
