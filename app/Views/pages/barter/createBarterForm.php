<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Create Barter Post <?= $this->endSection() ?>

<?= $this->section("content") ?>

<body>
    <div class="container mt-4">
        <a href="<?= url_to("TestViewsController::viewBarter") ?>" class="back-button mt-3"><i class="bi bi-arrow-left"></i></a>
        <h1>CREATE POST</h1>
        <form action="http://phoenixshop.localhost/test/createBarter" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select a category</option>
                    <option value="textbooks">Textbooks</option>
                    <option value="study-materials">Study Materials</option>
                    <option value="electronics">Electronics</option>
                    <option value="furniture">Furniture</option>
                    <option value="clothing">Clothing</option>
                    <option value="sports-equipment">Sports Equipment</option>
                    <option value="musical-instruments">Musical Instruments</option>
                    <option value="bicycles">Bicycles</option>
                    <option value="appliances">Appliances</option>
                    <option value="others">Others</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price (PHP)</label>
                <input type="text" id="price" name="price" pattern="\d+(\.\d{1,2})?" title="Please enter a valid price in PHP (numeric values only)" placeholder="e.g., 1000.00" required>
            </div>
            <div class="form-group">
                <label for="file">Upload File</label>
                <input type="file" id="file" name="file" required>
            </div>
            <button class="custom_btn" type="submit">Post</button>
        </form>
    </div>
</body>

<style>
    :root {
        --text: #0a090b;
        --background: #f7f6f9;
        --darkbg: #00012E;
        --primary: #7532FA;
        --secondary: #6366F1;
        --accent: #ffe400;
        --lightgray: #edf5f1;
        --gray: #4d4c52;
        --black: #000000;
        --purple: #4f089a;
        --lightpurple: #D292FF;
        --yellow: #fbbd32;
        --navgray: #2A3144;
    }

    body {
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        box-sizing: border-box;
    }

    h1 {
        padding: 10px;
        font-size: 40px;
        text-align: center;
        color: #333;
        font-family: "Poppins", sans-serif;
        font-weight: 800;
        font-style: normal;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        color: #333;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-group textarea {
        height: 150px;
        resize: none;
    }

    .form-group input[type="file"] {
        padding: 3px;
    }

    .custom_btn {
        width: 100%;
        padding: 10px;
        background-color: var(--secondary);
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: var(--primary);
    }

    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        h1 {
            font-size: 20px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 8px;
            font-size: 14px;
        }

        button {
            padding: 8px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .container {
            padding: 10px;
        }

        h1 {
            font-size: 18px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 6px;
            font-size: 12px;
        }

        button {
            padding: 6px;
            font-size: 12px;
        }
    }

    /* Back button style */
    .back-button {
        position: fixed;
        top: 100px;
        left: 10px;
        z-index: 1000;
        width: 50px;
        height: 50px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        text-decoration: none;
    }
</style>
<?= $this->endSection() ?>