# Coding Assessment
A coding assessment project simulating a proof of concept for a shopping experience, featuring a list of products with individual codes and prices, discounts for certain product combinations, and delivery fee discounts based on cart total. To be specific, the goals for this assessment are:
- Have a list of 3 products (Red flower, green flower, blue flower), each with a unique product code and price
- Have a cart the customer can add products to
- Have a "buy one, get one half off" discount for red flowers
- Have a shipping fee which decreases when the total is over certain thresholds 

## Background
While I have never used PHP before, as I come from a primarily C# background, I decided to take the challenge and learn PHP from the ground up for this project. I'm utilizing a Windows 11 VM on my Linux machine as my working environment, and Apache as a local server host to run and test the program. I will also be using MySQL and databases to store the product information as a challenge and learning experience for myself.

This assessment was completed over the course of August 17th and 18th by breaking down the time worked into completing essential functions, such as testing and completing the connection to the database, saving products in a cart, and more. I opted to add some degree of visual elements so as to better display for myself and any viewer what the functions are doing and what happens in the background. The format follows what can typically be found on most other sites, where the total cart is shown prior to any discounts or promotions, then listing the amount that you saved from promotions, then the shipping cost that needs to be paid, followed by your final total after deducting your savings and adding your shipping.

I've also utilized GitHub branches and commits to show my progress and experience with Git, such as making commits when changing/adding features or fixing issues, and using branches to manage large codebase or feature updates to prevent the main branch from breaking.

Images showing the results of running my code using the example basket results can also be found in the Test Results directory.

## How it Works
The completed project displays a web page as seen below, which is filled with example data from the example basket provided.

The page is split into 3 distinct sections, the header, left column, and right column. The header simply displays the company name, while the columns are where the primary functions take place. This page is rendered from the index.php page, which then includes and renders parts from other PHP files to help maintain some degree of organization between functions and sections of the site.

At the very beginning of the index.php file, I reach out to a specific database connection file, db_connection.php, to connect to my local SQL database and return the connection result back to index.php to be passed to functions later on.

On the left is the list of products, which is handled by product_table.php. This table gets rendered by calling the ShowProductTable function from index.php and passing the original database connection. Using this connection, product_table.php creates an SQL query that selects all products in the 'products_list' table in our products database. Once the results are grabbed, an HTML table is created for each table entry, displaying the proper product code, name, and price for each. There is an edge case accounted for if there is no data, in which case it simply displays "No products in the database." When rendering each entry, it also creates a form to the right of each entry, allowing the user to enter the desired amount of the product and click "Add to Cart" to add it in the next section.

The right column is divided between its 2 prominent sections, the top and bottom. The top section is where the user's cart is displayed and is created and managed using the cart.php file. The user's cart is managed using a session, storing the cart in the user's cookies. Another method of handling this could have been committing the cart data to the database in an orders table, however, I opted for a session for simplicity sake for this assessment. When the user submits the "Add to Cart" form, the cart.php files gets the data from the form and uses it to create a new cookie entry if we do not have the item already in our cart, or adds the amount to our existing cart amount for that item. Once updated, the cart in full then gets displayed, showing the name, quantity, and subtotal of each item (excluding discounts, as this gets displayed in the next section).

The final section is the bottom of the right column, controlled by the cart_price.php file, which displays the total money saved from the buy one get one half off red flower discount (contextually, this only shows up if there are more than 2 red flowers in the cart), and the shipping cost of the order. The red flower discount is calculated first, done by taking the quantity of red flowers and dividing it by 2, then casting it to an integer. This gives the number of discounted flowers, since every second flower is half off. When cast to an int, the value of 1/2 for example gets truncated from 0.5 to 1, and changing the value of 3/2 from 1.5 to 1, and so on. Multiply by half the red flower price, and you get the amount that gets deducted from the total. The shipping cost then gets applied after reducing the total by the red flower discount, and simply changes the value using an if/else condition based on the cart price.

## Questions and Edge Cases

### When calculating delivery costs, do we calculate all prior special offers first?
I would say in this instance, yes, calculate the total cart cost, including special discounts such as the "buy one red flower, get second half price", before shipping, as this is how most companies in my experience handle it.