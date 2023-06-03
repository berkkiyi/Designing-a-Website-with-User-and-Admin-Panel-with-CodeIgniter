<!DOCTYPE html>
<html>

<head>
    <title>Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #333;
            background-color: #eee;
            padding: 10px 15px;
            border-radius: 4px;
        }

        a i {
            margin-right: 5px;
        }

        form {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .error-message {
            color: #ff0000;
            margin-top: 5px;
        }

        @media (max-width: 600px) {
            form {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <h1>Admin İletişim Formu</h1>
    <a href="<?php echo base_url(); ?>dashboard">
        <i class="fa fa-dashboard"></i> <span>Ana Sayfa</span>
    </a>
    <form action="<?= site_url('form/submit') ?>" method="post">
        <div>
            <label for="ad">Ad:</label>
            <input type="text" name="ad" id="ad" required>
        </div>

        <div>
            <label for="soyad">Soyad:</label>
            <input type="text" name="soyad" id="soyad" required>
        </div>

        <div>
            <label for="email">E-posta:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div>
            <label for="telefon">Telefon:</label>
            <input type="text" name="telefon" id="telefon" required>
        </div>

        <div>
            <label for="mesaj">Mesaj:</label>
            <input type="text" name="mesaj" id="mesaj" required>
        </div>

        <input type="submit" value="Gönder">
    </form>

</body>

</html>