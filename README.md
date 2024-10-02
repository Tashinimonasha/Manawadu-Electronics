
# MANAWADU-ELECTRONICS

**Project Overview**  
MANAWADU-ELECTRONICS is an automated web platform designed for the buying and selling of electronic products. The platform provides customers with a seamless shopping experience, offering a wide range of innovative electronic devices.

## Features
- **User Registration and Login**: Users can create an account, log in, and manage their profiles.
- **Product Search and Categories**: Browse products by categories and search for specific items.
- **Shopping Cart**: Add items to the cart and view selected products.
- **Checkout**: Complete purchases with a streamlined checkout process.
- **Order Management**: Users can view their order history and track orders.
- **Responsive Design**: The platform is mobile-friendly and adapts to various devices.

## Technologies Used
- **PHP**: Backend development and server-side logic.
- **MySQL**: Database management to store user and product information.
- **HTML/CSS**: Frontend structure and styling.
- **JavaScript**: Dynamic elements and interactive features.
- **Composer**: Dependency management for PHP libraries.

## How to Run the Project

### Prerequisites
- PHP (version 7.x or above)
- MySQL (or a compatible database server)
- Composer for dependency management
- A web server (e.g., Apache or Nginx)

### Installation
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/YourUsername/MANAWADU-ELECTRONICS.git
   ```

2. **Set Up the Database**:
   - Import the `electronics (1).sql` file into your MySQL server to create the necessary database and tables.
   - Update the database credentials in the `config.php` file (if present).

3. **Install Dependencies**:
   Use Composer to install required PHP libraries:
   ```bash
   composer install
   ```

4. **Run the Application**:
   - Place the project in your web server's root directory (e.g., `/var/www/html/` for Apache).
   - Access the application in a browser at `http://localhost/MANAWADU-ELECTRONICS`.

### Folder Structure
- `components/`: Contains reusable PHP components.
- `css/`: Styling files.
- `js/`: JavaScript functionality.
- `images/`: Product and other images.
- `uploaded_img/`: Directory for uploaded images.
- **Core PHP Files**:
  - `index.php`: Homepage.
  - `about.php`, `cart.php`, `checkout.php`, etc.: Other functional pages.

## Security Features
- **Authentication**: Secure user login and registration.
- **Authorization**: Access control based on user roles.
- **Input Validation**: Prevents SQL injection and XSS attacks.
  
## Future Improvements
- Implement a payment gateway for online transactions.
- Add product reviews and ratings.
- Integrate real-time order tracking.

## Contributors
- Tashini Monasha (Developer)

---

 Create this for Diploma final year project
