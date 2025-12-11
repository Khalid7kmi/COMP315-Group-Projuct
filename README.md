# COMP315-Group-Projuct
<h1>A simple food Service System</h1>

<h2>Students</h2>
<table border="1">
  <tr>
    <th>Name</th>
    <th>ID</th>
  </tr>
  <tr>
    <td>Khalid Hakami</td>
    <td>202412133</td>
  </tr>
  <tr>
    <td>Azzam Suwidi</td>
    <td>202412217</td>
  </tr>
    <tr>
    <td>abdulwadud sulimani</td>
    <td>202412219</td>
  </tr>
    </tr>
    <tr>
    <td>Rayan almalki</td>
    <td>202412142</td>
  </tr>
      <tr>
    <td>TBD</td>
    <td>TBD</td>
  </tr>
</table>

<h1>ER digram for the database</h1>
<img src="ER.png" alt=" " width="500" height="333">

# Food Ordering System - File Documentation

This document explains the purpose and functionality of each file in the project.

## 📂 Core Configuration

* **`config.php`**
    Establishes the connection to the database using credentials (host, username, password, db name). It is included in almost every other file to enable data access.

## 📱 User Interface & Customer Experience

This section details the files responsible for the front-end customer experience, including authentication, browsing food, and managing orders.

### 🔐 Authentication & Session Management

* **`register.php`**
    * **Purpose:** Handles new user sign-ups.
    * **Functionality:**
        * Validates that the username (3-20 chars) and password (6-20 chars) contain no spaces.
        * Uses `password_hash()` to securely encrypt passwords before storing them in the `users` table.
        * Redirects to `login.php` upon success.

* **`login.php`**
    * **Purpose:** Authenticates existing users.
    * **Functionality:**
        * Contains a hardcoded check for the admin account (User: `admin`, Pass: `admin123`) to redirect to the admin panel.
        * Verifies customer credentials against the database using `password_verify()`.
        * Starts a session (`$_SESSION["loggedin"]`) to track the user across pages.

* **`logout.php`**
    * **Purpose:** Ends the user session.
    * **Functionality:** Runs `session_destroy()` and redirects the user immediately back to the login page.

### 🏠 Browsing & Ordering

* **`index.php` (Home Page)**
    * **Purpose:** The landing page for logged-in users.
    * **Functionality:**
        * Displays a welcome alert with the username.
        * Features a "Hero" section with a call-to-action button.
        * **Featured Dishes:** dynamically fetches and displays the first **3 items** from the `foods` database table to highlight popular items.

* **`menu.php`**
    * **Purpose:** The main catalog of food items.
    * **Functionality:**
        * Fetches **all** records from the `foods` table.
        * Displays items in a responsive grid layout using Bootstrap cards.
        * Truncates descriptions to the first 90 characters to keep the design clean.
        * Includes an "Order Now" button passing the specific `food_id` to the next page.

* **`order.php`**
    * **Purpose:** The detailed order placement page.
    * **Functionality:**
        * Receives the `food_id` from the URL to display specific details (Image, Title, Price).
        * Allows the user to input a **quantity** (minimum 1).
        * Calculates the `total_price` (Price × Quantity) and inserts the order into the database with a status of **'pending'**.

### 🧾 Order Management

* **`orders.php` (My Orders)**
    * **Purpose:** Displays the personal order history of the currently logged-in user.
    * **Functionality:**
        * Uses a `JOIN` query to combine `orders` and `foods` tables, showing the Food Name instead of just an ID.
        * Filters results specifically for the current user: `WHERE orders.user_id = ?`.
        * Provides a "Delete" button for each order.

* **`delete_order.php`**
    * **Purpose:** Handles the cancellation of orders.
    * **Functionality:**
        * Accepts an order `id` via the URL.
        * Executes a SQL `DELETE` command to remove the order from the database.
        * Redirects the user back to `orders.php` after deletion.

### 🎨 Styling & Layout

* **`header.php`**
    * **Purpose:** The main navigation bar included on every page.
    * **Functionality:**
        * Dynamically changes links based on login status (e.g., shows "Logout" if logged in, "Login" if not).
        * Uses the custom brand color `#BE6741` for the navbar background.

* **`style.css`**
    * **Purpose:** Custom CSS overrides.
    * **Functionality:**
        * Defines the primary theme color (`#BE6741`) for buttons and backgrounds to ensure consistent branding.
        * Styles the hero section typography and button hover effects.
## 🛠️ Admin Panel (Admin Directory)

* **`index.php` (Admin Dashboard)**
    The main landing page for administrators. It displays summary statistics, such as the total number of users and total orders placed.

* **`items_index.php`**
    Lists all food items currently in the menu. It provides an interface for admins to add, update, or delete food items.

