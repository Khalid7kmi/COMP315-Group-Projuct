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
    <td>TBD</td>
  </tr>
  <tr>
    <td>Azzam Suwidi</td>
    <td>TBD</td>
  </tr>
    <tr>
    <td>abdulwadud sulimani</td>
    <td>TBD</td>
  </tr>
    </tr>
    <tr>
    <td>Rayan almalki</td>
    <td>TBD</td>
  </tr>
      <tr>
    <td>Nawaf Hassan Qaddabi</td>
    <td>TBD</td>
  </tr>
</table>

# Entity Relationship(ER) digram for the database
> ## 🔴 *NOTE:*   $for$ $convenient$ 😶The predefined values of the **status** attribute have been updated to :
- **'Pending'**
- **'Pick up'** 


<img src="ER.png" alt=" " width="1000" height="500">

# Food Ordering System - Files

This document explains the purpose and functionality of each file in the project.

## 📂  Configuration

* **`config.php`**
    Establishes the connection to the database using credentials (host, username, password, db name). It is included in almost every other file to enable data access.

## 📱 UI

This section details the files responsible for the front-end customer experience, including authentication, browsing food, and managing orders.

### 🔐 Authentication & Session 

* **`register.php`**
    * **FOR:** Handles new user sign-ups.
    * **Functionality:**
        * Validates that the username (3-20 chars) and password (6-20 chars) contain no spaces.
        * Redirects to `login.php` upon success.

* **`login.php`**
    * **FOR:** Authenticates existing users.
    * **Functionality:**
        * Contains a hardcoded check for the admin account (User: `admin`, Pass: `*****`) to redirect to the admin panel.
        * Starts a session (`$_SESSION["loggedin"]`) to track the user across pages.

* **`logout.php`**
    * **FOR:** Ends the user session.
    * **Functionality:** Runs `session_destroy()` and redirects the user immediately back to the login page.

### 🏠 Browsing & Ordering

* **`index.php` (Home Page)**
    * **FOR:** The landing page for logged-in users.
    * **Functionality:**
        * Displays a welcome alert with the username.
        * **Featured Dishes:** dynamically fetches and displays the first **3 items** from the `foods` database table to highlight popular items.

* **`menu.php`**
    * **FOR:** The main catalog of food items.
    * **Functionality:**
        * Fetches **all** records from the `foods` table.
        * Displays items in a responsive grid layout using Bootstrap cards.
        * Truncates descriptions to the first 90 characters to keep the design clean.
        * Includes an "Order Now" button passing the specific `food_id` to the next page.

* **`order.php`**
    * **FOR:** The detailed order placement page.
    * **Functionality:**
        * Receives the `food_id` from the URL to display specific details (Image, Title, Price).
        * Allows the user to input a **quantity** (minimum 1).
        * Calculates the `total_price` (Price × Quantity) and inserts the order into the database with a status of **'pending'**.

### 🧾 Order Management

* **`orders.php` (My Orders)**
    * **FOR:** Displays the personal order history of the currently logged-in user.
    * **Functionality:**
        * Uses a `JOIN` query to combine `orders` and `foods` tables, showing the Food Name instead of just an ID.
        * Filters results specifically for the current user: `WHERE orders.user_id = ?`.
        * Provides a "Delete" button for each order.

* **`delete_order.php`**
    * **FOR:** Handles the cancellation of orders.
    * **Functionality:**
        * Executes a SQL `DELETE` command to remove the order from the database.
        * Redirects the user back to `orders.php` after deletion.

### 🎨 Style

* **`header.php`**
    * **FOR:** The main navigation bar included on every page.
    * **Functionality:**
        * Dynamically changes links based on login status (e.g., shows "Logout" if logged in, "Login" if not).
        * Uses the custom brand color `#BE6741` for the navbar background.

* **`style.css`**
    * **FOR:** Custom CSS overrides.
    * **Functionality:**
        * Defines the primary theme color (`#BE6741`) for buttons and backgrounds to ensure consistent branding.
        * Styles the hero section typography and button hover effects.
## 🛠️ Admin Panel (Admin Directory)

* **`index.php` (Admin Dashboard)**
    The main landing page for administrators. It displays summary statistics, such as the total number of users and total orders placed.

* **`items_index.php`**
    Lists all food items currently in the menu. It provides an interface for admins to add, update, or delete food items.

* **`orders.php` (Admin View)**
    Displays a table of all customer orders. It allows the admin to view order details (user, food, total) and update the status ( from "Pending" to "Ready for Pick Up").

