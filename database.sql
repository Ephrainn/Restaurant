-- database.sql

CREATE DATABASE IF NOT EXISTS restaurant_db;
USE restaurant_db;

-- Reset Tables (Enable clean re-runs)
SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

-- Users Table (for Admin)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image_url VARCHAR(255),
    is_available TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Seed Data: Admin (username: admin, password: password123)
INSERT INTO users (username, password_hash) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE username=username;

-- Seed Data: Categories
INSERT INTO categories (name, description) VALUES 
('Rice Dishes', 'Authentic rice meals'),
('Swallow', 'Traditional swallows with soup'),
('Grilled & BBQ', 'Suya, Chicken, and Fish'),
('Soups & Stews', 'Rich traditional soups'),
('Sides & Snacks', 'Small chops and sides'),
('Drinks', 'Refreshing cold drinks'),
('Pizza', 'Cheesy goodness');

-- Seed Data: Products
INSERT INTO products (category_id, name, description, price, image_url) VALUES 
(1, 'Jollof Rice & Chicken', 'Classic party jollof with grilled chicken and coleslaw', 15.00, 'https://images.unsplash.com/photo-1512058564366-18510be2db19?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(1, 'Fried Rice & Beef', 'Rich fried rice served with spicy beef', 14.50, 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(1, 'Ofada Rice & Sauce', 'Local rice with spicy ayamase sauce and assortment', 16.00, 'https://images.unsplash.com/photo-1598514983318-2f64f8f4796c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(2, 'Pounded Yam & Egusi', 'Smooth pounded yam with rich egusi soup and goat meat', 18.00, 'https://images.unsplash.com/photo-1596797038530-2c107229654b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(2, 'Amala & Ewedu', 'Hot Amala served with Gbegiri, Ewedu and Assorted Meat', 17.00, 'https://images.unsplash.com/photo-1604328698692-f76ea9498e76?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(2, 'Eba & Okro', 'Yellow Garri with fresh seafood Okro soup', 16.50, 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(3, 'Chicken Suya', 'Spicy grilled chicken coated in suya spice', 8.00, 'https://images.unsplash.com/photo-1532550907401-a500c9a57435?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(3, 'Grilled Catfish', 'Whole grilled catfish with pepper sauce and chips', 25.00, 'https://images.unsplash.com/photo-1594041680534-e8c8cdebd659?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(3, 'Beef Suya Skewers', 'Tender beef skewers with onions and tomatoes', 7.00, 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(4, 'Goat Meat Pepper Soup', 'Spicy broth with tender goat meat chunks', 12.00, 'https://images.unsplash.com/photo-1604152135912-04a022e23696?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(4, 'Banga Soup', 'Palm nut soup served with starch or eba', 14.00, 'https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(5, 'Plantain (Dodo)', 'Sweet fried plantain cubes', 4.00, 'https://images.unsplash.com/photo-1643135543162-817c7b81966a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(5, 'Meat Pie', 'Flaky pastry filled with minced meat and veggies', 3.50, 'https://images.unsplash.com/photo-1608039783021-6116a558f0c5?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWVhdCUyMHBpZXxlbnwwfHwwfHx8MA%3D%3D'),
(5, 'Puff Puff', 'Sweet deep-fried dough balls', 3.00, 'https://images.unsplash.com/photo-1621252179027-94459d27d3ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(5, 'Sausage Roll', 'Savory pastry rolled with seasoned sausage meat', 3.50, 'https://images.unsplash.com/photo-1608039829548-391f554d5e88?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(5, 'Scotch Egg', 'Boiled egg wrapped in sausage meat and breadcrumbs', 4.50, 'https://images.unsplash.com/photo-1626804475297-411d0c1e8460?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(5, 'Spring Rolls', 'Crispy pastry rolls filled with vegetables and chicken', 4.00, 'https://images.unsplash.com/photo-1544025162-d7669d265f29?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(5, 'BBQ Chicken Wings', 'Succulent wings glazed in BBQ sauce', 8.00, 'https://images.unsplash.com/photo-1608039755401-742074f0548d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(6, 'Chilled Chapman', 'Refreshing fruity mocktail', 5.00, 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(6, 'Fresh Watermelon Juice', 'Natural cold pressed juice', 4.50, 'https://images.unsplash.com/photo-1595981267035-7b04ca84a82d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(6, 'Soda (Coke/Fanta)', 'Cold carbonated soft drink', 2.00, 'https://images.unsplash.com/photo-1622483767028-3f66f32aef97?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(6, 'Malt Drink', 'Rich non-alcoholic malt beverage', 3.00, 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(7, 'Pepperoni Pizza', 'Classic pepperoni with mozzarella cheese', 18.00, 'https://images.unsplash.com/photo-1628840042765-356cda07504e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),
(7, 'BBQ Chicken Pizza', 'Smoky BBQ sauce, chicken, and onions', 20.00, 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80'),

(7, 'Veggie Supreme', 'Loaded with peppers, mushrooms, and olives', 16.00, 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80');

-- Reservations Table
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    reservation_date DATE NOT NULL,
    reservation_time TIME NOT NULL,
    guest_count INT NOT NULL,
    special_requests TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'processing', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);

