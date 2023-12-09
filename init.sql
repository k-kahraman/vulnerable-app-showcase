DROP TABLE IF EXISTS items;
CREATE TABLE items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2)
);
INSERT INTO items (name, description, price) VALUES
('Mystery Novel', 'A thrilling page-turner set in a mysterious mansion', 15.99),
('Superhero Action Figure', 'Detailed action figure of your favorite superhero', 21.99),
('Vintage Vinyl Record', 'Classic hits from the 70s on pristine vinyl', 29.99),
('Handcrafted Wooden Puzzle', 'Challenging and beautifully made wooden puzzle', 18.50),
('Retro Video Game Console', 'Relive the golden age of gaming with this retro console', 55.99),
('Gourmet Chocolate Box', 'A selection of high-quality, artisan chocolates', 12.99),
('Eco-friendly Water Bottle', 'Stay hydrated and environmentally conscious', 10.99),
('Bluetooth Headphones', 'High-quality sound with noise-cancellation technology', 89.99),
('Smartphone Projector', 'Project your phone screen anywhere', 24.99),
('Astronomy Telescope', 'Explore the stars with this powerful telescope', 199.99),
('Portable Hammock', 'Lightweight and durable, perfect for any outdoor adventure', 34.99),
('Luxury Fountain Pen', 'Elegant fountain pen with smooth writing capability', 45.50),
('Wireless Phone Charger', 'Convenient and fast wireless charging', 19.99),
('Yoga Mat', 'Non-slip, eco-friendly mat for yoga enthusiasts', 22.99),
('Spice Garden Kit', 'Grow your own herbs and spices at home', 17.99);

DROP TABLE IF EXISTS hidden_items;
CREATE TABLE hidden_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2)
);

INSERT INTO hidden_items (name, description, price) VALUES
('Invisibility Cloak', 'Become unseen with this magical cloak', 299.99),
('Time Machine Kit', 'Build your own time machine – use with caution!', 499.99),
('Alien Communication Device', 'Interstellar communication tool', 259.99),
('Teleportation Pad', 'Instantly transport yourself to any location', 399.99),
('Laser Sword', 'A sword made of pure energy', 159.99);