* **`orders.php` (Admin View)**
    Displays a table of all customer orders. It allows the admin to view order details (user, food, total) and update the status (e.g., from "Pending" to "Ready for Pick Up").

* **`create.php`**
    A form that allows admins to add new food items to the database, including uploading an image for the item.

* **`update.php`**
    A form that allows admins to edit existing food items. It pre-fills the current data and handles image replacement if a new file is uploaded.

* **`delete.php`**
    A backend script that receives an item ID and deletes that food item from the database.

* **`admin_header.php`**
    The navigation bar specific to the admin panel, providing links to the Dashboard, Menu Management, and Order Management.
<h1>📌 Requirements & Proofs</h1>

<p>
Below are all required project criteria with that was mentioned in the Mini Project Grading Rubric file.

</p>

<hr>

<h2>✅ 1. SELECT Query (Fetching Data)</h2>

<p><strong>Requirement:</strong> The project must include a working SQL SELECT query to fetch data from MySQL.</p>

<h3>Proof (Screenshot + Code)</h3>

<img src="ER.png" alt=" " width="500" height="333">

<pre>
<code>
-- SELECT Query Example
$sql = "SELECT * FROM foods";
$result = mysqli_query($conn, $sql);
</code>
</pre>

<hr>

<h2>✅ 2. INSERT Query (Adding Data)</h2>

<p><strong>Requirement:</strong> System must allow adding records (e.g., registration, add food) using INSERT.</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshot of a successful "Add Food" or "Register" action.</em></p>

<pre>
<code>
-- INSERT Query Example
$insert = "INSERT INTO foods (title, description, price, image)
           VALUES ('$title', '$description', '$price', '$image')";
mysqli_query($conn, $insert);
</code>
</pre>

<hr>

<h2>✅ 3. UPDATE / DELETE Queries</h2>

<p><strong>Requirement:</strong> Admin must be able to update or delete records.</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshot of admin editing or deleting a food item.</em></p>

<pre>
<code>
-- UPDATE Query
$update = "UPDATE foods SET title='$title', price='$price' WHERE id=$id";
mysqli_query($conn, $update);

-- DELETE Query
$delete = "DELETE FROM foods WHERE id = $id";
mysqli_query($conn, $delete);
</code>
</pre>

<hr>

<h2>✅ 4. Authentication (Login / Logout with Sessions)</h2>

<p><strong>Requirement:</strong> Working login and logout system using PHP sessions.</p>

<h3>Proof</h3>

<img src="login demo.gif" alt=" " width="500" height="333">

<pre>
<code>
-- Login Session
session_start();
$_SESSION['user_id'] = $user['id'];

-- Logout
session_destroy();
</code>
</pre>

<hr>

<h2>✅ 5. Form Handling (At Least One Form)</h2>

<p><strong>Requirement:</strong> A working form that processes user input (order form, register form, etc).</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshot of any working form (order, login, register).</em></p>

<pre>
<code>
-- Form Processing Example
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = $_POST['quantity'];
}
</code>
</pre>

<hr>

<h2>✅ 6. Bootstrap & UI/UX Design (2 Marks)</h2>

<p><strong>Requirement:</strong> The project must use Bootstrap for a responsive and clean UI.</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshots of menu, homepage, navbar, admin dashboard.</em></p>

<pre>
<code>
-- Example Bootstrap Component
<nav class="navbar navbar-expand-lg navbar-light bg-light">
</nav>
</code>
</pre>

<hr>

<h2>✅ 7. File Upload & Storage (File Handling)</h2>

<p><strong>Requirement:</strong> Upload files (images) and store the file path in the database.</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshot of admin upload page and uploads/ folder.</em></p>

<pre>
<code>
-- File Upload Example
$image_name = $_FILES['image']['name'];
move_uploaded_file($_FILES['image']['tmp_name'], "admin/uploads/" . $image_name);
</code>
</pre>

<hr>

<h2>✅ 8. Code Reusability (include/require)</h2>

<p><strong>Requirement:</strong> Use include/require for header, footer, and database config.</p>

<h3>Proof</h3>

<p><em>📸 Insert screenshot of the includes/ folder structure.</em></p>

<pre>
<code>
-- Example Include Usage
include "includes/header.php";
include "config.php";
</code>
</pre>

<hr>

<h2>✅ 9. Hosting & Accessibility</h2>

<p><strong>Requirement:</strong> The project must be hosted online (InfinityFree, 000webhost, etc.).</p>

<h3>Proof</h3>

<p><strong>🔗 Live Website Link:</strong></p>
<p><em>Paste your URL here</em></p>

<p><em>📸 Insert screenshot of the website running online.</em></p>

<pre>
<code>
-- Optional: Write your hosting setup steps here
</code>
</pre>

<hr>



