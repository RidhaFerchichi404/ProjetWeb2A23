<?php
// Inclure le fichier de connexion à la base de données
include '../../config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Participant Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .form-container .input-group {
            margin-bottom: 20px;
        }

        .form-container label {
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="file"],
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .form-container input[type="text"]:focus,
        .form-container input[type="file"]:focus,
        .form-container select:focus,
        .form-container textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-container .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="traitementF.php" method="POST">
                <h3>Training Participant</h3>
                <!-- Error Messages -->
                <?php if (isset($_GET['error']) && !empty($_GET['error'])): ?>
                    <div style="color: red;">
                        <?php foreach ($_GET['error'] as $error): ?>
                            <p><?= htmlspecialchars($error) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="input-group">
                    <label for="id_tra">Training ID</label>
                    <input type="text" id="id_tra" name="id_tra" value="<?php echo isset($_GET['training_id']) ? $_GET['training_id'] : ''; ?>" readonly>
                </div>

                <div class="input-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your Name">
                </div>

                <div class="input-group">
                    <label for="phone">Your Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Enter your Phone">
                </div>

                <div class="input-group">
                    <label for="cv">Select your CV</label>
                    <select id="cv" name="cv">
                        <option value="call_centers">Call Centers</option>
                        <option value="Sales and Marketing">Sales and Marketing</option>
                        <option value="Human Resources">Human Resources</option>
                        <!-- Add more options here -->
                    </select>
                </div>

                <div class="input-group">
                    <label for="upload">Upload your CV</label>
                    <input type="file" id="upload" name="upload">
                </div>

                <div class="input-group">
                    <label for="lettre">Letter of Motivation</label>
                    <textarea id="lettre" name="lettre" rows="4" placeholder="Write your letter of motivation"></textarea>
                </div>

                <input type="submit" class="submit-button" value="SEND A REQUEST">
            </form>
        </div>
    </div>
</body>
</html>

