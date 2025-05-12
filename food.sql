-- Create database and tables
CREATE DATABASE IF NOT EXISTS users;
USE users;


CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,

    slug VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admins (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS menu_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_email VARCHAR(255) NOT NULL,
    table_number INT NOT NULL,
    instructions TEXT,
    payment_method VARCHAR(50) NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (item_id) REFERENCES menu_items(id)
);
CREATE TABLE user_ratings (
    id BINARY(16) PRIMARY KEY ,
    menu_item_id INTEGER,
    rating integer CHECK (rating >= 1 AND rating <= 5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- Enable RLS
ALTER TABLE user_ratings ENABLE ROW LEVEL SECURITY;

-- Create policy to allow all users to view ratings
CREATE POLICY "Anyone can view ratings" ON user_ratings
    FOR SELECT USING (true);

-- Create policy to allow users to create ratings
CREATE POLICY "Users can create ratings" ON user_ratings
    FOR INSERT WITH CHECK (true);

-- Create function to calculate average rating
CREATE OR REPLACE FUNCTION get_average_rating(item_id integer)
RETURNS decimal AS $$
BEGIN
    RETURN (
        SELECT COALESCE(AVG(rating)::decimal(2,1), 0.0)
        FROM user_ratings
        WHERE menu_item_id = item_id
    );
END;
$$ LANGUAGE plpgsql;

CREATE TABLE review (
  `id`  INT PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `review` varchar(100) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




-- Insert initial admin account (username: admin, password: admin123)
INSERT INTO admins (username, password) VALUES 
('admin', 'Admin@123'),
('Lahari','Lahari@12345');


-- Insert sample categories

INSERT INTO categories (name, slug) VALUES 
('Non-Veg Items', 'non-veg'),
('Ocean Treasures', 'seafood'),
('Veg Items', 'veg'),
('Fast Food', 'noodles'),
('Roti & Naan', 'breads'),
('Salads', 'salads'),
('Desserts & Icecreams', 'desserts & icecreams'),
('Beverages', 'beverages');


-- Insert sample menu items
INSERT INTO menu_items (category_id, name, description, price, image_url) VALUES
(1, 'Butter Chicken', 'Tender chicken in rich tomato gravy', 299.00, 'https://images.unsplash.com/photo-1603894584373-5ac82b2ae398'),
(1, 'Chicken Biryani', 'Fragrant rice with spiced chicken', 249.00, 'https://images.unsplash.com/photo-1563379091339-03b21ab4a4f8'),
(1, 'Mutton Biryani', 'Aromatic basmati rice and tender mutton cooked with spices and herbs.', 299.00,'images/muttonbiryani.jpg'),
(1, 'Chicken Tikka', 'Succulent chicken marinated in yogurt and spices, grilled to perfection.', 229.00, 'images/chickentikka.jpg'),
(1, 'Chicken 65','Spicy and flavorful South Indian fried chicken, perfect as an appetizer.', 179.00, 'images/chicken65.jpg'),
(1, 'Spicy Chicken Curry', 'A classic chicken curry cooked in a flavorful blend of spices.', 249.00, 'images/chickencurry.jpg'),
(1, 'Spicy Mutton Curry', 'Tender mutton cooked in a rich and aromatic gravy.', 279.00, 'images/muttoncurry.jpg'),
(1, 'Tandoori Chicken', 'Chicken marinated in yogurt and spices, cooked in a tandoor oven.', 249.00, 'images/tandoorichicken.jpg'),
(1, 'Egg Biryani','Fragrant rice layered with boiled eggs and aromatic spices.', 229.00, 'images/egg-biryani_9135.jpg'),

(2, 'Fish Curry', 'Fresh fish cooked in a creamy coconut milk curry.', 349.00, 'images/fishcurry.jpg'),
(2, 'Fish Biryani', 'Fragrant rice and flavorful fish cooked with aromatic spices.', 379.00, 'images/fishbiryani.jpg'),
(2, 'Fish Fry', 'Crispy and flavorful fish, seasoned and fried to perfection.', 329.00, 'images/fishfry.jpg'),
(2, 'Fish Tikka', 'Tender fish marinated in spices and grilled, a delicious appetizer.', 349.00, 'images/fishtikka.jpg'),
(2, 'Tandoori Fish', 'Fish marinated in yogurt and spices, cooked in a tandoor oven.', 379.00, 'images/tandoorifish.jpg'),
(2, 'Prawn Biryani', 'Aromatic rice layered with succulent prawns and flavorful spices.', 399.00, 'images/prawnbiryani.jpg'),
(2, 'Chilli Fried Prawns', 'Crispy, spicy prawns served with a fiery chili sauce.', 379.00, 'images/Chilli-Fried-Prawns-1.jpg'),
(2, 'Prawn Curry', 'Succulent prawns cooked in a rich and flavorful curry.', 379.00,  'images/prawncurry.jpg'),
(2, 'Tandoori Prawn Tikka', 'Prawns marinated in yogurt and spices, cooked in a tandoor oven.', 399.00, 'images/Tandoori-prawn-tikka-16.jpg'),

(3, 'Vegetable Biryani','Fragrant rice cooked with a medley of fresh vegetables and spices.', 249.00,'images/vegbiryani.jpg');
(3, 'Paneer Butter Masala','Soft paneer in a creamy and flavorful tomato-based gravy.', 279.00, 'images/Paneer-Butter-Masala-Restaurant-Style.jpg');
(3, 'Palak Panneer', 'Paneer cooked in a creamy and nutritious spinach gravy.', 279.00,'images/Palak-paneer-7-edited.jpg');
(3, 'Spicy Flavoured Vegetable Biryani','Aromatic rice layered with mixed vegetables and spices.', 249.00,'images/Mixed-Veg-Rice-Delight_-done.png');
(3, 'Aloo Matar', 'Potatoes and peas cooked in a flavorful tomato-based gravy.', 229.00,'images/Easy_Vegan_Aloo_Matar_10_web_square.jpg');
(3, 'Dal Makhani', 'Creamy and buttery black lentil dish, a North Indian specialty.', 249.00, 'images/Dal-Makhani-Blog.jpg');
(3, 'Chana Masala','Chickpeas cooked in a spicy and tangy tomato-based gravy.', 229.00,'images/chana-masala-recipe-500x500.jpg');
(3, 'Spicy Aloo Gobi', 'Potatoes and cauliflower cooked with spices in a semi-dry gravy.', 229.00,'images/aloo-gobi-recipe.jpg');

(4, 'Chicken Noodles', 'Stir-fried noodles with tender chicken and vegetables.', 249.00,'images/chickennoodles.jpg');
(4, 'Chilli Garlic Noodles', 'Spicy and flavorful noodles with garlic and chili.', 229.00, 'images/Chilli-hakka-noodles-W.png');
(4, 'Spicy Egg Noodles', 'Stir-fried noodles with scrambled egg and vegetables.', 229.00,'images/eggnoodles.jpg');
(4, 'Vegetable Noodles', 'Stir-fried noodles with a variety of fresh vegetables.', 209.00,'images/vegnoodles.jpg');
(4, 'Spicy Spaghetti', 'Spaghetti tossed in a spicy and flavorful sauce.', 229.00,'images/spicy-spaghetti.jpg');
(4, 'Chicken Manchurian', 'Crispy fried chicken in a tangy and spicy Manchurian sauce.', 279.00,'images/chickenmanchuria.jpg');
(4, 'Egg Manchurian', 'Crispy fried egg in a tangy and spicy Manchurian sauce.', 249.00,'images/eggmanchuria.jpg');
(4, 'Gobi Manchurian', 'Crispy fried cauliflower florets in a tangy and spicy Manchurian sauce.', 249.00,'images/gobi-manchurian-cauliflower-manchurian.jpg');
(4, 'Vegetable Manchurian', 'Crispy fried vegetable balls in a tangy and spicy Manchurian sauce.', 229.00,'images/vegmanchuria.jpg');

(5, 'Butter Naan', 'Soft and buttery naan bread, perfect for scooping up curries.', 99.00,'images/butter-naan.jpg');
(5, 'Cheese Naan','Naan bread stuffed with melted cheese, a delicious accompaniment.', 119.00, 'images/cheesenaan.jpg');
(5, 'Garlic-Naan', 'Naan bread flavored with garlic and herbs.', 109.00,'images/Garlic-naan-bread-5.jpg');
(5, 'Plain Naan', 'Soft and fluffy naan bread, a staple Indian bread.', 89.00,'images/plain-naan.jpg');
(5, 'Phulka', 'Thin and soft whole wheat flatbread.', 79.00,'images/Phulka.jpg');
(5, 'Plain Roti', 'Simple and versatile whole wheat flatbread.', 69.00,'images/plainroti.jpg');
(5, 'Rumali Roti', 'Thin and handkerchief-like flatbread, perfect for wrapping around kebabs.', 119.00,'images/rumali_roti_roomali_roti_recipe.jpg');

(6, 'Fruit Salad', 'A refreshing mix of seasonal fruits.', 149.00,'images/salad-fruit.jpg');
(6, 'Leafy Green Salad', 'A healthy mix of fresh leafy greens.', 129.00,'images/salad-greenleaves.jpg');
(6, 'Vegetable Salad', 'A crisp and colorful salad with a variety of vegetables.', 139.00,'images/salad-vegetables.jpg');
(6, 'Greek Salad', 'A classic salad with tomatoes, cucumbers, olives, and feta cheese.', 159.00,'images/salad-greeksalad.jpg');


(7, 'Cheese Cake', 'Creamy and decadent cheesecake with a graham cracker crust.', 299.00,'images/dessert-cheesecake.jpg');
(7, 'Chocolate Cake', 'Rich and moist chocolate cake, a classic dessert.', 279.00,'images/dessert-chocolatecake.jpg');
(7, 'Red Velvet Cake','Southern classic with a distinctive red color and cream cheese frosting.', 299.00,'images/dessert-redvelvetcake.jpg');
(7, 'Vanilla Cake','Light and versatile vanilla cake, perfect for any occasion.', 249.00,'images/dessert-vanillacake.jpg');
(7, 'Vanilla Icecream',  'Classic and creamy vanilla ice cream.', 149.00,'images/dessert-vanillaicecream.jpg');
(7, 'Tiramisu', 'Italian dessert with coffee-soaked ladyfingers and mascarpone cream.', 329.00,'images/dessert-tiramisu.jpg');
(7, 'Strawberry Icecream','Refreshing and fruity strawberry ice cream.', 169.00,'images/dessert-strawberryice.jpg');
(7, 'Chocolate Icecream', 'Rich and decadent chocolate ice cream.', 169.00,'images/dessert-chocolateicecream.jpg');
(7, 'Mango Icecream', 'Tropical and sweet mango ice cream.', 179.00,'images/dessert-mangoicecream.jpg');
(7, 'Pastries', 'A selection of assorted pastries.', 249.00,'images/dessert-pastries.jpg');
(7, 'Caramel Pudding', 'Smooth and creamy caramel pudding.', 229.00,'images/dessert-pudding.jpg');

(8, 'Apple Juice',  'Refreshing and healthy apple juice.', 129.00,'images/beverages-apple.jpg');
(8, 'Chocolate Milkshake','Creamy and indulgent chocolate milkshake.', 199.00,'images/beverages-chocolate.jpg');
(8, 'Coco-Cola', 'A classic and refreshing carbonated beverage.', 89.00,'images/beverages-cococola.jpg');
(8, 'Iced Lemon Tea', 'Refreshing iced tea with a zesty lemon flavor.', 119.00,'images/beverages-icedlemontea.jpg');
(8, 'Iced Tea', 'Classic and refreshing iced tea.', 99.00,'images/beverages-icedtea.jpg');
(8, 'Lassi', 'A refreshing yogurt-based drink.', 149.00,'images/beverages-lassi.jpg');
(8, 'Mango Milkshake', 'Creamy and tropical mango milkshake.', 179.00,'images/beverages-mango.jpg');
(8, 'Strawberry Milkshake', 'Sweet and creamy strawberry milkshake.', 169.00,'images/beverages-strawberry.jpg');
(8, 'Vanilla Milkshake', 'Classic and creamy vanilla milkshake.', 159.00,'images/beverages-vanillamilkshake.jpg');