* **`create.php`**
    A form that allows admins to add new food items to the database, including uploading an image for the item.

* **`update.php`**
    A form that allows admins to edit existing food items. It pre-fills the current data and handles image replacement if a new file is uploaded.

* **`delete.php`**
    A backend script that receives an item ID and deletes that food item from the database.

* **`admin_header.php`**
    The navigation bar specific to the admin panel, providing links to the Dashboard, Menu Management, and Order Management.

---
# 📌Food Ordering System - Project Requirements

> **Note:** Below are all required project criteria that was mentioned in the Mini Project Grading Rubric file.



<h2>✅ 1. SELECT Query </h2>
<p><strong>Requirement:</strong> Fetch data from MySQL.</p>
<p><strong>File:</strong> menu.php</p>
<pre><code class="language-php">
$sql = "SELECT * FROM foods";
$result = mysqli_query($conn, $sql);
</code></pre>
<hr>

<h2>✅ 2. INSERT Query</h2>
<p><strong>Requirement:</strong> Add records ( registration, add food).</p>
<p><strong>File:</strong> create.php</p>
<pre><code class="language-php">
$sql = "INSERT INTO foods (item_name, description, price, image)
        VALUES ('$name', '$description', '$price', '$image')";
$result = mysqli_query($conn, $sql);
</code></pre>
<hr>

<h2>✅ 3. UPDATE/DELETE Queries</h2>
<p><strong>Requirement:</strong> Admin must be able to update or delete records.</p>
<p><strong>File:</strong> update.php</p>
<pre><code class="language-php">
$sql = "UPDATE foods SET item_name='$name', description='$description', price='$price', image='$image' 
        WHERE id='$id'";
$result = $conn->query($sql);
</code></pre>
<p><strong>File:</strong> delete.php</p>
<pre><code class="language-php">
$sql = "DELETE FROM foods WHERE id = '$id'";
$conn->query($sql);
</code></pre>
<hr>

<h2>✅ 4. Authentication
(Login/Logout with PHP
Sessions or Cookies)</h2>
<p><strong>Requirement:</strong> Working login and logout system using PHP sessions.</p>
<p><strong>File:</strong> login.php</p>
<img src="login-logout.gif" alt=" " width="1000" height="333">

<hr>

<h2>✅ 5.Form Handling (At Least
One Form)</h2>
<p><strong>Requirement:</strong> Process user input (order form, register form, etc).</p>
<p><strong>File:</strong> order.php</p>
##empty for now
<hr>

<h2>✅ 6. Bootstrap & UI/UX Design</h2>
<p><strong>Requirement:</strong> Use Bootstrap for a responsive and clean UI.</p>
<p><strong>File:</strong> header.php</p>
<pre><code class="language-html">
&lt;nav class="navbar navbar-expand-lg navbar-dark shadow-sm navbar-custom"&gt;
    &lt;div class="container"&gt;
        &lt;a class="navbar-brand fw-bold" href="index.php"&gt;Our Restaurant&lt;/a&gt;
        &lt;button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"&gt;
            &lt;span class="navbar-toggler-icon"&gt;&lt;/span&gt;
        &lt;/button&gt;
    &lt;/div&gt;
&lt;/nav&gt;
</code></pre>
<hr>

<h2>✅ 7. File Handling (File Upload
& Storage in Database)</h2>
<p><strong>Requirement:</strong> Upload files (images) and store the file path in the database.</p>
<p><strong>File:</strong> create.php</p>
<pre><code class="language-php">
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $image = $target_file; // Variable stored in database
} else {
    $errorMessage = "Failed to upload image.";
}
</code></pre>
<h2>Demo</h2>
<img src="file handeling .gif" alt=" " width="1000" height="333">

<hr>

<h2>✅ 8.Code Reusability (Using
include or require)</h2>
<p><strong>Requirement:</strong> Use include/require for header, and database config.</p>

<p><strong>File:</strong> menu.php + almost all files</p>
<pre><code class="language-php">
include "config.php"; 
include "header.php";   
</code></pre>
<hr>

<h2>✅ 9. Hosting & Accessibility</h2>
<p><strong>Requirement:</strong> The project must be hosted online (InfinityFree, 000webhost, etc.).</p>
<p><strong>File:</strong> config.php</p>
<pre><code class="language-php">
$host = "sql100.infinityfree.com";
$username = "if0_39836550";
$db = "if0_39836550_food_ordering_system";

$conn = new mysqli($host, $username, $password, $db);
</code></pre>
