<?php
            include '../../../Model/db_connection.php';

            try {
                $sql = "SELECT submission_id, name, contact, problem_description FROM usersubmissions ORDER BY submission_date DESC LIMIT 1";
                
                // Prepare the statement
                $stmt = $conn->prepare($sql);
                
                // Execute the statement
                $stmt->execute();

                // Fetch the result
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
                    echo "<p>Name: " . $row["name"] . "</p>";
                    echo "<p>Contact: " . $row["contact"] . "</p>";
                    echo "<p>Problem Description: " . $row["problem_description"] . "</p>";

                    // Add update and delete options
                    echo '<p>Actions:
                            <a href="delete_submission.php?id=' . $row["submission_id"] . '">Delete</a>
                          </p>';
                } else {
                    echo "No submissions yet.";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $conn = null;
            }
        ?>