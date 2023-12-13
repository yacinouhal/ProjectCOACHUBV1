<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Actions</title>
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e5f3f3; 
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: linear-gradient(to bottom, #ffffff, #f0f8ff); 
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
        }

        h1 {
            color: #2c3e50; 
        }

        p {
            color: #34495e; 
        }

        form {
            display: grid;
            gap: 20px;
        }

        label {
            font-weight: bold;
            color: #2c3e50; 
        }

        input, textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #bdc3c7; 
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out; 
        }

        input:focus,
        textarea:focus {
            border-color: #3498db; 
        }

        button {
            padding: 15px;
            background: linear-gradient(to bottom, #2ecc71, #27ae60); 
            color: #fff; 
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        button:hover {
            background: linear-gradient(to bottom, #27ae60, #219d53); 
        }

        textarea {
            width: 100%;
            padding: 15px;
            border: 1px solid #bdc3c7;
            border-radius: 6px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
            resize: none; 
        }

        input:focus,
        textarea:focus {
            border-color: #3498db;
        }

      
        body.admin {
            background-color: #ecf0f1; 
        }

        container.admin {
            background: #fff; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
            text-align: center;
            padding: 50px;
            margin: 100px auto;
            border-radius: 10px;
        }

        h1.admin {
            color: #3498db; 
        }

        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #bdc3c7; 
            padding: 15px; /
            text-align: left;
        }

        th {
            background-color: #3498db; 
            color: #fff; 
        }

        
        .submission {
            background: #fff; 
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); 
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
        }

        .submission h2 {
            color: #3498db; 
        }

       
        .delete-form {
            position: relative;
            display: inline-block; 
        }

       
        .delete-form button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            color: #e74c3c; 
            cursor: pointer;
        }

       
        .delete-form button:hover {
            color: #c0392b; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Actions</h1>

        <?php
            include '../../../Model/db_connection.php';

            try {
                $sql = "SELECT action_id, submission_id, admin_username, action_description, action_date FROM adminactions ORDER BY action_date DESC";
                
                
                $stmt = $conn->prepare($sql);
                
                
                $stmt->execute();

                
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($rows) {
                    echo "<table border='1'>
                            <tr>
                                <th>Action ID</th>
                                <th>Submission ID</th>
                                <th>Admin Username</th>
                                <th>Action Description</th>
                                <th>Action Date</th>
                            </tr>";

                           
                            foreach ($rows as $row) {
                                echo "<tr>
                                        <td>{$row['action_id']}</td>
                                        <td>{$row['submission_id']}</td>
                                        <td>{$row['admin_username']}</td>
                                        <td>{$row['action_description']}</td>
                                        <td>{$row['action_date']}</td>
                                        <td><a href=\"delete_action.php?action_id={$row['action_id']}\">Delete</a></td>
                                        <td><a href=\"update_action.php?action_id={$row['action_id']}\">Update</a></td>
                                      </tr>";
                            }
                            

                    echo "</table>";
                } else {
                    echo "No admin actions yet.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $conn = null;
            }
        ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
